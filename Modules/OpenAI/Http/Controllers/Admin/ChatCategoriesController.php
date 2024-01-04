<?php


namespace Modules\OpenAI\Http\Controllers\Admin;

Use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\OpenAI\Entities\ChatCategory;
use Modules\OpenAI\DataTables\ChatCategoriesDataTable;


class ChatCategoriesController extends Controller
{
    public function __construct(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->middleware('checkForDemoMode')->only('create', 'edit');
        }
    }

    public function index(ChatCategoriesDataTable $dataTable)
    {
        return $dataTable->render('openai::admin.chat-category.index');
    }

    public function create()
    {
        if (request()->isMethod('POST')) {
            $this->store();
            return to_route('admin.chat.category.list');
        }

        return view('openai::admin.chat-category.create');
    }

    public function store()
    {
        $response = ['status' => 'fail', 'message' => __('Something went wrong!')];
        $request = app('Modules\OpenAI\Http\Requests\ChatCategoryRequest')->safe();

        if (ChatCategory::create($request->all())) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully created.', ['x' => __('Chat Category')])];
        }

        $this->setSessionValue($response);
    }

    public function edit($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        if (request()->isMethod('POST')) {
            $this->update($id);
            return to_route('admin.chat.category.list');
        }

        if ($chatCategory = ChatCategory::find($id)) {
            return view('openai::admin.chat-category.edit', compact('chatCategory'));
        }

        abort(404);
    }

    public function update($id)
    {
        try {
            $request = app('Modules\OpenAI\Http\Requests\ChatCategoryRequest')->safe();
            $useCaseCategory = ChatCategory::find($id);

            if (!$useCaseCategory) {
                throw new \Exception(__('Chat category not found'));
            }

            if ($useCaseCategory->slug == 'others') {
                unset($request['slug']);
            }

            $useCaseCategory->update($request->all());

            $this->setSessionValue(['status' => 'success', 'message' => __('The :x has been successfully updated.', ['x' => __('Chat Category')])]);
        } catch (\Exception $e) {
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {

        if (!is_numeric($id)) {
            abort(404);
        }

        $chatCategory = ChatCategory::find($id);

        if ($chatCategory->slug === "others") {
            return redirect()->back()->withFail(__('Invalid Request!'));
        }
        
        if ($chatCategory) {

            try {

                DB::beginTransaction();
                $id = ChatCategory::where('slug', 'others')->value('id');
                $chatCategory->chatBots()->update(['chat_category_id' => $id]);
                $chatCategory->delete();
                DB::commit();

                $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Chat Category')])];

            } catch (\Exception $e) {
                DB::rollBack();
                $response = ['status' => 'fail', 'message' => __('Something went wrong.')];
            }

            $this->setSessionValue($response);
            return to_route('admin.chat.category.list');

        }

        abort(404);
    }
}
