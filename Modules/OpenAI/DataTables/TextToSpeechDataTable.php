<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Audio;

class TextToSpeechDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $audio = $this->query();

        return DataTables::eloquent($audio)
            ->editColumn('prompt', function ($audio) {
                return '<a href="' . route('admin.features.code.view', ['slug' => $audio->slug]) . '">' . trimWords(ucfirst($audio->prompt), 60) . '</a>';
            })
            ->editColumn('user_id', function ($audio) {
                return '<a href="' . route('users.edit', ['id' => $audio->user_id]) . '">' . optional($audio->user)->name . '</a>';
            })
            ->editColumn('language', function ($audio) {
                return $audio->language;
            })
            ->editColumn('gender', function ($audio) {
                return $audio->gender;
            })
            ->editColumn('created_at', function ($audio) {
                return timeZoneFormatDate($audio->created_at);
            })
            ->addColumn('action', function ($audio) {

                $html = '<a title="' . __('Show') . '" href="' . route('admin.features.textToSpeech.view', ['slug' => $audio->slug]) . '" class="btn btn-xs btn-outline-dark" data-toggle="modal" data-target="#exampleModalLong"><i class="feather icon-eye"></i></a>&nbsp';
                if ($this->hasPermission(['Modules\OpenAI\Http\Controllers\Admin\TextToSpeechController@delete'])) {
                    $html .= '<form method="post" action="' . route('admin.features.textToSpeech.delete') . '" id="delete-code-'. $audio->id . '" accept-charset="UTF-8" class="display_inline">
                                <input type = "hidden" name = "audioId" value = '. $audio->id. '>
                                ' . csrf_field() . '
                                <button title="' . __('Delete :x', ['x' => __('Text To Speech')]) . '" class="btn btn-xs btn-danger confirm-delete" type="button" data-id=' . $audio->id . ' data-label="Delete" data-delete="code" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Text To Speech')]) . '" data-message="' . __('Are you sure to delete this?') . '">

                                    <i class="feather icon-trash-2"></i>
                                </button>
                            </form>';
                }
                
                return $html;
            })
            ->rawColumns(['prompt', 'slug', 'user_id', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $audio = Audio::with(['user:id,name', 'user.metas']);

        if (count(request()->query()) > 0) {
            $audio = $audio->filter();
        }

        return $this->applyScopes($audio);
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
            new Column(['data'=> 'prompt', 'name' => 'prompt', 'title' => __('Promt'), 'searchable' => true, 'width' => '30%' ]),
            new Column(['data'=> 'language', 'name' => 'language', 'title' => __('Language'), 'searchable' => false, 'orderable' => true]),
            new Column(['data'=> 'gender', 'name' => 'gender', 'title' => __('Gender'), 'searchable' => false, 'orderable' => true]),
            (new Column(['data'=> 'user_id', 'name' => 'user.name', 'title' => __('Creator'), 'orderable' => true, 'searchable' => true]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            (new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false, 'width' => '10%']))->addClass('text-center'),
        ];
    }

}
