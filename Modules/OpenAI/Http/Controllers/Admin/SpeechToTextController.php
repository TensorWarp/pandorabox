<?php

namespace Modules\OpenAI\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OpenAI\DataTables\SpeechDataTable;
use Modules\OpenAI\Services\SpeechToTextService;

class SpeechToTextController extends Controller
{
    protected $speechToTextService;

    public function __construct(SpeechToTextService $speechToTextService)
    {
        $this->speechToTextService = $speechToTextService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  SpeechDataTable  $dataTable
     * @return mixed
     */
    public function index(SpeechDataTable $dataTable)
    {
        $data['languages'] = $this->speechToTextService->languages();
        $data['users'] = $this->speechToTextService->users();
        return $dataTable->render('openai::admin.speech.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $data = ['status' => 'fail', 'message' => __('The action that you are trying to perform is not available.')];
        $data['speech'] = $this->speechToTextService->speechByID($id);
        if (empty($data['speech'])) {
            \Session::flash($data['status'], $data['message']);
            return redirect()->back();
        }
        
        return view('openai::admin.speech.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = ['status' => 'fail', 'message' => __('The action that you are trying to perform is not available.')];

        if ($this->speechToTextService->speechUpdate($request->only('content', 'id'))) {
            $data = ['status' => 'success', 'message' => __('Speech update successfully!')];
        }

        \Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.speeches');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Renderable
     */
    public function delete(Request $request)
    {
        
        $data = [ 'status' => 'failed', 'message' => __('The data you are looking for is not found')];
        $service = $this->speechToTextService->delete($request->speechId);

        if ($service) {
            $data = ['status' => 'success','message' => __('The :x has been successfully deleted', ['x' => 'Speech'])];
        }

        \Session::flash($data['status'], $data['message']);
        return redirect()->route('admin.features.speeches');
    }
}
