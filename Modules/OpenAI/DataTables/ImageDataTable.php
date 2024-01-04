<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Image;

class ImageDataTable extends DataTable
{
    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $images = $this->query();

        return DataTables::eloquent($images)
            ->addColumn('image', function ($images) {
                return '<img src="' .  $images->imageUrl(['thumbnill' => true, 'size' => 'small'])  . '" alt="' . __('image') . '" class ="data-table-image">';
            })
            ->editColumn('user_id', function ($images) {
                return '<a href="' . route('users.edit', ['id' => $images->user_id]) . '">' . wrapIt(optional($images->user)->name, 10) . '</a>';
            })
            ->editColumn('name', function ($images) {
                return trimWords($images->name, 40);
            })
            ->editColumn('size', function ($images) {
                return $images->size;
            })

            ->editColumn('created_at', function ($images) {
                return timeZoneFormatDate($images->created_at);
            })
            ->addColumn('action', function ($images) {
                $html = '';
                $show = '<a title="' . __('Download') . '" href="' . $images->imageUrl() . '" download="'.  $images->name .'" class="btn btn-xs btn-outline-dark"><i class="feather icon-download"></i></a>&nbsp';
                $delete ='<form method="post" action="' . route('admin.features.deleteImage', ['id' => $images->id]) . '" id="delete-image-'. $images->id . '" accept-charset="UTF-8" class="display_inline">
                                ' . csrf_field() . '
                                <button title="' . __('Delete :x', ['x' => __('Image')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $images->id . ' data-label="Delete" data-delete="image" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Image')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                                    <i class="feather icon-trash-2"></i>
                                </button>
                            </form>';

                    $html .= $delete . $show;

                return $html;
            })
            ->rawColumns(['image', 'user_id', 'name', 'size', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $images = Image::select('images.*')->with(['user:id,name', 'user.metas']);

        if (count(request()->query()) > 0) {
            $images = $images->filter();
        }

        return $this->applyScopes($images);
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
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'orderable' => true]),
            (new Column(['data'=> 'user_id', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'size', 'name' => 'size', 'title' => __('Size'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false])
        ];
    }

}
