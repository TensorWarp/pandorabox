<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\ChatCategory;

class ChatCategoriesDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $chatCategories = $this->query();

        return DataTables::eloquent($chatCategories)
            ->editColumn('name', function ($chatCategories) {
                return trimWords($chatCategories->name, 60);
            })
            ->editColumn('description', function ($chatCategories) {
                return trimWords($chatCategories->description, 60);
            })
            ->addColumn('action', function ($chatCategories) {
                $html = '';

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\ChatCategoriesController@edit'])) {
                    $html .= '<a title="' . __('Edit :x', ['x' => __('Chat')]) . '" href="' . route('admin.chat.category.edit', ['id' => $chatCategories->id]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';
                }

                if ($chatCategories->slug !== 'others' && $this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\ChatCategoriesController@destroy'])) {
                    $html .= '<form method="post" action="' . route('admin.chat.category.destroy', ['id' => $chatCategories->id]) . '" id="delete-use-case-category-'. $chatCategories->id . '" accept-charset="UTF-8" class="display_inline">
                                    ' . csrf_field() . '
                                    <button title="' . __('Delete :x', ['x' => __('Chat')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $chatCategories->id . ' data-label="Delete" data-delete="use-case-category" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Chat Category')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                        <i class="feather icon-trash-2"></i>
                                    </button>
                                </form>';
                }

                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $categories = ChatCategory::query();

        return $this->applyScopes($categories);
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
            new Column(['data'=> 'id', 'name' => 'id', 'title' => '', 'visible' => false, 'width' => '0%']),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'width' => '45%']),
            new Column(['data'=> 'description', 'name' => 'description', 'title' => __('Description'), 'searchable' => true, 'width' => '45%']),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false, 'width' => '10%'])
        ];
    }

}
