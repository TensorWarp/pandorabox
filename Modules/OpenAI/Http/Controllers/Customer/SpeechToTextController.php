<?php

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\{SpeechToTextService, ContentService};
use App\Models\{Language, Team};

class SpeechToTextController extends Controller
{
    protected $speechToTextService, $contentService;

    public function __construct(SpeechToTextService $speechToTextService, ContentService $contentService)
    {
        $this->speechToTextService = $speechToTextService;
        $this->contentService = $contentService;
    }

    /**
    *
    * @return [type]
    */

    public function speechTemplate() {
      $data['meta'] = $this->contentService->getMeta('speech_to_text');
      $data['meta_languages'] = processPreferenceData($data['meta']->language);
      $data['language'] = Language::getAll();
      $data['promtUrl'] = 'api/V1/user/openai/speech';
      $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
      $userId = $this->contentService->getCurrentMemberUserId(null, 'session');
      $data['userId'] = $userId;
      $data['userSubscription'] = subscription('getUserSubscription');
      $data['featureLimit'] = subscription('getActiveFeature', $data['userSubscription']?->id ?? 1);
      return view('openai::blades.speeches.speech', $data);
    }
 
    /**
    * list of all Speeches
    *
    * @return [type]
    */
 
    public function speechLists() {
      $service = $this->speechToTextService;
      $data['speeches'] = $service->getAll()->paginate(preference('row_per_page'));

      return view('openai::blades.speeches.speech-history', $data);
    }
 
    /**
    * Speech edit
    * @param mixed $slug
    *
    * @return [type]
    */
 
    public function editSpeech($id) {
        $service = $this->speechToTextService;
        $data['speech'] = $service->speechById($id);
        $data['accessToken'] = !empty(auth()->user()) ? auth()->user()->createToken('accessToken')->accessToken : '';
        return view('openai::blades.speeches.speech-edit', $data);
    }
 
    /**
    * Update Speech
    * @param $request
    *
    * @return [type]
    */
     
    public function updateSpeech(Request $request) {
        return $this->speechToTextService->updateSpeech($request->id, $request->content);
    }
 
    /**
    * delete speech
    * @param Request $request
    *
    * @return [type]
    */
    public function deleteSpeech(Request $request) {
        return $this->speechToTextService->delete($request->speechId);
    }
}
