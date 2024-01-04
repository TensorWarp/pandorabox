<?php
namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\ImageService;
use Modules\OpenAI\Http\Requests\ToggleFavoriteImageRequest;

use Modules\OpenAI\Entities\Image;

class ImageController extends Controller
{

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function saveImage($imageUrls)
    {
        return $this->imageService->save($imageUrls);
    }

    public function list()
    {
        $data['images'] = $this->imageService->getAll()->paginate(preference('row_per_page'));
        $data['userFavoriteImages'] = auth()->user()->image_favorites ?? [];
        return view('openai::blades.images.image_list', $data);
    }

    public function deleteImage(Request $request)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found')];

        if ($this->imageService->delete($request->id)) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Image')])];
        }
        return response()->json($response);
    }

    public function view($slug)
    {
        $data['images'] = $this->imageService->imageBySlug($slug);
        return view('openai::blades.imageView', $data);
    }

    public function imageGallery(Request $request)
    {
        $data['currentImage'] = [];
        $data['images'] = $this->imageService->getAll()->paginate(preference('row_per_page'));
        $data['userFavoriteImages'] = auth()->user()->image_favorites ?? [];

        $data['variants'] = [];
        $data['relatedImages'] = [];

        if ($request->ajax()) {
            foreach ($data['images'] as $image) {
                $imageItems[] = [
                    'id'=> $image->id,
                    'slug' => $image->slug,
                    'name'=> $image->name,
                    'promt' => $image->promt,
                    'size' => checkResulation($image->size),
                    'imageUrl'=> $image->imageUrl(['thumbnill' => true, 'size' => 'medium']),
                    'is_favorite'=> in_array($image->id, $data['userFavoriteImages']) ? true : false,
                ];
            }

            return response()->json([
                'items' =>  $imageItems,
                'nextPageUrl' => $data['images']->nextPageUrl()
            ]);
        }

        return view('openai::blades.images.image_gallery', $data);
    }

    public function imageView($slug)
    {
        $data['currentImage'] = $this->imageService->bySlug($slug);
        $data['userFavoriteImages'] = auth()->user()->image_favorites ?? [];

        $data['variants'] = $this->imageService->variants($data['currentImage']);
        $data['variants']->prepend($data['currentImage']);

        $data['relatedImages'] = $this->imageService->relatedImages($data['currentImage']->name, $data['currentImage']->id);

        $html = view('openai::blades.images.main-image', $data)->render();

        return response()->json([
            'data' => $data,
            'html' => $html
        ]);
    }
    
    public function imageShare($slug)
    {
        $data['currentImage'] = $this->imageService->bySlug($slug);

        $data['variants'] = $this->imageService->variants($data['currentImage']);
        $data['variants']->prepend($data['currentImage']);

        return view('openai::blades.images.image_view_weblink', $data);
    }

    public function toggleFavoriteImage(ToggleFavoriteImageRequest $request): mixed
    {
        $authUser = auth()->user();
        $favoritesArray = $authUser->image_favorites ?? [];

        try {
        
            if ($request->toggle_state == 'true') {
                $favoritesArray = array_unique(array_merge($favoritesArray, [$request->image_id]), SORT_NUMERIC);
                $message = __("Successfully marked favorite!");
            } else {
                $favoritesArray = array_diff($favoritesArray, [$request->image_id]);
                $message = __("Successfully removed from favorites!");
            }

            $authUser->image_favorites = $favoritesArray;
            $authUser->save();
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => __("Failed to update favorites! Please try again later.")], 500);
        }

        return response()->json(["success" => true, "message" => $message], 200);
    }
}


