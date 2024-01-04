<?php
namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\{
    ImageService,
    ContentService
};
use Modules\OpenAI\DataTables\{
    ImageDataTable
};

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

    public function list(ImageDataTable $imageDataTable, ContentService $contentService)
    {
        $data['sizes'] = $contentService->features()['image_maker']['resulation'];
        $data['users'] = $this->imageService->users();
        return $imageDataTable->render('openai::admin.image.index', $data);
    }

    public function deleteImages(Request $request)
    {
        if ($this->imageService->delete($request->id)) {
            return redirect()->back()->withSuccess(__('The :x has been successfully deleted.', ['x' => __('Image')]));
        }
        return redirect()->back()->withFail(__('Failed to delete image. Please try again.'));
    }

    public function view($slug)
    {
        $data['images'] = $this->imageService->imageBySlug($slug);
        return view('openai::blades.imageView', $data);
    }
}


