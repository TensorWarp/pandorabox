<?php


namespace Modules\OpenAI\Services;

use Modules\OpenAI\Entities\Speech;

use App\Models\{
    User,
    Language,
    Team,
    TeamMemberMeta
};

 class SpeechToTextService
 {
    protected $formData;
    protected $prompt;
    protected $originalFileName;
    protected $fileSize;
    protected $wordFilter;
    protected $duration;


    public function __construct($formData = null, $prompt = null, $originalFileName = null, $fileSize = null, $wordFilter = null, $duration = null)
    {
        $this->formData = $formData;
        $this->prompt = $prompt;
        $this->originalFileName = $originalFileName;
        $this->fileSize = $fileSize;
        $this->wordFilter = $wordFilter;
        $this->duration = $duration;
    }


    public function getUrl()
    {
        return config('openAI.speechUrl');
    }


    public function getModel()
    {
        return config('openAI.speechModel');
    }


    public function getToken()
    {
        return config('openAI.chatToken');
    }


    public function aiKey()
    {
        return preference('openai');
    }


    public function generateText($data)
    {
        $this->formData = $data;
        $this->wordFilter = $data['word_filter'];
        $this->duration = $data['duration'];
        return $this->validate();
    }


    public function preparePrompt()
    {   
        $this->prompt = ([
            'model' => $this->getModel(),
            'language' => $this->formData['language'],
            'file' => $this->prepareFile(),
            'response_format'=> "json",
        ]);
        return $this->makeCurlRequest();
    }


     public function prepareFile()
     {   
 
        $uploadedFile = $this->formData['file'];

        $this->fileSize = $this->getFileSize($uploadedFile);

        $originalFileName = $uploadedFile->getClientOriginalName();
        $this->originalFileName = $originalFileName;

        $file = new \CURLFile($uploadedFile->getRealPath(), $uploadedFile->getMimeType(), $originalFileName);
        return $file;
     }

    protected function getFileSize($file = [])
    {
        $bytes = filesize($file);
        return round($bytes / 1024, 2);
    }


     public function validate()
     {
         app('Modules\OpenAI\Http\Requests\SpeechStoreRequest')->safe();
         return $this->preparePrompt();
     }

    protected function uploadPath()
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','aiAudios']));
	}

    public function makeCurlRequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
            CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->prompt,
            CURLOPT_HTTPHEADER => [
                'content-type: multipart/form-data',
                "Authorization: Bearer " . $this->aiKey(),
            ],
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $response = !empty($response) ? $response : $err;

        $responseData = json_decode($response, true);

        return $responseData;
    }



    public function save($data)
    {
        $fileName = $this->storeFile();
        $this->formData = $data;
        $this->formData['text'] =  ( $this->wordFilter === 'active' ) ? filteringBadWords($this->formData['text']) : $this->formData['text'];
        $speech[] = [
            'user_id' => auth('api')->user()->id,
            'content' => ( $this->wordFilter === 'active' ) ? filteringBadWords($data['text']) : $data['text'],
            'duration' => $this->duration,
            'language' => $this->processLanguageData(request('language')),
            'file_name' => $fileName,
            'original_file_name' => $this->originalFileName,
            'file_size' => $this->fileSize,
        ];

       return $this->storeData($speech);
    }


     public function storeFile()
     {  
        $this->uploadPath();

        $uploadedFile = $this->formData['file'];
        $fileName = md5(uniqid()) . "." . $uploadedFile->getClientOriginalExtension();
        $destinationFolder = 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'aiAudios'. DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;

        if (!isExistFile($destinationFolder)) {
            createDirectory($destinationFolder);
        }

        objectStorage()->put($destinationFolder . $fileName, file_get_contents($uploadedFile->getRealPath()));

        $path = date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
        return $path;
     }


    protected function storeData($speech)
    {
       return Speech::insert($speech) ? $this->formData : false;
    }


    public function getAll() {

         $result = Speech::with(['user:id,name']);
 
         $userRole = auth()->user()->roles()->first();
         if ($userRole->type == 'user') {
             $result = $result->where('user_id', auth()->user()->id);
         }

         return $result->latest();
    }


    public static function speechById($id) {
        return Speech::with(['user:id,name'])->where('id', $id)->firstOrFail();
    }


    public function updateSpeech($id, $content)
    {
        $response = ['status' => 'error', 'message' => __('Something went wrong.')];
        $speech = Speech::where('id', $id)->first();

        if ($speech) {
            $speech->content = $content;
            $speech->save();
            $response = ['status' => 'success', 'message' => __('Speech Updated successfully.')];
        }

        return response()->json($response);
    }


    public function delete($id)
    {
        if ($speech = Speech::find($id)) {
            try {
                $deleted = $speech->delete();
                
                if ($deleted) {
                    $this->unlinkFile($speech->file_name);
                    $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Speech')])];
                }
                

            } catch (\Exception $e) {
                $response = ['status' => 'fail', 'message' => $e->getMessage()];
            }
            return response()->json($response);

        }

        $response = ['status' => 'fail', 'message' => __('The data you are looking for is not found')];
        return response()->json($response);
    }


    public static function languages()
    {
        return Language::where('status', 'Active')->get();
    }


    protected function processLanguageData($lang)
    {
        $languages = Language::where('status', 'Active')->pluck('name','short_name') ?? [];

        if (!count($languages) == 0) {
            return $languages[$lang];
        }
        return $lang;
    }

 
    public static function users()
    {
        return User::get();
    }


    public function speechUpdate($data)
    {
        $speech = Speech::where('id', $data['id'])->first();
        $speech->content = str_ireplace('<br>', "\n", $data['content']);
        return $speech->save();
    }

    protected function unlinkFile($name)
    {
        if (isExistFile($this->audioPath($name))) {
            objectStorage()->delete($this->audioPath($name));
        }
        return true;  
    }

    public static function audioPath($name)
    {
        return 'public' . DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . 'aiAudios'. DIRECTORY_SEPARATOR . $name;
    }


    public static function model()
    {
        return Speech::with(['user:id,name']);
    }

    public function storeTeamMeta($minutes)
    {
        $memberData = Team::getMember(auth()->user()->id);
        if (!empty($memberData)) {
            $usage = TeamMemberMeta::getMemberMeta($memberData->id, 'minute_used');
            if (!empty($usage)) {
                return $usage && $usage->increment('value', $minutes); 
            }
        }
        return false;
    }

 }
