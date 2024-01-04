<?php

namespace Modules\OpenAI\DataTables;

use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Modules\OpenAI\Entities\Voice;
use App\Models\Language;

class VoiceDataTable extends DataTable
{

    /**
     * Display ajax response
     *
     * @return JsonResponse
     */
    public function ajax(): JsonResponse
    {
        $voice = $this->query();

        return DataTables::eloquent($voice)
            ->addColumn('image', function ($voice) {
                return '<img src="' . $voice->fileUrl() . '" alt="' . __('image') . '" class ="data-table-image object-fit-cover">';
            })
            ->editColumn('name', function ($voice) {
                return '<a href="' . route('admin.features.textToSpeech.voice.edit', ['id' => $voice->id]) . '">' . trimWords(ucfirst($voice->name), 60) . '</a>';
            })
            ->editColumn('language', function ($voice) {
                $name = explode('-', $voice->language_code);
                $shortName = ($name[0] == 'yue') ? 'zh' : $name[0];
                return Language::where('short_name', $shortName)->value('name') ?? $voice->language_code;
            })
            ->editColumn('gender', function ($voice) {
                return $voice->gender;
            })
            ->editColumn('created_at', function ($voice) {
                return timeZoneFormatDate($voice->created_at);
            })
            ->addColumn('status', function ($voice) {
                return statusBadges(lcfirst($voice->status));
            })
            ->addColumn('action', function ($voice) {
                return '<a title="' . __('Edit') . '" href="' . route('admin.features.textToSpeech.voice.edit', ['id' => $voice->id]) . '" class="btn btn-xs btn-outline-dark" data-toggle="modal" data-target="#exampleModalLong"><i class="feather icon-edit"></i></a>&nbsp';
            })
            ->rawColumns(['image', 'name', 'status', 'action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @return QueryBuilder
     */
    public function query(): QueryBuilder
    {
        $voice = Voice::query();

        if (count(request()->query()) > 0) {
            $voice = $voice->filter();
        }

        return $this->applyScopes($voice);
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
            new Column(['data'=> 'image', 'name' => 'image', 'title' => __('Image'), 'searchable' => false ]),
            new Column(['data'=> 'name', 'name' => 'name', 'title' => __('Name'), 'searchable' => true, 'width' => '30%' ]),
            new Column(['data'=> 'language', 'name' => 'language_code', 'title' => __('Language'), 'searchable' => false, 'orderable' => false]),
            new Column(['data'=> 'gender', 'name' => 'gender', 'title' => __('Gender'), 'searchable' => true, 'orderable' => true]),
            (new Column(['data'=> 'status', 'name' => 'status', 'title' => __('Status'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            (new Column(['data'=> 'created_at', 'name' => 'created_at', 'title' => __('Created At'), 'orderable' => true, 'searchable' => false]))->addClass('text-center'),
            (new Column(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'visible' => true, 'orderable' => false, 'searchable' => false, 'width' => '10%']))->addClass('text-center'),
        ];
    }

}
