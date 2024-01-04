@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('Content')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.contents') }}">{{ __('Content') }}</a> >> {{ __('Edit') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Content')]) }}</a>
                        </li>
                    </ul>
                    <form action='{{ route('admin.features.content.update', $content->id) }}' method="post" class="form-horizontal"
                        id="blogForm" enctype="multipart/form-data">
                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <input type="hidden" value="{{ $content->id }}" name="id" id="token">
                                <div class="row">
                                    <!-- <div class="col-sm-9"> -->
                                    <div class="col-md-12 col-lg-12 col-xl-9 order-last order-xl-first">
                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label require pe-0">{{ __('Content Category') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control sl_common_bx select2-hide-search" {{ $disabled }}
                                                    id="category_id" name="use_case_id" required
                                                    oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                    <option value="" >{{ __('Select One') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $content->use_case_id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label require pe-0">{{ __('Description') }}
                                            </label>
                                            <div class="col-sm-10">
                                            <textarea id="basic-example" class="d-none" name="content">
                                                {{ !empty($content->content) ? nl2br($content->content) : '' }}
                                            </textarea>
                                                <label id="blog_messages-error" class="error"
                                                    for="blog_messages"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 pb-2">
                                <a href="{{ route('admin.features.contents') }}"
                                    class="btn all-cancel-btn custom-btn-cancel">{{ __('Cancel') }}</a>
                                    @if(!$readonly)
                                <button class="btn custom-btn-submit" type="submit"
                                    id="btnSubmit">{{ __('Update') }}</button>
                                    @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('public/assets/plugin/tinymce 6.3.1/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('Modules/OpenAI/Resources/assets/js/editor.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
