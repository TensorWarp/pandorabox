<?php

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\{
    TextToSpeechService,
    ContentService
};

class TextToSpeechController extends Controller
{

    /**
     * Text to Speech Service
     *
     * @var object
     */
    protected $textToSpeechService;

    /**
     * Constructor
     *
     * @param TextToSpeechService $textToSpeechService
     */
    public function __construct(TextToSpeechService $textToSpeechService)
    {
        $this->textToSpeechService = $textToSpeechService;
    }

    /**
     * Text Template
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function textToSpeechTemplate(ContentService $contentService)
    {
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        $data['promtUrl'] = 'api/V1/user/openai/text-to-speech';
        $data['meta'] = $contentService->getMeta('text_to_speech');
        $data['languages'] = [];

        if ($data['meta']) {
            $lang = json_decode($data['meta']->language, true);
            $data['languages'] = $this->textToSpeechService->processLanguage($lang);
        }
        $userId = $contentService->getCurrentMemberUserId(null, 'session');
        $data['userId'] = $userId;
        $data['userSubscription'] = subscription('getUserSubscription');
        $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
        $data['voices'] = $this->textToSpeechService->allVoice();

        $data['audios'] = $this->textToSpeechService->getAll()->take(3)->get();

        return view('openai::blades.textToSpeech.index', $data);
    }

    /**
     * Image list
     * @return [type]
     */
    public function textToSpeechList()
    {
        $data['audios'] = $this->textToSpeechService->getAll()->paginate(preference('row_per_page'));
        return view('openai::blades.textToSpeech.history', $data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['audio'] = $this->textToSpeechService->audioById($id);
        return view('openai::blades.textToSpeech.view', $data);
    }
 
    /**
     * delete content
     * @param Request $request
     *
     * @return [type]
     */
    public function delete(Request $request)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found')];

        if ($this->textToSpeechService->delete($request->id)) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Audio')])];
        }
        return response()->json($response);
    }

    /**
     * delete content
     * @param Request $request
     *
     * @return [type]
     */
    public function destroy(Request $request)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found')];

        if ($this->textToSpeechService->delete($request->id)) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Audio')])];
        }

        \Session::flash($response['status'], $response['message']);
        return response()->json($response);
    }
}
