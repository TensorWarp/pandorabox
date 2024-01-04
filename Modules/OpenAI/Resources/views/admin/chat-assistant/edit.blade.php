@extends('admin.layouts.app')
@section('page_title', __('Edit Chat Assistant'))

@section('css')
<link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
<!-- Main content -->
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>
                <a class="pe-1" href="{{ route('admin.chat.assistant.list') }}">{{ __('Chat Assistants') }}</a>>>
                <span class="ps-1">{{ __('Edit :x', ['x' => __('Chat Assistant')]) }}</span>
            </h5>
        </div>

        <div class="card-body px-3" id="no_shadow_on_card">
            <div class="col-sm-12 m-t-20 form-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __(':x Information', ['x' => __('Chat Assistant')]) }}</a>
                    </li>
                </ul>

                <div class="card-block table-border-style tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col-sm-12">
                            <form action="{{ route('admin.chat.assistant.edit', [ 'id' => $chatBot->id]) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form" onsubmit="return formValidation()" novalidate>
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-2 require col-form-label pr-0">{{ __('Category') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <select class="form-control sl_common_bx select2-hide-search" id="chat_category_id" name="chat_category_id">
                                            <option value="">{{ __('Select One') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $chatBot->chat_category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label require">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="{{ __('Name') }}" class="form-control inputFieldDesign" id="name" name="name" value="{{ $chatBot->name }}" maxlength="191" oninvalid="this.setCustomValidity({{ __('This field is required.') }})" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Featured Image') }}</label>
                                    <input type="hidden" name="code" value="{{ $chatBot->code }}" id="code">
                                    <div class="col-sm-10">
                                        <div class="custom-file has-media-manager has-thumbnail" data-val="single"
                                            id="image-status">
                                            <input class="form-control up-images attachment d-none" name="attachment"
                                                id="validatedCustomFile" accept="image/*">
                                            <label class="custom-file-label overflow_hidden position-relative d-flex align-items-center"
                                                for="validatedCustomFile">{{ __('Upload image') }}</label>
                                        </div>
                                        <div class="d-flex" id="bot-image">
                                            <!-- img will be shown here -->

                                            <div class="d-flex flex-wrap mt-2">
                                                @if (!empty($chatBot->objectFile->file_id))
                                                    <div
                                                        class="position-relative border boder-1 p-1 me-2 rounded mt-2">
                                                        <input type="hidden" name="file_id[]"
                                                            value="{{ optional($chatBot->objectFile)->file_id }}">
                                                        <div
                                                            class="position-absolute rounded-circle text-center img-remove-icon">
                                                            <i class="fa fa-times"></i>
                                                        </div>

                                                        <img class="upl-img" class="p-1"
                                                            src="{{ $chatBot->fileUrl() }}">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label require">{{ __('Message') }}</label>
                                    <div class="col-sm-10">
                                        <textarea placeholder="{{ __('Message') }}" id="message" class="form-control" name="message" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ $chatBot->message }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="first_name"
                                        class="col-sm-2 col-form-label require pr-0">{{ __('Role') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="{{ __('Role') }}" class="form-control inputFieldDesign" id="role" name="role" value="{{ $chatBot->role }}" maxlength="191" oninvalid="this.setCustomValidity({{ __('This field is required.') }})" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label require">{{ __('Prompt') }}</label>
                                    <div class="col-sm-10">
                                        <textarea placeholder="{{ __('Prompt') }}" id="promt" class="form-control" name="promt" oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" required>{{ $chatBot->promt }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Status" class="col-md-2 col-3 col-form-label require">{{ __('Status') }}</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control select2-hide-search" id="status">
                                            <option value="">{{ __('Select One') }} </option>
                                            <option value="Active" {{ $chatBot->status === 'Active' ? 'selected' : '' }}>{{ __('Active') }} </option>
                                            <option value="Inactive" {{ $chatBot->status === 'Inactive' ? 'selected' : '' }} >{{ __('Inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-1 mb-1">
                                    <label for="Status" class="col-md-2 col-3 col-form-label require">{{ __('Is Default') }}</label>
                                    <div class="col-md-10 col-9 s margin-top-6">
                                        <div class="switch switch-bg d-inline m-r-10">
                                            <input type="hidden" name="is_default" value="0">
                                            <input class="status" type="checkbox" value="1" name="is_default"
                                                id="is_private" {{ $chatBot->is_default === 1 ? 'checked' : '' }}>
                                            <label for="is_private" class="cr"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="d-flex justify-items-start mt-4 flex-wrap">
                                        <a href="{{ route('admin.chat.assistant.list') }}" class="btn custom-btn-cancel all-cancel-btn">{{ __('Cancel') }}</a>
                                        <button class="btn custom-btn-submit" type="submit" id="btnUpdate">
                                            <i class="comment_spinner spinner fa fa-spinner fa-spin custom-btn-small display_none"></i>
                                            <span id="spinnerText">{{ __('Update') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('mediamanager::image.modal_image')
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    'use strict';
    var currentUrl = "{!! url()->full() !!}";
    var loginNeeded = "{!! session('loginRequired') ? 1 : 0 !!}";
    var slug = false;
</script>
<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
<script src="{{ asset('Modules/OpenAI/Resources/assets/js/admin/chat-bot.min.js') }}"></script>
@endsection