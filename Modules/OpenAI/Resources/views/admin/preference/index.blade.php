@extends('admin.layouts.app')
@section('page_title', __('Edit :x', ['x' => __('AI Preferences')]))

@section('content')
    <!-- Main content -->
    <div class="col-sm-12" id="preference-container">
        <div class="card">
            <div class="card-body row" id="preference-container">
                <div class="col-lg-3 col-12 z-index-10 pe-0 ps-0 ps-md-3" aria-labelledby="navbarDropdown">
                    <div class="card card-info shadow-none" id="nav">
                        <div class="card-header pt-4 border-bottom text-nowrap">
                            <h5 id="general-settings">{{ __('Content Types') }}</h5>
                        </div>
                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <li><a class="nav-link text-left tab-name active" id="v-pills-setup-tab" data-bs-toggle="pill"
                                href="#v-pills-setup" role="tab" aria-controls="v-pills-setup"
                                aria-selected="true" data-id="{{ __('AI Setup') }}">{{ __('AI Setup') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-document-tab" data-bs-toggle="pill"
                                    href="#v-pills-document" role="tab" aria-controls="v-pills-document"
                                    aria-selected="true" data-id="{{ __('Document') }}">{{ __('Document') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-image-tab" data-bs-toggle="pill"
                                    href="#v-pills-image" role="tab" aria-controls="v-pills-image"
                                    aria-selected="true" data-id="{{ __('Image') }}">{{ __('Image') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-code-tab" data-bs-toggle="pill"
                                href="#v-pills-code" role="tab" aria-controls="v-pills-code"
                                aria-selected="true" data-id="{{ __('Code') }}">{{ __('Code') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-speech-tab" data-bs-toggle="pill"
                                    href="#v-pills-speech" role="tab" aria-controls="v-pills-speech"
                                    aria-selected="true" data-id="{{ __('Speech To Text') }}">{{ __('Speech To Text') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-voiceover-tab" data-bs-toggle="pill"
                                    href="#v-pills-voiceover" role="tab" aria-controls="v-pills-voiceover"
                                    aria-selected="true" data-id="{{ __('Voiceover') }}">{{ __('Voiceover') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-bad-word-tab" data-bs-toggle="pill"
                                href="#v-pills-bad-word" role="tab" aria-controls="v-pills--bad-word"
                                aria-selected="true" data-id="{{ __('Bad Words') }}">{{ __('Bad Words') }}</a></li>
                            <li><a class="nav-link text-left tab-name" id="v-pills-access-tab" data-bs-toggle="pill"
                                href="#v-pills-access" role="tab" aria-controls="v-pills-access"
                                aria-selected="true" data-id="{{ __('User Access') }}">{{ __('User Assess') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-12 ps-0">
                    <div class="card card-info shadow-none">
                        <div class="card-header pt-4 border-bottom">
                            <h5><span id="theme-title">{{ __('Document') }}</span></h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.features.preferences.create') }}" id="aiSettings">
                                @csrf

                                <div class="tab-content p-0 box-shadow-unset" id="topNav-v-pills-tabContent">
                                    {{-- OpenAI Setup --}}
                                    <div class="tab-pane fade active show" id="v-pills-setup" role="tabpanel" aria-labelledby="v-pills-setup-tab">
                                        <div class="row">
                                            <div class="d-flex justify-content-between mt-16p">
                                                <div id="#headingOne">
                                                    <h5 class="text-btn">{{ __('Ai Key') }}</h5>
                                                </div>
                                                <div class="mr-3"></div>
                                            </div>
                                            <div class="card-body p-l-15">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 control-label text-left require">{{ __('OpenAi Key') }}</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            value="{{ config('openAI.is_demo') ? 'sk-xxxxxxxxxxxxxxx' : $openai['openai'] ?? '' }}"
                                                            class="form-control inputFieldDesign" name="openai" id="openai_key">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 control-label text-left">{{ __('Stable Diffusion Key') }}</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            value="{{ config('openAI.is_demo') ? 'sk-xxxxxxxxxxxxxxx' : $openai['stablediffusion'] ?? '' }}"
                                                            class="form-control inputFieldDesign" name="stablediffusion" id="stablediffusion_key">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 control-label text-left">{{ __('Google API Key') }}</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            value="{{ config('openAI.is_demo') ? 'sk-xxxxxxxxxxxxxxx' : $openai['google_api'] ?? '' }}"
                                                            class="form-control inputFieldDesign" name="google_api" id="googleApi_key">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 control-label text-left require">{{ __('Max Length for Short Description') }}</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            value="{{ $openai['short_desc_length'] ?? '' }}"
                                                            class="form-control inputFieldDesign positive-int-number" name="short_desc_length" required pattern="^(?:[1-9]|[1-9][0-9]{1,2}|1000)$"
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Value exceeds the maximum limit of 1000.') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 control-label text-left require">{{ __('Max Length for Long Description ') }}</label>
                
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            value="{{ $openai['long_desc_length'] ?? '' }}"
                                                            class="form-control inputFieldDesign positive-int-number" name="long_desc_length" required  pattern="^(?:[1-9]|[1-9][0-9]{1,2}|1000)$"
                                                            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" data-pattern="{{ __('Value exceeds the maximum limit of 1000.') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-left control-label">{{ __('Word Count method based on') }}</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control select2-hide-search inputFieldDesign" name="word_count_method">
                                                            <option value="token" {{ $openai['word_count_method'] == 'token' ? 'selected="selected"' : '' }}>{{ __('Token') }}</option>
                                                            <option value="count_word_function" {{ $openai['word_count_method'] == 'count_word_function' ? 'selected="selected"' : '' }}>{{ __('Word Counter') }}</option>
                                                        </select>
                                                        <div class="py-1" id="note_txt_1">
                                                            <p><span class="badge badge-danger h-100 mt-1"> {{__('Note') }}!</span> {!! __('Token counting is performed in accordance with OpenAI\'s token counting guidelines, as outlined in their official :x. Meanwhile, word counting is based on the conventional method', ['x' => '
                                                            <a href="https://help.openai.com/en/articles/4936856-what-are-tokens-and-how-to-count-them" target="_blank">' . _('documentation') . '</a>']) !!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between pt-3">
                                                <div id="#headingOne">
                                                    <h5 class="text-btn">{{ __('Live Mode') }}</h5>
                                                </div>
                                                <div class="mr-3"></div>
                                            </div>
                                            <div class="card-body p-l-15">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-left control-label">{{ __('OpenAI Model') }}</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control select2-hide-search inputFieldDesign" name="ai_model">
                                                            @foreach($aiModels as $key => $aiModel)
                                                            <option value="{{ $key }}"
                                                                {{ $key == $openai['ai_model'] ? 'selected="selected"' : '' }}>
                                                                {{ $aiModel }} ({{ $aiModelDescription[$key] }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--smtp form start here-->
                                                <span id="smtp_form">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label text-left require">{{ __('Max Result Length (Token)') }}</label>
                                                        <div class="col-sm-8">
                                                            <input type="text"
                                                                value="{{ $openai['max_token_length'] ?? $openai['max_token_length'] }}"
                                                                class="form-control inputFieldDesign positive-int-number" name="max_token_length" required
                                                                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Document --}}
                                    <div class="tab-pane fade" id="v-pills-document" role="tabpanel" aria-labelledby="v-pills-document-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Select Languages') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[document][language][]" multiple required>
                                                            @foreach ($languages as $language)
                                                                @if ( !array_key_exists($language->name, $omitLanguages) )
                                                                <option value="{{ $language->name }}"
                                                                    {{ in_array($language->name, processPreferenceData($meta['document'][0]->value ?? NULL) ) ? 'selected' : '' }}> {{ $language->name }} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Select Tones') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[document][tone][]" multiple required>
                                                            @foreach ($preferences['document']['tone'] as $key => $tone)
                                                                <option value="{{ $key }}" {{ in_array($tone, processPreferenceData($meta['document'][1]->value ?? NULL)) ? 'selected' : '' }} > {{ $tone }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Number of variants') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[document][variant][]" multiple required>
                                                            @foreach ($preferences['document']['variant'] as $key => $variant)
                                                                <option value="{{ $key }}" {{ in_array($variant, processPreferenceData($meta['document'][2]->value ?? NULL)) ? 'selected' : '' }} > {{ $variant }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Creativity Level') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[document][temperature][]" multiple required>
                                                            @foreach ($preferences['document']['temperature'] as $key => $temperature)
                                                                <option value="{{ $key }}" {{ in_array($temperature, processPreferenceData($meta['document'][3]->value ?? NULL)) ? 'selected' : '' }} > {{ $temperature }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Image --}}
                                    <div class="tab-pane fade" id="v-pills-image" role="tabpanel" aria-labelledby="v-pills-image-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Image Create Using') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx image-class"
                                                            name="meta[image_maker][imageCreateFrom][]"
                                                            id="image_create_using"
                                                            required>

                                                            @foreach ($preferences['image_maker']['imageCreateFrom'] as $key => $image)
                                                                <option value="{{ $key }}" {{ in_array($key, processPreferenceData($meta['image_maker'][4]->value ?? NULL)) ? 'selected' : '' }} > {{ $image }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row stable-diffusion-model">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Stable Diffusion Engine') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="stable_diffusion_engine"
                                                            id="stable_diffusion_engine" required>
                                                            @foreach (config('openAI.stableDiffusion') as $key => $variant)
                                                                <option value="{{ $key }}" {{ preference('stable_diffusion_engine') == $key ? 'selected':"" }} > {{ $variant }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Number of variants') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx" id="varient"
                                                            name="meta[image_maker][variant][]" multiple required>
                                                            @foreach ($preferences['image_maker']['variant'] as $key => $variant)
                                                                <option value="{{ $key }}" {{ in_array($variant, processPreferenceData($meta['image_maker'][0]->value ?? NULL)) ? 'selected' : '' }} > {{ $variant }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    if (isset(processPreferenceData($meta['image_maker'][4]->value)[0]) && 
                                                        processPreferenceData($meta['image_maker'][4]->value)[0] == 'Openai') {
                                                        $resolutions = config('openAI.size.openAI');
                                                    } else {
                                                        $resolutions = config('openAI.size')[preference('stable_diffusion_engine')];
                                                    }
                                                @endphp
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Resulation') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[image_maker][resulation][]" 
                                                            id="resolutions" multiple required>
                                                            @foreach ($resolutions ?? [] as $key => $resulation)
                                                                <option value="{{ $key }}" {{ in_array($resulation, processPreferenceData($meta['image_maker'][1]->value ?? NULL)) ? 'selected' : '' }} > {{ $resulation }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Image Style') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[image_maker][artStyle][]" multiple required>
                                                            @foreach ($preferences['image_maker']['artStyle'] as $key => $artStyle)
                                                                <option value="{{ $key }}" {{ in_array($artStyle, processPreferenceData($meta['image_maker'][2]->value ?? NULL)) ? 'selected' : '' }} > {{ $artStyle }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Lighting Effects') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[image_maker][lightingStyle][]" multiple required>
                                                            @foreach ($preferences['image_maker']['lightingStyle'] as $key => $lightingStyle)
                                                                <option value="{{ $key }}" {{ in_array($lightingStyle, processPreferenceData($meta['image_maker'][3]->value ?? NULL)) ? 'selected' : '' }} > {{ $lightingStyle }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- Code --}}
                                    <div class="tab-pane fade" id="v-pills-code" role="tabpanel" aria-labelledby="v-pills-code-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Language') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[code_writer][language][]" multiple required>
                                                            @foreach ($preferences['code_writer']['language'] as $key => $language)
                                                                <option value="{{ $key }}" {{ in_array($language, processPreferenceData($meta['code_writer'][0]->value ?? NULL)) ? 'selected' : '' }} > {{ $language }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Code Level') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[code_writer][codeLabel][]" multiple required>
                                                            @foreach ($preferences['code_writer']['codeLabel'] as $key => $codeLabel)
                                                                <option value="{{ $key }}" {{ in_array($codeLabel, processPreferenceData($meta['code_writer'][1]->value ?? NULL)) ? 'selected' : '' }} > {{ $codeLabel }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Speech To Text --}}
                                    <div class="tab-pane fade" id="v-pills-speech" role="tabpanel" aria-labelledby="v-pills-code-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Select Languages') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[speech_to_text][language][]" multiple required>
                                                            @foreach ($languages as $language)
                                                                @if ( !array_key_exists($language->name, $omitSpeechLanguages) )
                                                                <option value="{{ $language->short_name }}"
                                                                    {{ in_array($language->short_name, processPreferenceData($meta['speech_to_text'][0]->value ?? NULL) ) ? 'selected' : '' }}> {{ $language->name }} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Voiceover --}}
                                    <div class="tab-pane fade" id="v-pills-voiceover" role="tabpanel" aria-labelledby="v-pills-document-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Maximum Text Blocks Limit') }}</label>
                                                        <div>
                                                            <input type="number" class="form-control" name="conversation_limit" value="{{ $openai['conversation_limit'] ?? 1 }}" min="1" data-min="{{ __('This value must be greater than :x.', ['x' => '0']) }}" required />
                                                        </div>
                                                        <div class="d-flex py-1" id="note_txt_1">
                                                            <span class="badge badge-danger h-100 mt-1"> {{__('Note') }}!</span>
                                                            <ul class="list-unstyled ml-3">
                                                                <li>{{ __('If you increase the value, it will take longer to generate. Please note that the minimum value must be equal to or greater than 1.') }} </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Select Languages') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][language][]" multiple required>
                                                            @foreach ($languages as $language)
                                                                @if ( !array_key_exists($language->name, $omitTextToSpeechLanguages) )
                                                                    <option value="{{ $language->name }}"
                                                                        {{ in_array($language->name, processPreferenceData($meta['text_to_speech'][0]->value ?? NULL) ) ? 'selected' : '' }}> {{ $language->name }} 
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Select Volumes') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][volume][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['volume'] as $key => $volume)
                                                                <option value="{{ $key }}" {{ in_array($volume, processPreferenceData($meta['text_to_speech'][1]->value ?? NULL)) ? 'selected' : '' }} > {{ $volume }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Pitch') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][pitch][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['pitch'] as $key => $pitch)
                                                                <option value="{{ $key }}" {{ in_array($pitch, processPreferenceData($meta['text_to_speech'][2]->value ?? NULL)) ? 'selected' : '' }} > {{ $pitch }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Speed') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][speed][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['speed'] as $key => $speed)
                                                                <option value="{{ $key }}" {{ in_array($speed, processPreferenceData($meta['text_to_speech'][3]->value ?? NULL)) ? 'selected' : '' }} > {{ $speed }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Pause') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][pause][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['pause'] as $key => $pause)
                                                                <option value="{{ $key }}" {{ in_array($pause, processPreferenceData($meta['text_to_speech'][4]->value ?? NULL)) ? 'selected' : '' }} > {{ $pause }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Audio Effect') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][audio_effect][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['audio_effect'] as $key => $audio_effect)
                                                                <option value="{{ $key }}" {{ in_array($audio_effect, processPreferenceData($meta['text_to_speech'][5]->value ?? NULL)) ? 'selected' : '' }} > {{ $audio_effect }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label require">{{ __('Converted To') }}</label>
                                                        <select class="form-control select2 inputFieldDesign sl_common_bx"
                                                            name="meta[text_to_speech][target_format][]" multiple required>
                                                            @foreach ($preferences['text_to_speech']['target_format'] as $key => $target_format)
                                                                <option value="{{ $key }}" {{ in_array($target_format, processPreferenceData($meta['text_to_speech'][6]->value ?? NULL)) ? 'selected' : '' }} > {{ $target_format }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- Bad Words --}}
                                    <div class="tab-pane fade" id="v-pills-bad-word" role="tabpanel" aria-labelledby="v-pills-bad-word-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="default-category" class="control-label">{{ __('Words') }}</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control" rows="5" name="bad_words">{{ $openai['bad_words'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-1" id="note_txt_1">
                                                    <div class="d-flex mt-1 mb-3">
                                                        <span class="badge badge-danger h-100 mt-1"> {{__('Note') }}!</span>
                                                        <ul class="list-unstyled ml-3">
                                                            <li>{{ __('After using each bad word, please differentiate them using a comma (,).') }} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-access" role="tabpanel" aria-labelledby="v-pills-access-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="hide_template" class="col-sm-3 control-label">{{ __('Enable Template') }}</label>
                                                        <div class="col-9 d-flex">
                                                            <div class="mr-3">
                                                                <div class="switch switch-bg d-inline m-r-10">
                                                                    @php
                                                                        $hideTemplate = 1;
                                                                    @endphp
                                                                    <input type="hidden" name="hide_template" value="{{ $hideTemplate }}">
                                                                    <input type="checkbox" name="hide_template" class="checkActivity" id="hide_template" value="0" {{ json_decode(preference('user_permission'))?->hide_template == 1  ? '' : 'checked' }}>
                                                                    <label for="hide_template" class="cr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="hide_image" class="col-sm-3 control-label">{{ __('Enable Image') }}</label>
                                                        <div class="col-9 d-flex">
                                                            <div class="mr-3">
                                                                <div class="switch switch-bg d-inline m-r-10">
                                                                    @php
                                                                        $hideImage = 1;
                                                                    @endphp
                                                                    <input type="hidden" name="hide_image" value="{{ $hideImage }}">
                                                                    <input type="checkbox" name="hide_image" class="checkActivity" id="hide_image" value="0" {{ json_decode(preference('user_permission'))?->hide_image == 1  ? '' : 'checked' }}>
                                                                    <label for="hide_image" class="cr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="hide_code" class="col-sm-3 control-label">{{ __('Enable Code') }}</label>
                                                        <div class="col-9 d-flex">
                                                            <div class="mr-3">
                                                                <div class="switch switch-bg d-inline m-r-10">
                                                                    @php
                                                                        $hideCode = 1;
                                                                    @endphp
                                                                    <input type="hidden" name="hide_code" value="{{ $hideCode }}">
                                                                    <input type="checkbox" name="hide_code" class="checkActivity" id="hide_code" value="0" {{ json_decode(preference('user_permission'))?->hide_code == 1  ? '' : 'checked' }}>
                                                                    <label for="hide_code" class="cr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="hide_speech_to_text" class="control-label">{{ __('Enable Speech to Text') }}</label>
                                                        <div class="col-9 d-flex">
                                                            <div class="mr-3">
                                                                <div class="switch switch-bg d-inline m-r-10">
                                                                    @php
                                                                        $speechToText = 1;
                                                                    @endphp
                                                                    <input type="hidden" name="hide_speech_to_text" value="{{ $speechToText }}">
                                                                    <input type="checkbox" name="hide_speech_to_text" class="checkActivity" id="hide_speech_to_text" value="0" {{ json_decode(preference('user_permission'))?->hide_speech_to_text == 1  ? '' : 'checked' }}>
                                                                    <label for="hide_speech_to_text" class="cr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="hide_text_to_speech" class="control-label">{{ __('Enable Voiceover') }}</label>
                                                        <div class="col-9 d-flex">
                                                            <div class="mr-3">
                                                                <div class="switch switch-bg d-inline m-r-10">
                                                                    @php
                                                                        $textToSpeech = 1;
                                                                    @endphp
                                                                    <input type="hidden" name="hide_text_to_speech" value="{{ $textToSpeech }}">
                                                                    <input type="checkbox" name="hide_text_to_speech" class="checkActivity" id="hide_text_to_speech" value="0" {{ json_decode(preference('user_permission'))?->hide_text_to_speech == 1  ? '' : 'checked' }}>
                                                                    <label for="hide_text_to_speech" class="cr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer py-0">
                                    <div class="form-group row">
                                        <label for="btn_save" class="col-sm-3 control-label"></label>
                                        <div class="m-auto">
                                            <button type="submit"
                                                class="btn form-submit custom-btn-submit float-right package-submit-button"
                                                id="footer-btn">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        var openai_key = "{{ $openai['openai'] ?? '' }}";
        var stablediffusion_key = "{{ $openai['stablediffusion'] ?? '' }}";
        var googleApi_key = "{{ $openai['google_api'] ?? '' }}";
        const openAI = @json(config('openAI'));
        var openAIPreferenceSizes = @json($preferences['image_maker']['variant']);
    </script>
    <script src="{{ asset('public/dist/js/custom/openai-settings.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/admin/preference.min.js') }}"></script>
@endsection

