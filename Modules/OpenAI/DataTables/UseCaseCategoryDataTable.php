<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Modules\OpenAI\Entities\UseCaseCategory;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UseCaseCategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query
     * @return EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id');
    }

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $useCaseCategories = $this->query();

        return DataTables::eloquent($useCaseCategories)
            ->editColumn('name', function ($useCaseCategory) {
                return trimWords($useCaseCategory->name, 60);
            })
            ->editColumn('description', function ($useCaseCategory) {
                return trimWords($useCaseCategory->description, 60);
            })
            ->addColumn('action', function ($useCaseCategory) {
                $html = '';
                $edit = '<a title="' . __('Edit :x', ['x' => __('useCase')]) . '" href="' . route('admin.use_case.category.edit', ['id' => $useCaseCategory->id]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\UseCaseCategoriesController@edit'])) {
                    $html .= $edit;
                }

                if ( $useCaseCategory->slug !== 'others' ) {
                    $delete = '<form method="post" action="' . route('admin.use_case.category.destroy', ['id' => $useCaseCategory->id]) . '" id="delete-use-case-category-'. $useCaseCategory->id . '" accept-charset="UTF-8" class="display_inline">
                                    ' . csrf_field() . '
                                    <button title="' . __('Delete :x', ['x' => __('Use Case')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $useCaseCategory->id . ' data-label="Delete" data-delete="use-case-category" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Use Case Category')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                        <i class="feather icon-trash-2"></i>
                                    </button>
                                </form>';
                    if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\UseCaseCategoriesController@destroy'])) {
                        $html .= $delete;
                    }
                }

                return $html;
            })
            ->rawColumns(['image', 'name', 'description', 'creator_type', 'creator', 'status', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $categories = UseCaseCategory::query();

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
            ->orderBy(1)
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'UseCases_' . date('YmdHis');
    }
}
