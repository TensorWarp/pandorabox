<?php


namespace Modules\OpenAI\Http\Controllers\Api\V1\admin;

use Exception;
use Illuminate\Http\Request;
use App\Traits\ModelTraits\Filterable;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Entities\UseCaseCategory;
use Modules\OpenAI\Transformers\Api\V1\UseCaseCategoryResource;

class UseCaseCategoriesController extends Controller
{

     use Filterable;
     
    public function index(Request $request): mixed
    {
        $configs        = $this->initialize([], $request->all());
        $categories = UseCaseCategory::query()->orderBy('id', 'DESC')->paginate($configs['rows_per_page']);
        $responseData = UseCaseCategoryResource::collection($categories)->response()->getData(true);

        return $this->response($responseData);
    }

    public function create(): mixed
    {
        $request = app('Modules\OpenAI\Http\Requests\UseCaseCategoryRequest')->safe();

        try {
            if ($useCaseCategory = UseCaseCategory::create($request->all())) {
                return $this->createdResponse(new UseCaseCategoryResource($useCaseCategory), __('Use case category created successfully!'));
            }
        } catch(Exception $e) {
            $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
            return $this->unprocessableResponse($data);
        }
    }

    public function show($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }

        if ($useCaseCategory = UseCaseCategory::find($id)) {
            return $this->okResponse(new UseCaseCategoryResource($useCaseCategory));
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Category')]));
    }

    public function edit($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }

        $request = app('Modules\OpenAI\Http\Requests\UseCaseCategoryRequest')->safe();

        if ($useCaseCategory = UseCaseCategory::find($id)) {
            try {
                if ($useCaseCategory->update($request->all())) {
                    return $this->okResponse(new UseCaseCategoryResource($useCaseCategory), __('Use case category updated successfully!'));
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

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Category')]));
    }

    public function destroy($id): mixed
    {
        if (!is_numeric($id)) {
            return $this->forbiddenResponse([], __('Invalid Request!'));
        }

        if ($useCaseCategory = UseCaseCategory::find($id)) {
            try {
                $useCaseCategory->delete();
                return $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Use Case Category')]));
            } catch (Exception $e) {
                $response = $e->getMessage();
                $data = [
                    'response' => $response,
                    'status' => 'failed',
                ];
                return $this->unprocessableResponse($data);
            }
        }

        return $this->notFoundResponse([], __('No :x found.', ['x' => __('Use Case Category')]));
    }
}
