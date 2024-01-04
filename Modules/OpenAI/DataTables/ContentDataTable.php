<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Content;

class ContentDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $contents = $this->query();

        return DataTables::eloquent($contents)
            ->editColumn('use_case_id', function ($contents) {
                return trimWords(optional($contents->useCase)->name, 60);
            })
            ->editColumn('user_id', function ($contents) {
                return '<a href="' . route('users.edit', ['id' => $contents->user_id]) . '">' . wrapIt(optional($contents->user)->name, 10) . '</a>';
            })
            ->editColumn('content', function ($contents) {
                return trimWords($contents->content, 60);
            })

            ->editColumn('model', function ($contents) {
                return ucfirst($contents->model);
            })
            ->editColumn('language', function ($contents) {
                return ucfirst($contents->language);
            })
            ->editColumn('created_at', function ($contents) {
                return timeZoneFormatDate($contents->created_at);
            })
            ->addColumn('action', function ($contents) {
                $html = '';
                $edit = '<a title="' . __('Edit :x', ['x' => __('Content')]) . '" href="' . route('admin.features.content.edit', ['slug' => $contents->slug]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';
                $delete = '<form method="get" action="' . route('admin.features.content.delete') . '" id="delete-content-'. $contents->id . '" accept-charset="UTF-8" class="display_inline">
                                <input type = "hidden" name = "contentId" value = '. $contents->id. '>
                                <input type = "hidden" name = "redirect" value = "true">
                                <button title="' . __('Delete :x', ['x' => __('Content')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $contents->id . ' data-label="Delete" data-delete="content" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Content')]) . '" data-message="' . __('Are you sure to delete this?') . '">

                                    <i class="feather icon-trash-2"></i>
                                </button>
                            </form>';

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\OpenAIController@edit'])) {
                    $html .= $edit;
                }

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\OpenAIController@delete'])) {
                    $html .= $delete;
                }

                return $html;
            })
            ->rawColumns(['image', 'content', 'model', 'user_id', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $contents = Content::with(['user:id,name', 'useCase:id,slug,name', 'user.metas'])->whereNull(['parent_id']);

        if (count(request()->query()) > 0) {
            $contents = $contents->filter();
        }

        return $this->applyScopes($contents);
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
            new Column(['data'=> 'use_case_id', 'name' => 'useCase.name', 'title' => __('Template'), 'searchable' => true, 'width'=>'30%']),
            new Column(['data'=> 'content', 'name' => 'content', 'title' => __('Description'), 'searchable' => false, 'orderable' => false, 'width'=>'30%']),
            (new Column(['data'=> 'user_id', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'model', 'name' => 'model', 'title' => __('Model'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'language', 'name' => 'language', 'title' => __('Language'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false])
        ];
    }

}
