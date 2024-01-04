<?php
namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\Services\CodeService;
use Modules\OpenAI\DataTables\{
    CodeDataTable
};
use Session;

class CodeController extends Controller
{

    protected $codeService;

    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function index(CodeDataTable $codeDataTable)
    {
        $data['images'] = $this->codeService->getAll();
        $data['users'] = $this->codeService->users();
        return $codeDataTable->render('openai::admin.code.index', $data);
    }

    public function view($slug)
    {
        $service = $this->codeService;
        $data['code'] = $service->codeBySlug($slug);
        return view('openai::admin.code.view', $data);
    }

    public function delete(Request $request)
    {
        $data = [
            'status' => 'failed',
            'message' => __('The data you are looking for is not found')
        ];

        $service = $this->codeService->delete($request->codeId);
        if ($service) {
            $data = [
                'status' => 'success',
                'message' => __('Code deleted successfully')
            ];
        }
        Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.code.list');
    }

    public function saveCode($code)
    {
        return $this->codeService->save($code);
    }
}


