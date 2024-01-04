@extends('admin.layouts.app')
@section('page_title', __('Speeches'))

@section('content')
<!-- Main content -->
<div class="col-sm-12 list-container" id="use-case-list-container">
    <div class="card">
        <div class="card-header d-md-flex justify-content-between align-items-center">
            <h5>{{ __('Speeches') }}</h5>
            <div class="d-md-flex mt-2 mt-md-0">

                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#batchDelete"
                    class="btn btn-outline-primary mb-0 custom-btn-small d-none">
                    <span class="feather icon-trash-2 me-1"></span>
                    {{ __('Batch Delete') }} (<span class="batch-delete-count">0</span>)
                </a>

                <button class="btn btn-outline-primary custom-btn-small mb-0 collapsed filterbtn me-0" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel">
                    <span class="fas fa-filter me-1"></span> {{ __('Filter') }}
                </button>
            </div>
        </div>

        <div class="card-header collapse p-0" id="filterPanel">
            <div class="row mx-2 my-2">
                <div class="col-md-3 mb-2 mb-md-0">
                    <select class="select2 filter" name="user_id">
                        <option value="">{{ __('All Users') }}</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select class="select2-hide-search filter" name="language">
                        <option value="">{{ __('All Languages') }}</option>
                        @foreach($languages as $language)
                        <option value="{{ $language->name }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>              
            </div>
        </div>

        <div class="card-body p-0 Content-table need-batch-operation" data-namespace="\Modules\OpenAI\Entities\Speech" data-column="id">
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
