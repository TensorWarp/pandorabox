<?php


namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Services\UseCaseTemplateService;
use App\Models\Team;
use Modules\OpenAI\Entities\OpenAI;

class OpenAIController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function templates()
    {

        $data['useCaseSearchUrl'] = route('user.use_case.search');
        $data['userUseCaseFavorites'] = auth()->user()->use_case_favorites;
        $data['useCases'] = $this->contentService->useCases($data['userUseCaseFavorites']);
        $data['useCaseCategories'] = $this->contentService->useCaseCategories();

        return view('openai::blades.templates', $data);
    }

    public function documents()
    {
        $service = $this->contentService;
        $data['contents'] = $service->getAll()->paginate(preference('row_per_page'));
        $data['bookmarks'] = auth()->user()->document_bookmarks_openai;
        return view('openai::blades.documents', $data);
    }

    public function favouriteDocuments()
    {
        $service = $this->contentService;
        $data['contents'] = $service->getAllFavourite()->paginate(preference('row_per_page'));
        $data['bookmarks'] = auth()->user()->document_bookmarks_openai;

        return view('openai::blades.favourite_documents', $data);
    }

    public function template($slug)
    {
        $service = $this->contentService;
        $data['useCases'] = $service->useCases();
        $data['useCase'] = $service->useCasebySlug($slug);
        $data['options'] = $service->getOption($data['useCase']->id);
        $data['slug'] = $slug;
        $data['promtUrl'] = 'api/V1/user/openai/ask';
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        $data['meta'] = $this->contentService->getMeta('document');
        $userId = $this->contentService->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId; 
        $data['userSubscription'] = subscription('getUserSubscription',$userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);

        return view('openai::blades.document', $data);
    }

    public function imageTemplate()
    {     
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        $data['promtUrl'] = 'api/V1/user/openai/image';
        $data['meta'] = $this->contentService->getMeta('image_maker');
        $userId = $this->contentService->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId; 
        $data['userSubscription'] = subscription('getUserSubscription',$userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);

        return view('openai::blades.image_edit', $data);
    }

    public function codeTemplate()
    {    
        $data['promtRoute'] = 'api/user/openai/image';
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        $data['promtUrl'] = 'api/V1/user/openai/code';
        $data['meta'] = $this->contentService->getMeta('code_writer');

        $userId = $this->contentService->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId;
        $data['userSubscription'] = subscription('getUserSubscription',$userId);
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);

        return view('openai::blades.code', $data);
    }

    public function editContent($slug)
    {
        $service = $this->contentService;
        $data['useCases'] = $service->useCases();
        $data['useCase'] = $service->contentBySlug($slug);
        $data['options'] = $service->getOption($data['useCase']->use_case_id);
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        return view('openai::blades.documents-edit', $data);
    }

    public function updateContent(Request $request)
    {
        return $this->contentService->updateContent($request->contentSlug, $request->content);
    }

    public function getFormFiledByUsecase($slug)
    {
        $service = $this->contentService;
        $data['useCase'] = $service->useCasebySlug($slug);
        $data['options'] = $service->getOption($data['useCase']->id);
        return view('openai::blades.form_fields', $data);
    }

    public function getContent(Request $request)
    {
        return view('openai::blades.partial-history', $this->contentService->getContent($request->contentId));

    }

    public function deleteContent(Request $request)
    {
        return $this->contentService->delete($request->contentId);
    }
    
    public function downloadFile(Request $request)
    {
        $fileUrl = str_replace('\\', '/', $request->input('file_url'));

        $fileName = pathinfo($fileUrl, PATHINFO_BASENAME);

        $contents = file_get_contents($fileUrl);

        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return \Response::make($contents, 200, $headers);
    }

}


