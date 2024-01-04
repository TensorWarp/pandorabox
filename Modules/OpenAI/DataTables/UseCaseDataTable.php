<?php

namespace Modules\OpenAI\DataTables;

use App\Models\User;
use App\Traits\ModelTraits\Filterable;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Modules\OpenAI\Entities\UseCase;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Content;

class UseCaseDataTable extends DataTable
{
    use Filterable;

    /**
     * Content Ids
     *
     * @var array
     */
    private $contentIds = [];

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
        $useCases = $this->query();

        return DataTables::eloquent($useCases)
            ->addColumn('image', function ($useCase) {
                return '<img src="' . $useCase->fileUrl() . '" alt="' . __('image') . '" class ="data-table-image">';
            })
            ->editColumn('name', function ($useCase) {
                return trimWords($useCase->name, 60);
            })
            ->editColumn('description', function ($useCase) {
                return Str::of($useCase->description)->limit(50);
            })
            ->editColumn('creator', function ($useCase) {
                return '<a href="' . route('users.edit', ['id' => $useCase->creator_id]) . '">' . optional($useCase->user)->name . '</a>';
            })
            ->editColumn('status', function ($useCase) {
                return statusBadges(lcfirst($useCase->status));
            })
            ->addColumn('action', function ($useCase) {
                $html = '';
                $edit = '<a title="' . __('Edit :x', ['x' => __('Use Case')]) . '" href="' . route('admin.use_case.edit', ['id' => $useCase->id]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';
                $delete = '<form method="post" action="' . route('admin.use_case.destroy', ['id' => $useCase->id]) . '" id="delete-use-case-'. $useCase->id . '" accept-charset="UTF-8" class="display_inline">
                                ' . csrf_field() . '
                                <button title="' . __('Delete :x', ['x' => __('Use Case')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $useCase->id . ' data-label="Delete" data-delete="use-case" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Use Case')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                    <i class="feather icon-trash-2"></i>
                                </button>
                            </form>';

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\UseCasesController@edit'])) {
                    $html .= $edit;
                }

                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\UseCasesController@destroy']) && !in_array($useCase->id, $this->contentIds)) {
                    $html .= $delete;
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
        $this->contentIds = Content::pluck('use_case_id')->toArray();
        
        $useCases = UseCase::with(['user', 'user.metas']);

        if (count(request()->query()) > 0) {
            $useCases = $this->scopeFilter($useCases, 'Modules\\OpenAI\\Filters\\UseCaseFilter');
        }

        return $this->applyScopes($useCases);
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
            new Column(['data'=> 'image', 'name' => 'image', 'title' => __('Image'), 'orderable' => false, 'searchable' => false]),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'width'=>'30%' ]),
            new Column(['data'=> 'description', 'name' => 'description', 'title' => __('Description'), 'searchable' => true, 'width'=>'30%' ]),
            (new Column(['data'=> 'creator', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => false]))->addClass('text-center'),
            new Column(['data'=> 'status', 'name' => 'status', 'title' => __('Status')]),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false])
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
