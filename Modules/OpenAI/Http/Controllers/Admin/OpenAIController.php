<?php
namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\ContentService;
use Modules\OpenAI\Entities\{
    ChatBot,
    Content
};
use App\Models\{
    Preference,
};
use Modules\OpenAI\Http\Requests\ContentUpdateRequest;
use Modules\OpenAI\DataTables\{
    ContentDataTable,
    ImageDataTable
};
use Illuminate\Support\Facades\Session;
use Modules\Subscription\Entities\PackageSubscriptionMeta;

class OpenAIController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    public function index(ContentDataTable $dataTable)
    {
        $data['contents'] = Content::with(['useCase:id,slug,name'])->get();
        $data['languages'] = $this->contentService->languages();
        $data['omitLanguages'] = config('openai.language');
        $data['users'] = $this->contentService->users();
        $data['aiModel'] = config('openAI.openAIModel');
        return $dataTable->render('openai::admin.content.index', $data);
    }

    public function images(ImageDataTable $dataTable)
    {
        $data['users'] = $this->contentService->users();
        $data['sizes'] = config('openAI.size');
        return $dataTable->render('openai::admin.image.index', $data);
    }

    public function edit($slug)
    {
        $data = ['status' => 'fail', 'message' => __('The :x does not exist.', ['x' => __('Content')])];
        $data['content'] = $this->contentService->contentBySlug($slug);
        if (empty($data['content'])) {
            Session::flash($data['status'], $data['message']);
            return redirect()->back();
        }
        $data['readonly'] = is_null($data['content']->parent_id) ? '' : 'readonly';
        $data['disabled'] = is_null($data['content']->parent_id) ? '' : 'disabled';
        $data['categories'] = $this->contentService->useCases();
        $data['contentVersion'] = $this->contentService->model()->where('parent_id', $data['content']->id)->get();
        return view('openai::admin.content.edit', $data);
    }

    public function update(ContentUpdateRequest $request)
    {
        $data = ['status' => 'fail', 'message' => __('The :x has not been saved. Please try again.', ['x' => __('Content')])];

        if ($this->contentService->contentUpdate($request->all())) {
            $data = ['status' => 'success', 'message' => __('Content update successfully!')];
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.contents');
    }

    public function editContent($slug)
    {
        $service = $this->contentService;
        $data['useCases'] = $service->useCases();
        $data['useCase'] = $service->contentBySlug($slug);
        $data['options'] = $service->getOption($data['useCase']->use_case_id);
        $data['slug'] = $slug;
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        
        return view('openai::blades.documents-edit', $data);
    }


    public function delete(Request $request)
    {
        $message = $this->contentService->delete($request->contentId);
        $message = json_decode(json_encode($message), true);
        Session::flash($message['original']['status'], $message['original']['message']);

        return redirect()->back();
    }

    public function contentPreferences()
    {
        $data['preferences'] = $this->contentService->features();
        $data['languages'] = $this->contentService->languages();
        $data['meta'] = $this->contentService->getAllMeta();
        $data['omitLanguages'] = config('openai.language');
        $data['omitSpeechLanguages'] = config('openai.speech_language');
        $data['omitTextToSpeechLanguages'] = config('openai.text_to_speech_language');
        $data['openai'] = Preference::getAll()->where('category', 'openai')->pluck('value', 'field')->toArray();
        $data['aiModels'] = config('openAI.openAIModel');
        $data['aiModelDescription'] = config('openAI.modelDescription');

        return view('openai::admin.preference.index', $data);
    }

    public function createContentPreferences(Request $request, ChatBot $chatBot)
    {
        $data = $this->contentService->storeMeta($request->meta);

        $validator = Preference::aiSettingValidation($request->only('openai', 'word_count_method', 'google_api', 'stablediffusion', 'short_desc_length', 'long_desc_length', 'long_desc_length', 'ai_model', 'max_token_length', 'stable_diffusion_engine'));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = $request->only('openai', 'stablediffusion', 'google_api', 'short_desc_length', 'long_desc_length', 'long_desc_length', 'ai_model', 'max_token_length', 'bad_words', 'stable_diffusion_engine', 'conversation_limit', 'word_count_method');
        $post['bad_words'] = $request->bad_words ?? '';
        $i = 0;
        $response=[];

        foreach ($post as $key => $value) {
            if( $key === 'bad_words' || !empty($value)) {
                $response[$i]['category'] = 'openai';
                $response[$i]['field']    = $key;
                $response[$i]['value']    =  $value;
                $i++;
            }
        }

        $permission = $request->only('hide_template', 'hide_image', 'hide_code', 'hide_speech_to_text', 'hide_text_to_speech');
        foreach ($permission as $key => $value) {
            $permissions[$key] = $value;
        }
        $response[$i] = ['category' => 'openai', 'field' => 'user_permission', 'value' => json_encode($permissions)];
        
        foreach ($response as $key => $value) {
            if (Preference::storeOrUpdate($value)) {
                $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('AI Preference Settings')])];
            }
        }

        Session::flash($data['status'], $data['message']);
        return back();
    }


}


