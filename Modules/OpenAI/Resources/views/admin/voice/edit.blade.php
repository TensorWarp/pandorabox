@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Voice')]))

@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/MediaManager/Resources/assets/css/media-manager.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <a class="pe-1" href="{{ route('admin.features.textToSpeech.voice.lists') }}">{{ __('AI Voice') }}</a>>>
                    <span class="ps-1">{{ __('Edit :x', ['x' => __('Voice')]) }}</span>
                </h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab"
                                href="#home" role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('AI Voice')]) }}</a>
                        </li>
                    </ul>

                    <div class="card-block table-border-style tab-content">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.features.textToSpeech.voice.edit', ['id' => $voice->id]) }}"
                                    method="post" class="form-horizontal" enctype="multipart/form-data" id="form" onsubmit="return formValidation()" novalidate>
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
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
                                                @if (!empty($voice->objectFile))
                                                <div class="d-flex flex-wrap mt-2">
                                                    <div class="position-relative border boder-1 p-1 mr-2 rounded mt-2">
                                                    <div class="position-absolute rounded-circle text-center img-remove-icon">
                                                                    <i class="fa fa-times"></i>
                                                    </div>
                                                        <img class="upl-img p-1 object-fit-cover" src="{{ $voice->fileUrl() }}">
                                                        <input type="hidden" value="{{ $voice->objectFile->file_id }}" name="file_id[]">
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
                                        <label for="name"
                                            class="col-sm-2 col-form-label require">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="{{ __('Name') }}"
                                                class="form-control inputFieldDesign" id="name" name="name"
                                                value="{{ $voice->name }}" maxlength="191"
                                                oninvalid="this.setCustomValidity({{ __('This field is required.') }})"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-2 col-form-label pe-0">{{ __('Voice') }}
                                        </label>
                                        <div class="col-sm-10">
                                            <audio controls src="{{ $voice->googleAudioUrl() }}"></audio> 
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label for="use_case_status"
                                            class="col-sm-2 form-label require">{{ __('Status') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control  select2 inputFieldDesign" name="status" aria-label="Status select">
                                                <option value="Active"
                                                    {{ $voice->status == 'Active' ? 'selected' : '' }}>
                                                    {{ __('Active') }}
                                                </option>
                                                <option value="Inactive"
                                                    {{ $voice->status == 'Inactive' ? 'selected' : '' }}>
                                                    {{ __('Inactive') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="d-flex justify-items-start mt-4 flex-wrap">
                                            <a href="{{ route('admin.features.textToSpeech.voice.lists') }}"
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
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
