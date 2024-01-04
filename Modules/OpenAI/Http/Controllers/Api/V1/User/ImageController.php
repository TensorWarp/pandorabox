<?php
namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ModelTraits\Filterable;
use Modules\OpenAI\Services\ImageService;
use Modules\OpenAI\Http\Resources\ImageResource;

class ImageController extends Controller
{
    use Filterable;

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function saveImage($imageUrls)
    {
        return $this->imageService->save($imageUrls);
    }

    public function index(Request $request)
    {
        $configs        = $this->initialize([], $request->all());
        $images = $this->imageService->model()->where('user_id', auth('api')->user()->id)->orderBy("id", "desc");
        if (count(request()->query()) > 0) {
            $images = $images->filter();
        }

        $contents = $images->with(['User:id,name'])->paginate($configs['rows_per_page']);
        $responseData = ImageResource::collection($contents)->response()->getData(true);
        return $this->response($responseData);
    }

    public function delete(Request $request)
    {
        if (!is_numeric($request->id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }
        return $this->imageService->delete($request->id) ? $this->okResponse([], __('Image Deleted Successfully')) : $this->notFoundResponse([], );
    }

    public function view($id)
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }
        $image = $this->imageService->details($id);

        if ($image) {
            return $this->okResponse(new ImageResource($image));
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Image')]));
    }
}


