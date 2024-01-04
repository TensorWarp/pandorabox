<?php


namespace Modules\OpenAI\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Image as Images;
use Modules\OpenAI\Entities\{
    Image,
    ContentTypeMeta
};
use App\Models\{
    User,
    Team,
    TeamMemberMeta
};

 class ImageService
 {
    protected $formData;
    public $imageName;
    public $images;
    protected $promt;
    protected $imageNames;
    protected $class;

    public function __construct($formData = null, $imageName = null, $images = null, $promt = null, $imageNames = null, $class = null)
    {
        $this->formData = $formData;
        $this->imageName = $imageName;
        $this->images = $images;
        $this->promt = $promt;
        $this->imageNames = $imageNames;
        $this->class = $class;
    }

    public function storagePath()
    {
        return objectStorage()->url($this->uploadPath());
    }


    public function createImage($data)
    {
        $this->formData = $data;
        $this->formData['promt'] = filteringBadWords($this->formData['promt']);
        return $this->validate();
    }

    public function imageClass()
    {
        $usedApi = json_decode(ContentTypeMeta::where(['key' => 'imageCreateFrom'])->value('value'));
        $class = 'Modules\OpenAI\Libraries'. "\\" . $usedApi[0];
        if (class_exists($class, true)) {
            $this->class = new $class($this);
            return $this->preparePromt();
        } else {
            return [
                'status' => 'error',
            ];
        }
    }

    public function preparePromt()
    {
        return $this->class->promt($this->formData);
    }

    public function validate()
    {
        app('Modules\OpenAI\Http\Requests\ImageStoreRequest')->safe();
        return $this->imageClass();
    }

     
    public function uploadPath()
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','aiImages']));
	}

	protected function thumbnailPath($size = 'small')
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads', config('openAI.thumbnail_dir'), $size]));
	}

    public function upload($url)
    {
        $filename = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(" ", "_",  $this->createName(request('promt'))));
        $filename = md5(uniqid()) . "." . "jpg";
        $this->imageName = $filename;
        $image = objectStorage()->put($this->uploadPath() . DIRECTORY_SEPARATOR . $filename, file_get_contents($url));
        $this->makeThumbnail($this->imageName);
        return $image;
    }

  

    public function makeThumbnail($uploadedFileName)
    {
        $uploadedFilePath = objectStorage()->url($this->uploadPath());
        $thumbnailPath = createDirectory($this->uploadPath());
        $this->resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath);
        return true;
    }

	public function resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath, $oldFileName = null)
	{
		$sizes = $this->sizeRatio();
        $imagePath = str_replace('\\', '/', $uploadedFilePath. DIRECTORY_SEPARATOR . $uploadedFileName);
		foreach ($sizes as $name => $ratio) {
            try {
                $img = Images::make($imagePath);

                $thumbnailPath = createDirectory($this->thumbnailPath($name));
                foreach ($ratio as $key => $value) {
                    $img->resize($img->height(), $value, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    
                    objectStorage()->put($thumbnailPath . DIRECTORY_SEPARATOR .  $uploadedFileName, $img->stream());
                }
            } catch (\Intervention\Image\Exception\NotReadableException $e) {
            }
		}
	}

	public function sizeRatio()
	{
		return [
            'small' => [150 => 150],
            'medium' => [512 => 512]
        ];
	}

    public function storeData($image, $name)
    {
        Image::insert($image);
        return $name;
    }

    public function storeTeamMeta($words)
    {
        $memberData = Team::getMember(auth()->user()->id);
        if (!empty($memberData)) {
            $usage = TeamMemberMeta::getMemberMeta($memberData->id, 'image_used');
            if (!empty($usage)) {
                return $usage && $usage->increment('value', $words); 
            }
        }
        return false;
    }

    public function createName($name = null)
    {
        return !empty($name) ? substr($name, 0, 100) : Str::random(100);
    }


    public function createSlug($name)
    {
        if (!empty($name)) {

            if (strlen($name) > 120) {
                $name = substr($name, 0, 120);
            }

            $slug = cleanedUrl($name);

            if(Image::whereSlug($slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            return $slug;
        }
    }

    public static function getAll()
    {
        $result = Image::query();
        $userRole = auth()->user()->roles()->first();
        if ($userRole->type == 'user') {
            $result = $result->where('user_id', auth()->user()->id);
        }
        return $result->orderBy('id', "DESC");
    }

    public static function model()
    {
        return Image::with(['user:id,name']);
    }

    public function details($id)
    {
        $details = $this->model()->where('id', $id)->first();
        return !empty($details) ? $details : false;
    }

    public function delete($id)
    {
        $image = $this->model()->where('id', $id)->first();
        $isDeleted = empty($image) ? false : $image->delete();
        if ($isDeleted) {
            return $this->unlinkFile($image->original_name);
        }

        return $isDeleted;
    }

    protected function unlinkFile($name)
    {
        if (isExistFile($this->imagePath($name))) {
            objectStorage()->delete($this->imagePath($name));
        }
        
        return true;
    }

    public static function imagePath($name)
    {
        return 'public' . DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . 'aiImages'. DIRECTORY_SEPARATOR . $name;
    }

    public static function imageUrl($id)
    {
        $image = self::model()->where('id', $id)->first();
        return !empty($image) ? self::imagePath($image->original_name) : '';
    }

    public function view($id)
    {
        return $this->model()->where('id', $id)->firstOrFail();
    }

    public function imageBySlug($slug)
    {
        return $this->model()->whereSlug($slug)->firstOrFail();
    }

    public static function users()
    {
        return User::get();
    }

    public function sizes()
    {
        return config('openAI.size');
    }

    public function explodedData($string)
    {
       return explode("x", $string);
    }

    public function bySlug($slug)
    {
        $result = self::model()->where('slug', $slug);

        if (auth()->user()?->role()->type === 'user') {
            $result->where('user_id', auth()->user()->id);
        }

        return $result->firstOrFail();
    }

    public function relatedImages($name, $id)
    {
        $result = $this->model()->whereLike('name', $name)->where('id', '!=', $id);
        
        if (auth()->user()?->role()->type === 'user') {
            $result->where('user_id', auth()->user()->id);
        }

        return $result->take(4)->get();
    }

    public function variants($data)
    {
        $result = $this->model();

        if (auth()->user()?->role()->type === 'user') {
            $result = $result->where('user_id', auth()->user()->id);
        } 

        return $result->where('created_at', $data['created_at'])->where('id', '!=', $data['id'])->orderBy('id', 'DESC')->get();
    }

 }
