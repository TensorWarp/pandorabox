@extends('admin.layouts.app')
@section('page_title', __('Chat Categories'))
@section('css')
@endsection

@section('content')
<!-- Main content -->
<div class="col-sm-12 list-container" id="use-case-category-list-container">
    <div class="card">
        <div class="card-header d-md-flex justify-content-between align-items-center">
            <h5>{{ __('Chat Categories') }}</h5>
            <div class="d-md-flex mt-2 mt-md-0 justify-content-end align-items-center">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#batchDelete" class="btn btn-outline-primary mb-0 custom-btn-small d-none">
                    <span class="feather icon-trash-2 me-1"></span>
                    {{ __('Batch Delete') }} (<span class="batch-delete-count">0</span>)
                </a>
                @if (in_array('Modules\OpenAI\Http\Controllers\Admin\ChatCategoriesController@create', $prms))
                    <a href="{{ route('admin.chat.category.create') }}" class="btn btn-outline-primary mb-0 custom-btn-small">
                        <span class="fa fa-plus pe-2"></span>{{ __('Add :x', ['x' => __('Chat Category')]) }}
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body p-0 need-batch-operation"
        data-namespace="\Modules\OpenAI\Entities\ChatCategory" data-column="id">
            <div class="card-block pt-2 px-2">
                <div class="col-sm-12 form-tabs px-3">
                    @include('admin.layouts.includes.yajra-data-table')
                </div>
            </div>
        </div>
        @include('admin.layouts.includes.delete-modal')
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    'use strict';
    var pdf = "0";
    var csv = "0";
</script>

<script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
@endsection
