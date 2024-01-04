@extends('admin.layouts.app')
@section('page_title', __('Add new Use Case Category'))

@section('css')
<link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
<!-- Main content -->
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>
                <a class="pe-1" href="{{ route('admin.use_case.category.list') }}">{{ __('Use Case Category') }}</a>>>
                <span class="ps-1">{{ __('Add :x', ['x' => __('Category')]) }}</span>
            </h5>
        </div>

        <div class="card-body px-3" id="no_shadow_on_card">
            <div class="col-sm-12 m-t-20 form-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information', ['x' => __('Use Case Category')]) }}</a>
                    </li>
                </ul>

                <div class="card-block table-border-style tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-sm-12">
                            <form action="{{ route('admin.use_case.category.create') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form" onsubmit="return formValidation()" novalidate>
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label require">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="{{ __('Name') }}" class="form-control inputFieldDesign" id="name" name="name" value="{{ old('name') }}" maxlength="191" oninvalid="this.setCustomValidity({{ __('This field is required.') }})" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="first_name"
                                        class="col-sm-2 col-form-label require pr-0">{{ __('Slug') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control inputFieldDesign" id="slug" name="slug" value="{{ !empty(old('slug')) ? old('slug') : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label require">{{ __('Description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea placeholder="{{ __('Description') }}" id="description" class="form-control" name="description" maxlength="1000" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="d-flex justify-items-start mt-4 flex-wrap">
                                        <a href="{{ route('admin.use_case.category.list') }}" class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                        <button class="btn custom-btn-submit" type="submit" id="btnSubmit">
                                            <i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i>
                                            <span id="spinnerText">{{ __('Create') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('mediamanager::image.modal_image')
@endsection

@section('js')
<script>
    'use strict';
    var currentUrl = "{!! url()->full() !!}";
    var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
    var slug = false;
</script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('Modules/OpenAI/Resources/assets/js/admin/use-case-category.min.js') }}"></script>
@endsection
