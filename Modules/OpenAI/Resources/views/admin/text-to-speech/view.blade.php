@extends('admin.layouts.app')
@section('page_title', __('View :x', ['x' => __('Voiceover')]))
@section('content')
    <div class="col-sm-12" id="page-container" data-val="edit">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('admin.features.code.list') }}">{{ __('Voiceover') }}</a> >> {{ __('View') }}</h5>
            </div>
            <div class="card-body px-3" id="no_shadow_on_card">
                <div class="col-sm-12 m-t-20 form-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-bold active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#home"
                                role="tab" aria-controls="home"
                                aria-selected="true">{{ __(':x Information', ['x' => __('Voiceover')]) }}</a>
                        </li>
                    </ul>
                    <form action='' method="post" class="form-horizontal"
                        id="blogForm" enctype="multipart/form-data">
                        <div class="col-sm-12 tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label for="first_name"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Prompt') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <textarea class="blog_message form-control" readonly rows="5">{{ $audio->prompt }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Audio') }}
                                            </label>
                                            <div class="col-sm-10">
                                                <audio controls src="{{ $audio->googleAudioUrl() }}"></audio> 
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('User Name') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ optional($audio->user)->name }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Gender') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ $audio->gender }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Volume') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ volume($audio->volume, true) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Pitch') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ pitch($audio->pitch, true)}}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Speed') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ speed($audio->speed, true) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                class="col-sm-2 col-form-label pe-0">{{ __('Audio Effect') }}
                                            </label>
                                            <div class="col-sm-10">
                                                {{ audioEffect($audio->audio_effect, true) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 pb-2">
                                <a href="{{ route('admin.features.textToSpeech.lists') }}"
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
