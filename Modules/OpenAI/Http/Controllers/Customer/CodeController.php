<?php
namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\CodeService;

class CodeController extends Controller
{
    protected $codeService;

    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function index()
    {
        $service = $this->codeService;
        $data['codes'] = $service->getAll()->paginate(preference('row_per_page'));
        return view('openai::blades.codes.list', $data);
    }

    public function view($slug)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found.')];
        $service = $this->codeService;
        $data['code'] = $service->codeBySlug($slug);

        if (empty($data['code'])) {
            \Session::flash($response['status'], $response['message']);
            return redirect()->route('user.codeList');
        }
        $data['splitedCode'] = explode("```", $data['code']->code);
        $data['meta'] = $this->codeService->getMeta('code_writer');
        return view('openai::blades.codes.view', $data);
    }

    public function delete(Request $request)
    {
        $response = ['status' => 'error', 'message' => __('The data you are looking for is not found')];

        if ($this->codeService->delete($request->id)) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Code')])];
        }

        return response()->json($response);
    }
    public function saveCode($code)
    {
        return $this->codeService->save($code);
    }
}


