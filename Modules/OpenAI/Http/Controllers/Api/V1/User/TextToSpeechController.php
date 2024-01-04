<?php

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

use Modules\OpenAI\Services\{
    TextToSpeechService, 
    ContentService
};

use Modules\OpenAI\Http\Resources\TextToSpeechResource;

class TextToSpeechController extends Controller
{

    /**
     * @param TextToSpeechService $textToSpeechService
     */

     public function __construct(
        protected TextToSpeechService $textToSpeechService
        ) {}

    /**
     * List of all contents
     * @param Request $request
     *
     * @return [type]
     */

     public function index(Request $request)
     {
         $configs        = $this->initialize([], $request->all());
         $contents = $this->textToSpeechService->getAll();
         if (count(request()->query()) > 0) {
             $contents = $contents->filter();
         }

         $contents = $contents->paginate($configs['rows_per_page']);
         $responseData = TextToSpeechResource::collection($contents)->response()->getData(true);
         return $this->response($responseData);
     }

    /**
     * Audio generate from prompt
     * @param Request $request
     *
     * @return [type]
     */
    public function textToSpeech(Request $request, ContentService $contentService)
    {
        $userId = $contentService->getCurrentMemberUserId('meta', null);
        if (!subscription('isAdminSubscribed')) {
            $userStatus = $contentService->checkUserStatus($userId, 'meta');
            if ($userStatus['status'] == 'fail') {
                return $this->unprocessableResponse([
                    'response' => $userStatus['message'],
                    'status' => 'failed',
                ]);
            }
            $validation = subscription('isValidSubscription', $userId, 'character');
            $subscription = subscription('getUserSubscription', $userId);

            if ($validation['status'] == 'fail' && !auth()->user()->hasCredit('character')) {
                return $this->unprocessableResponse([
                    'response' => $validation['message'],
                    'status' => 'failed',
                ]);
            }
        }

        try {
            $audio = "";
            $text = "";

            foreach ($request->data as $key => $data){

                if (!$this->textToSpeechService->checkActiveActor($data)) {
                    throw new Exception(__(':x, the voice actor, is not currently active', ['x' => $data['voice']]));
                }

                $request['prompt'] = "";
                $request['language'] = $data['language'];
                $request['voice_name'] = $data['voice_name'];
                $request['gender'] = $data['gender'];
                $request['voice'] = $data['voice'];

                if ($key > 0) {
                    $request['prompt'] = "<break time='" . $request['pause'] . "' />";
                    $text .= " ";
                }

                $request['prompt'] .= $data['prompt'];
                $text .= $data['prompt'];

                $response = $this->textToSpeechService->createAudio($request->except('data'));

                if (!empty($response['error'])) {
                    return $this->unprocessableResponse([], $response['error']['message']);
                }

                $audio .= $response['audioContent'];
            }
            
            $response = $this->textToSpeechService->save($audio, $text);

            $response['balanceReduce'] = 'onetime';
            if (!subscription('isAdminSubscribed') || auth()->user()->hasCredit('character')) {
                $increment = subscription('usageIncrement', $subscription?->id, 'character', $response['characters'], $userId);
                $response['balanceReduce'] = app('user_balance_reduce');
                if ($increment  && $userId != auth()->user()->id) {
                    $this->textToSpeechService->storeTeamMeta($response['characters']);
                }
            }

            return $this->successResponse($response);
        } catch(Exception $e) {
            $response = $e->getMessage();
            $data = [
                'response' => $response,
                'status' => 'failed',
            ];
            return $this->unprocessableResponse($data);
        }
    }

     /**
     * Show the specified resource.
     *
     * @param  int  $id
     */
    public function show($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }

        if ($voice = $this->textToSpeechService->audioById($id)) {
            return $this->okResponse(new TextToSpeechResource($voice));
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Voice')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }
        return $this->textToSpeechService->delete($id) ? $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Audio')])) : $this->notFoundResponse([], );
    }
}
