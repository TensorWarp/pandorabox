<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Modules\OpenAI\Entities\ChatBot;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ChatBotsDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $bot = $this->query();

        return DataTables::eloquent($bot)
        ->editColumn('picture', function ($bot) {
            return '<img class="object-fit-cover" src="' . $bot->fileUrl() . '" alt="' . __('image') . '" width="50" height="50">';
        })
        ->editColumn('chat_category_id', function ($bot) {
            return '<a href="' . route('admin.chat.category.edit', ['id' => $bot->chat_category_id]) . '">' . trimWords(ucfirst($bot->chatCategory?->name), 60) . '</a>';
        })
        ->editColumn('name', function ($bot) {
            return ucfirst($bot->name);
        })
        ->editColumn('message', function ($bot) {
            return trimWords($bot->message, 60);
        })
        ->editColumn('role', function ($bot) {
            return ucfirst($bot->role);
        })
        ->editColumn('status', function ($bot) {
            return statusBadges(lcfirst($bot->status));
        })
        ->editColumn('is_default', function ($bot) {                          
            return $bot->is_default == 1 ?  '<span class="badge f-12 default_yes_checking active_color">' . __("Yes") . '</span>' : '<span class="badge f-12 default_no_checking inactive_color">' . __("No") . '</span>';
        })
        ->editColumn('created_at', function ($bot) {
            return timeZoneFormatDate($bot->created_at);
        })
        ->addColumn('action', function ($bot) {
            $html = '';

            if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\ChatAssistantsController@edit'])) {
                $html .= '<a title="' . __('Edit :x', ['x' => __('Chat bot')]) . '" href="' . route('admin.chat.assistant.edit', ['id' => $bot->id]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';
            }

            if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\ChatAssistantsController@destroy']) && $bot->is_default !== 1) {
                $html .= '<form method="get" action="' . route('admin.chat.assistant.destroy') . '" id="delete-content-'. $bot->id . '" accept-charset="UTF-8" class="display_inline">
                            <input type = "hidden" name = "botId" value = '. $bot->id. '>
                            <input type = "hidden" name = "redirect" value = "true">
                            <button title="' . __('Delete :x', ['x' => __('Chat Assitant')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $bot->id . ' data-label="Delete" data-delete="content" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Chat Assistant')]) . '" data-message="' . __('Are you sure to delete this?') . '">

                                <i class="feather icon-trash-2"></i>
                            </button>
                        </form>';
            }

            return $html;
        })
        ->rawColumns([ 'picture', 'chat_category_id', 'status', 'is_default', 'action'])
        ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {

        $bots = ChatBot::with(['chatCategory:id,name']);

        if (count(request()->query()) > 0) {
            $bots = $bots->filter();
        }

        return $this->applyScopes($bots);

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dataTableBuilder')
            ->minifiedAjax()
            ->selectStyleSingle()
            ->columns($this->getColumns())
            ->parameters(dataTableOptions());
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            new Column(['data'=> 'id', 'name' => 'id', 'title' => '', 'visible' => false, 'width' => '0%' ]),
            new Column(['data' => 'picture', 'name' => 'picture', 'title' => __('Picture'), 'orderable' => false, 'searchable' => false]),
            new Column(['data'=> 'chat_category_id', 'name' => 'chatCategory.name', 'title' => __('Category Name'), 'searchable' => true]),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'orderable' => true]),
            (new Column(['data'=> 'message', 'name' => 'message', 'title' => __('Message'), 'orderable' => true, 'searchable' => true, 'width' => '15%' ]))->addClass('text-center'),
            (new Column(['data'=> 'role', 'name' => 'role', 'title' => __('Role'), 'orderable' => true, 'searchable' => true, 'width' => '10%']))->addClass('text-center'),
            (new Column(['data'=> 'status', 'name' => 'status', 'title' => __('Status'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'is_default', 'name' => 'is_default', 'title' => __('Default'), 'orderable' => true, 'searchable' => true, 'width' => '10%' ]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false, 'width' => '10%' ]))->addClass('text-center'),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false])
        ];
    }

}
