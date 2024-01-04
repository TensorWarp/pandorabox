<?php

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Support\Facades\{Auth, DB};
use Modules\OpenAI\Entities\UseCase;
use Modules\OpenAI\Http\Requests\ToggleFavoriteUseCaseRequest;
use Modules\OpenAI\Transformers\Api\V1\UseCaseResource;

class UseCasesController extends Controller
{
    /**
     * Use Filtable trait.
     */
    use Filterable;

    /**
     * Return a listing of the resource.
     */
    public function index(Request $request): mixed
    {
        $configs        = $this->initialize([], $request->all());
        $useCases = UseCase::with(['option','option.metadata', 'objectImage'])->orderBy('id', 'DESC');

        $favorites = auth()->user()->use_case_favorites;

        if (count(request()->query()) > 0) {
            $useCases = $this->scopeFilter($useCases, 'Modules\\OpenAI\\Filters\\UseCaseFilter');
        }

        $useCases = $useCases->with('useCaseCategories')->get();
        $responseData = UseCaseResource::collection($useCases)->response()->getData(true);

        return $this->response($responseData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(): mixed
    {
        $request = app('Modules\OpenAI\Http\Requests\UseCaseRequest')->safe();
        $useCaseData = array_merge($request->except(['input_template', 'category_id_array', 'file_id', 'file']), [
            'creator_type' => Auth::guard('api')->user()->role()->type,
            'creator_id' => Auth::guard('api')->id(),
            'prompt' => $request->input_template
        ]);

        $useCase = UseCase::create($useCaseData);

        if ($useCase) {
            try {
                if ($request->has('file') && !empty($request->file)) {
                    $useCase->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'isSavedInObjectFiles' => true, 'thumbnail' => true]);
                }
    
                if ($request->has('category_id_array') && !empty($request->category_id_array)) {
                    $useCase->useCaseCategories()->attach($request->category_id_array);
                }
    
                $useCase = UseCase::with('useCaseCategories')->find($useCase->id);
                return $this->createdResponse(new UseCaseResource($useCase), __('Use case template created successfully!'));
            } catch (Exception $e) {
                $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
                return $this->unprocessableResponse($data);
            }
            
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

        if ($useCase = UseCase::with('useCaseCategories')->find($id)) {
            return $this->okResponse(new UseCaseResource($useCase));
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Template')]));
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

        $request = app('Modules\OpenAI\Http\Requests\UseCaseRequest')->safe();
        $useCaseData = array_merge($request->except(['input_template', 'category_id_array', 'file_id', 'file']), [
            'prompt' => $request->input_template
        ]);

        $useCase = UseCase::find($id);

        if ($useCase) {
            try {
                $useCase->update($useCaseData);

                if ($request->has('file') && !empty($request->file)) {
                    $useCase->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'isSavedInObjectFiles' => true, 'thumbnail' => true]);
                }

                if ($request->has('category_id_array') && !empty($request->category_id_array)) {
                    $useCase->useCaseCategories()->sync($request->category_id_array);
                } else {
                    $useCase->useCaseCategories()->sync([]);
                }

                $useCase = UseCase::with('useCaseCategories')->find($id);
                return $this->okResponse(new UseCaseResource($useCase), __('Use case template updated successfully!'));
            } catch (Exception $e) {
                $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
                return $this->unprocessableResponse($data);
            }
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Template')]));
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

        if ($useCase = UseCase::find($id)) {
            try {
                DB::beginTransaction();

                UseCase::clearFootprints($useCase);
                UseCase::destroy($id);

                DB::commit();
                return $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Use Case Template')]));
            } catch (Exception $e) {
                DB::rollBack();
                $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
                return $this->unprocessableResponse($data);
            }
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Template')]));
    }

    /**
     * Toggle favorite use case
     */
    public function useCaseToggleFavorite(ToggleFavoriteUseCaseRequest $request): mixed
    {
        $authUser = auth()->user();
        $favoritesArray = $authUser->use_case_favorites ?? [];

        try {
            if ($request->toggle_state == 'true') {
                $favoritesArray = array_unique(array_merge($favoritesArray, [$request->use_case_id]), SORT_NUMERIC);
                $message = __("Successfully marked favorite!");
            } else {
                $favoritesArray = array_diff($favoritesArray, [$request->use_case_id]);
                $message = __("Successfully removed from favorites!");
            }

            $authUser->use_case_favorites = $favoritesArray;
            $authUser->save();
        } catch (Exception $e) {
            return $this->unprocessableResponse([], __("Failed to update favorites! Please try again later."));
        }

        return $this->okResponse([], $message);
    }
}
