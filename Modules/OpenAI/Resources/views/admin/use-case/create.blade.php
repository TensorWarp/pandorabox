@extends('admin.layouts.app')
@section('page_title', __('Add new Use Case'))

@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <a class="pe-1" href="{{ route('admin.use_case.list') }}">{{ __('Use Case') }}</a>>>
                    <span class="ps-1">{{ __('Add :x', ['x' => __('Use Case')]) }}</span>
                </h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab"
                                href="#home" role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Use Case')]) }}</a>
                        </li>
                    </ul>

                    <div class="card-block table-border-style tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.use_case.create') }}" method="post"
                                    class="form-horizontal" enctype="multipart/form-data" id="form" onsubmit="return formValidation()" novalidate>
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-sm-2 col-form-label require">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{ __('Name') }}"
                                                class="form-control inputFieldDesign" id="name" name="name"
                                                value="{{ old('name') }}" maxlength="150"
                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-sm-2 col-form-label require mt-2 mt-sm-0">{{ __('Slug') }}</label>
                                        <div class="col-sm-10">
                                            <span id="slug-span" class="form-label ms-md-2">(auto-generated)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-2 col-form-label require">{{ __('Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea placeholder="{{ __('Description') }}" id="description" class="form-control" name="description" minlength="5"
                                                data-min-length="{{ __('Description should be at least 5 characters.') }}" maxlength="1000"
                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label require"> {{ __('User Input Fields') }} </label>
                                        <div class="col-sm-10">
                                            <div class="row dynamic_field">
                                                <input type="hidden" name="optionId" id="optionId" value='2'>
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <input type="text" class="form-control inputFieldDesign new-field" name="names[]" id="input-field-1" placeholder="{{ __('Label Name') }}" maxlength="191" oninput="addButton(this)" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                    <input type="hidden" name="variable_names[]" id="variable_names">
                                                </div>
                                                
                                                <div class="col-xl-4 col-md-6 col-12 mt-2 mt-md-0">
                                                    <input type="text" class="form-control inputFieldDesign new-field" id="description-1" placeholder="{{ __('Placeholder Description') }}" maxlength="191" name="descriptions[]" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                </div>
                                                <div class="col-xl-3 col-md-6 col-12 mt-2 mt-xl-0">
                                                    <select class="form-select form-control inputFieldDesign new-field sl_common_bx" id="type-1"  name="type[]" id="type">
                                                        <option value="" selected>{{ __('Select One') }}</option>
                                                        <option value="text"> {{ __('Input Field') }}</option>
                                                        <option value="textarea"> {{ __('Textarea Field') }}</option>
                                                    </select>
                                                </div>								
                                                <span onclick="removeFields(this)" class="input-group-text bg-transparent cursor_pointer rounded h-40 col-xl-1 col-md-6 col-12 w-auto mt-2 mt-xl-0 ms-2">
                                                    <i class="feather icon-trash-2"></i>
                                                </span>
                                            </div>
                                            <div id="field-container"></div>
                                            <div class="col-12 mt-3">
                                                <button type="button" class="btn btn-primary btn-sm add-new-widget-title add-btn inputFieldDesign" onclick="addFields(this)"><i class="fa fa-plus"></i> {{ __('Add New') }}</button>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label for="input_template"
                                            class="col-sm-2 col-form-label require">{{ __('API Input Template') }}</label>
                                        <div class="col-sm-10">
                                            <div id="field-button">
                                                <span onclick="insertText(this)" id="input-field-1-button" class="btn btn-primary mr-4 mb-2">input-field-1</span>
                                            </div>
                                            <textarea placeholder="{{ __('Input template') }}" id="input_template" class="form-control" name="input_template"
                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ old('input_template') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label"></label>
                                        <div class="col-sm-10">
                                            <div class="d-flex align-items-start">
                                                <span class="badge badge-danger h-100 mt-1">{{ __('Note') }}!</span>
                                                <div class="d-flex flex-column col-sm-12">
                                                    <span
                                                        class="px-4">{{ __('Write your use case template that will be passed to API. You are allowed to add or remove [[variable_name]], and you can also rearrange them as needed. But you can not change the [[variable_name]].') }}</span>
                                                    <span class="px-4">{{ __('Keep character limit in mind.') }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category"
                                            class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                                        <div class="col-sm-10">
                                            <select multiple class="form-control select2 ajax_category inputFieldDesign"
                                                name="category_id_array[]">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row preview-parent">
                                        <label class="col-sm-2 form-label mt-2 mt-sm-0">{{ __('Image') }}</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file position-relative media-manager-img" data-val="single"
                                                data-returntype="ids" id="image-status">
                                                <input class="custom-file-input is-image form-control inputFieldDesign"
                                                    name="custom_file_input">
                                                <label class="custom-file-label overflow_hidden d-flex align-items-center"
                                                    for="validatedCustomFile">{{ __('Upload image') }}</label>
                                            </div>
                                            <div class="preview-image" id="#">
                                                <!-- img will be shown here -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label"></label>
                                        <div class="col-sm-10">
                                            <div class="d-flex align-items-start mt-2">
                                                <span class="badge badge-danger">{{ __('Note') }}!</span>
                                                <div class="d-flex flex-column col-sm-12">
                                                    <span
                                                        class="px-4">{{ __('Allowed File Extensions: jpg, png, gif, bmp and Maximum File Size :x MB', ['x' => preference('file_size')]) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="use_case_status"
                                            class="col-sm-2 col-form-label require">{{ __('Status') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control  select2 inputFieldDesign" name="status"
                                                id="use_case_status" aria-label="Status select">
                                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="d-flex justify-items-start mt-4 flex-wrap">
                                            <a href="{{ route('admin.use_case.list') }}"
                                                class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                            <button class="btn custom-btn-submit" type="submit" id="btnSubmit">
                                                <i
                                                    class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i>
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
        var searchCategoryUrl = "{{ $searchCategoryUrl }}";
    </script>
    <script src="{{ asset('public/datta-able/plugins/bootstrap-v5/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/admin/use-case.min.js') }}"></script>
@endsection
