<?php
namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Http\Resources\CodeResource;
use Modules\OpenAI\Services\CodeService;

class CodeController extends Controller
{

    protected $codeService;

    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function saveCode($code)
    {
        return $this->codeService->save($code);
    }

    public function index(Request $request)
    {
        $configs        = $this->initialize([], $request->all());
        $codes = $this->codeService->model()->orderBy('id', 'DESC');

        if (auth('api')->user()->role()->type !== 'admin') {
            $codes = $codes->where('user_id', auth('api')->user()->id);
        }

        if (count(request()->query()) > 0) {
            $codes = $codes->filter();
        }

        $contents = $codes->with(['User:id,name'])->paginate($configs['rows_per_page']);
        return $this->response(CodeResource::collection($contents)->response()->getData(true));
    }

    public function view($slug)
    {
        $code = $this->codeService->codeBySlug($slug);
        return !empty($code) ? $this->okResponse(new CodeResource($code)) : $this->notFoundResponse([], );
    }

    public function delete($id)
    {
        return $this->codeService->delete($id) ? $this->okResponse([], __('The :x has been successfully deleted.', ['x' => __('Code')])) : $this->notFoundResponse([], );
    }
}


