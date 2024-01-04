@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Code')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.code.list') }}">{{ __('Code') }}</a> >> {{ __('View') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Code')]) }}</a>
                        </li>
                    </ul>
                    <form action='' method="post" class="form-horizontal"
                        id="blogForm" enctype="multipart/form-data">
                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <input type="hidden" value="{{ $code->id }}" name="id" id="token">
                                <div class="row">
                                    <div class="col-sm-9">

                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Promt') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" placeholder="{{ __('Title') }}"
                                                    class="form-control inputFieldDesign" id="title" name="title" readonly
                                                    required
                                                    value="{{ $code->promt }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Code') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea class="blog_message form-control" readonly rows="10">{{ $code->code }}</textarea>
                                                <label id="blog_messages-error" class="error"
                                                    for="blog_messages"></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 pb-2">
                                <a href="{{ route('admin.features.code.list') }}"
                                    class="btn all-cancel-btn custom-btn-cancel">{{ __('Back') }}</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
