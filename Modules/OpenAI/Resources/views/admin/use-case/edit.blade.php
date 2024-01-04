@extends('admin.layouts.app')
@section('page_title', __('Edit Use Case'))

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
                    <span class="ps-1">{{ __('Edit :x', ['x' => __('Use Case')]) }}</span>
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
                                <form action="{{ route('admin.use_case.edit', ['id' => $useCase->id]) }}"
                                    method="post" class="form-horizontal" enctype="multipart/form-data" id="form" onsubmit="return formValidation()" novalidate>
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-sm-2 col-form-label require">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{ __('Name') }}"
                                                class="form-control inputFieldDesign" id="name" name="name"
                                                value="{{ $useCase->name }}" maxlength="191"
                                                oninvalid="this.setCustomValidity({{ __('This field is required.') }})"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-sm-2 form-label require mt-2 mt-sm-0">{{ __('Slug') }}</label>
                                        <div class="col-sm-10">
                                            <span id="slug-span" class="form-label">{{ $useCase->slug }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-2 col-form-label require">{{ __('Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea placeholder="{{ __('Description') }}" id="description" class="form-control" name="description" maxlength="1000"
                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ $useCase->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label require"> {{ __('User Input Fields') }} </label>
                                        <input type="hidden" name="optionId" id="optionId" value={{ $option->id + 13}}>
                                        <div class="col-sm-10">
                                            <div class="row dynamic_field">
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <input type="text" class="form-control inputFieldDesign new-field" name="names[]" id="{{ $option->key }}" maxlength="191" placeholder="{{ __('Name') }}" value="{{ $option->label }}" oninput="addButton(this)" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                    <input type="hidden" name="variable_names[]" value={{ $option->key }}>
                                                </div>
                                                <div class="col-xl-4 col-md-6 col-12 mt-2 mt-md-0">
                                                    <input type="text" class="form-control inputFieldDesign new-field" id="description-{{ $option->id }}" maxlength="191" placeholder="{{ __('Description') }}" name="descriptions[]" value="{{ $option->placeholder }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                </div>
                                                <div class="col-xl-3 col-md-6 col-12 mt-2 mt-xl-0">
                                                    <select class="form-select form-control inputFieldDesign new-field sl_common_bx" id="type-{{ $option->id }}" name="type[]" id="type">
                                                        <option value="" selected>{{ __('Select One') }}</option>
                                                        <option value="text" {{ $option->type === 'text' ? 'selected' : '' }} > {{ __('Input Field') }}</option>
                                                        <option value="textarea" {{ $option->type === 'textarea' ? 'selected' : '' }} > {{ __('Textarea Field') }}</option>
                                                    </select>
                                                </div>
                                                
                                                <span onclick="addFields(this)" class="input-group-text bg-transparent cursor_pointer rounded h-40 col-xl-1 col-md-6 col-12 w-auto mt-2 mt-xl-0 ms-2 {{ $option->type ? 'd-none' : '' }} " >
                                                    <i class="fa fa-btn fa-plus"></i>
                                                </span>
                                                <span onclick="removeFields(this)" class="input-group-text bg-transparent cursor_pointer rounded h-40 col-xl-1 col-md-6 col-12 w-auto mt-2 mt-xl-0 ms-2 {{ $option->type ? '' : 'd-none' }}">
                                                    <i class="feather icon-trash-2"></i>
                                                </span>
                                            </div>
                                            
                                            <div id="field-container">
                                                @foreach ( $useCase->option as $key => $meta )
                                                    @if ( $key != 0 )
                                                        <div class="row mt-3">
                                                            <div class="col-xl-4 col-md-6 col-12">
                                                                <input type="text" class="form-control inputFieldDesign new-field" maxlength="191" name="names[]" id="{{ $meta->key }}" placeholder="{{ __('Name') }}" value={{ $meta->label }} oninput="addButton(this)" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                                <input type="hidden" name="variable_names[]" value={{ $meta->key }}>
                                                            </div>
                                                            <div class="col-xl-4 col-md-6 col-12 mt-2 mt-md-0">
                                                                <input type="text" class="form-control inputFieldDesign new-field" maxlength="191" id="description-{{ $option->id }}" placeholder="{{ __('Description') }}" name="descriptions[]" value="{{ $meta->placeholder }}" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6 col-12 mt-2 mt-xl-0">
                                                                <select class="form-select inputFieldDesign new-field sl_common_bx" id="type-{{ $option->id }}" name="type[]">
                                                                    <option value="" selected> {{ __('Select One') }}</option>
                                                                    <option value="text" {{ $meta->type === 'text' ? 'selected' : '' }} > {{ __('Input Field') }} </option>
                                                                    <option value="textarea" {{ $meta->type === 'textarea' ? 'selected' : '' }}> {{ __('Textarea Field') }} </option>
                                                                </select>
                                                            </div>
                                                            <span onclick="removeFields(this)" class="input-group-text bg-transparent cursor_pointer rounded h-40 col-xl-1 col-md-6 col-12 w-auto mt-2 mt-xl-0 ms-2 {{ $meta->type ? '' : 'd-none' }}">
                                                                <i class="feather icon-trash-2"></i>
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

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
                                                @foreach ( $useCase->option as $key => $option )
                                                    <span onclick="insertText(this)" id="{{ $option->key }}-button" class="btn btn-primary mr-4 mb-2">
                                                        {{ $option->key }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <textarea placeholder="{{ __('Input template') }}" id="input_template" class="form-control" name="input_template"
                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ $useCase->prompt }}</textarea>
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
                                            class="col-sm-2 form-label require">{{ __('Category') }}</label>
                                        <div class="col-sm-10">
                                            <select multiple class="form-control select2 ajax_category inputFieldDesign"
                                                name="category_id_array[]">
                                                @foreach ($useCase->useCaseCategories as $category)
                                                    <option value="{{ $category->id }}" selected="selected">
                                                        {{ $category->name }}</option>
                                                @endforeach
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
                                                @if (!empty($useCase->objectFile))
                                                <div class="d-flex flex-wrap mt-2">
                                                    <div class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                                    <div class="position-absolute rounded-circle text-center img-remove-icon">
                                                                    <i class="fa fa-times"></i>
                                                    </div>
                                                        <img class="upl-img p-1" src="{{ $useCase->fileUrl() }}">
                                                        <input type="hidden" value="{{ $useCase->objectFile->file_id }}" name="file_id[]">
                                                    </div>
                                                </div>
                                                @endif
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
                                            class="col-sm-2 form-label require">{{ __('Status') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control  select2 inputFieldDesign" name="status"
                                                id="use_case_status" aria-label="Status select">
                                                <option value="active"
                                                    {{ $useCase->status == 'active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}
                                                </option>
                                                <option value="inactive"
                                                    {{ $useCase->status == 'inactive' ? 'selected' : '' }}>
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
                                                <i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i>
                                                <span id="spinnerText">{{ __('Update') }}</span>
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
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/admin/use-case.min.js') }}"></script>
@endsection
