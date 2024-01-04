<?php

namespace Modules\OpenAI\Http\Controllers\Admin;

Use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Entities\ChatBot;
use Modules\OpenAI\DataTables\ChatBotsDataTable;
use Modules\OpenAI\Entities\ChatCategory;

class ChatAssistantsController extends Controller
{
    /**
     * Company Setting Constructor
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //this middleware should be for POST request only
        if ($request->isMethod('post')) {
            $this->middleware('checkForDemoMode')->only('create', 'edit');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  ChatBotsDataTable  $dataTable
     * @return mixed
     */
    public function index(ChatBotsDataTable $dataTable)
    {
        $data['categories'] = ChatCategory::get();
        return $dataTable->render('openai::admin.chat-assistant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {

        if (request()->isMethod('POST')) {
            $this->store();
            return to_route('admin.chat.assistant.list');
        }

        $data['categories'] = ChatCategory::get();
        return view('openai::admin.chat-assistant.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return mixed
     */
    public function store()
    {
        try {
            $request = app('Modules\OpenAI\Http\Requests\ChatBotRequest')->safe();

            if ($request->is_default === '1' && $request->status == 'Inactive') {
                return back()->withFail(__("Default Chat assistant status can't be inactive."));
            }

            DB::beginTransaction();

            if ((new ChatBot)->store($request->only('chat_category_id', 'name', 'code', 'message', 'role', 'promt', 'status', 'is_default'))) {
                DB::commit();
                $this->setSessionValue(['status' => 'success', 'message' => __('The :x has been successfully created.', ['x' => __('Chat Assistant')])]);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        if (request()->isMethod('POST')) {
            $this->update($id);
            return to_route('admin.chat.assistant.list');
        }

        $data['chatBot'] = ChatBot::find($id);

        if ( !empty($data['chatBot']) ) {

            $data['categories'] = ChatCategory::get();
            return view('openai::admin.chat-assistant.edit', $data);
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int|string  $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $request = app('Modules\OpenAI\Http\Requests\ChatBotRequest')->safe();

            if ($request->is_default === '1' && $request->status == 'Inactive') {
                return back()->withFail(__("Default Chat assistant status can't be inactive."));
            }

            $default = ChatBot::where('is_default', 1)->where('id', '!=', $id)->count();

            if ($request->is_default === '0' && $default == 0) {
                return back()->withFail(__("No default Chat assistant found. At least one assistant need to be Default."));
            }

            DB::beginTransaction();

            if ((new ChatBot)->updateBot($request->only('chat_category_id', 'name', 'code', 'message', 'role', 'promt', 'status', 'is_default'), $id)) {
                DB::commit();
                $this->setSessionValue(['status' => 'success', 'message' => __('The :x has been successfully updated.', ['x' => __('Chat Assistant')])]);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return mixed
     */
    public function destroy(Request $request)
    {
        if (!is_numeric($request->botId)) {
            abort(404);
        }

        $chatBot = ChatBot::find($request->botId);

        if ($chatBot) {

            try {

                DB::beginTransaction();
                $chatBot->delete();
                DB::commit();

                $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Chat Assistant')])];

            } catch (\Exception $e) {
                DB::rollBack();
                $response = ['status' => 'fail', 'message' => __('Something went wrong.')];
            }

            $this->setSessionValue($response);
            return to_route('admin.chat.assistant.list');

        }

        abort(404);
    }
}
