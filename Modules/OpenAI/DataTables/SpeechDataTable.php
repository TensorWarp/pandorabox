<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Speech;

class SpeechDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $speeches = $this->query();

        return DataTables::eloquent($speeches)
            ->editColumn('content', function ($speeches) {
                return trimWords($speeches->content, 60);
            })
            ->editColumn('user_id', function ($speeches) {
                return '<a href="' . route('users.edit', ['id' => $speeches->user_id]) . '">' . wrapIt(optional($speeches->user)->name, 10) . '</a>';
            })
            ->editColumn('file', function ($speeches) {
                return '<audio controls><source src="' . $speeches->audioUrl() . '" download="' . $speeches->file_name . '"></audio>';
            })

            ->editColumn('duration', function ($speeches) {
                return gmdate('H:i:s', $speeches->duration);
            })
            ->editColumn('language', function ($speeches) {
                return ucfirst($speeches->language);
            })
            ->editColumn('created_at', function ($speeches) {
                return timeZoneFormatDate($speeches->created_at);
            })
            ->addColumn('action', function ($speeches) {
                $html = '';
                
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\SpeechToTextController@edit'])) {
                    $html .= '<a title="' . __('Edit :x', ['x' => __('Speech')]) . '" href="' . route('admin.features.speech.edit', ['id' => $speeches->id]) . '" class="btn btn-xs btn-primary me-1"><i class="feather icon-edit"></i></a>';
                }
                    
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\SpeechToTextController@delete'])) {
                    $html .=  '<form method="post" action="' . route('admin.features.speech.delete') . '" id="delete-code-'. $speeches->id . '" accept-charset="UTF-8" class="display_inline">
                                    <input type = "hidden" name = "speechId" value = '. $speeches->id. '>
                                    ' . csrf_field() . '
                                    <button title="' . __('Delete :x', ['x' => __('Speech')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $speeches->id . ' data-label="Delete" data-delete="code" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Speech')]) . '" data-message="' . __('Are you sure to delete this?') . '">

                                        <i class="feather icon-trash-2"></i>
                                    </button>
                                </form>';
                }

                return $html;
            })
            ->rawColumns(['content', 'user_id', 'file', 'duration', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $speeches = Speech::with(['user:id,name', 'user.metas']);

        if (count(request()->query()) > 0) {
            $speeches = $speeches->filter();
        }

        return $this->applyScopes($speeches);
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
            new Column(['data'=> 'content', 'name' => 'content', 'title' => __('Content'), 'searchable' => false, 'orderable' => true, 'width'=>'30%']),
            (new Column(['data'=> 'user_id', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'file', 'name' => 'file', 'title' => __('File'), 'orderable' => false, 'searchable' => false]))->addClass('text-center'),
            (new Column(['data'=> 'language', 'name' => 'language', 'title' => __('Language'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'duration', 'name' => 'duration', 'title' => __('Duration'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false])
        ];
    }

}
