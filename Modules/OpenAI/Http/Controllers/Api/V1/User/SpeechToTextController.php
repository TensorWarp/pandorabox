<?php

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Services\SpeechToTextService;

use Modules\OpenAI\Http\Resources\SpeechResource;
use Modules\OpenAI\Transformers\SpeechUpdateResource;
use Exception;

class SpeechToTextController extends Controller
{

    /**
     * @param SpeechToTextService $contentService
     */

    public function __construct(
        protected SpeechToTextService $speechToTextService
        ) {}

    /**
     * List of all content
     * @param Request $request
     *
     * @return [type]
     */

     public function index(Request $request)
     {
         $configs        = $this->initialize([], $request->all());
         $contents = $this->speechToTextService->model()->where('user_id', auth('api')->user()->id)->orderBy("id", "desc");
         if (count(request()->query()) > 0) {
             $contents = $contents->filter();
         }

         $contents = $contents->paginate($configs['rows_per_page']);
         $responseData = SpeechResource::collection($contents)->response()->getData(true);
         return $this->response($responseData);
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

        if ($speech = $this->speechToTextService->speechById($id)) {
            return $this->okResponse(new SpeechResource($speech));
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Speech')]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function edit($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }

        $request = app('Modules\OpenAI\Http\Requests\SpeechUpdateRequest')->safe();

        if ($speech = $this->speechToTextService->speechById($id)) {
            try {
                if ($speech->update($request->only('content'))) {
                    return $this->okResponse(new SpeechUpdateResource($speech), __('The :x has been successfully updated.', ['x'=> __('Speech')]));
                }
            } catch (Exception $e) {
                $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
                return $this->unprocessableResponse($data);
            }
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Speech')]));
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
        return $this->speechToTextService->delete($id) ? $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Speech')])) : $this->notFoundResponse([],  __('No :x found.', ['x' => __('Speech')]));
    }
}
