@extends('layouts.user_master')
@section('page_title', __('Voiceover'))
@section('css')
<link rel="stylesheet" media="all"  href="{{ asset('Modules/OpenAI/Resources/assets/css/dark.min.css') }}">
@endsection
@section('content')
@php
    $characterLeft = 0;
    if ($userSubscription && in_array($userSubscription->status, ['Active', 'Cancel'])) {
        $characterLeft = $featureLimit['character']['remain'];
        $characterLimit = $featureLimit['character']['limit'];
    }
@endphp
{{-- main content --}}
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen relative">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="lg:pt-[88px] pt-20 9xl:px-[245px] 7xl:px-[135px] 5xl:px-[67px] px-2.5 pb-28 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-l dark:border-[#474746] border-color-DF">
            <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">{{ __('Turn any text to real people voices!')}}</p>
            <div class="flex flex-wrap justify-between items-center gap-5">
                 <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mt-2">
                    {{ __(':x turns audio speech into text with ease. Get ready to generate custom texts to audio files quickly and accurately.', ['x' => preference('company_name')])}}
                </p>
                <div>
                   <a href="{{ route('user.textToSpeechList') }}" class="flex justify-end items-center gap-2 text-color-14 dark:text-white font-Figtree font-normal leading-[22px] text-sm"> {{ __('View All') }} 
                        <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <g clip-path="url(#clip0_9805_6003)">
                        <path d="M3 2.175L6.7085 6L3 9.825L4.1417 11L9 6L4.1417 1L3 2.175Z" fill="currentColor"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_9805_6003">
                            <rect width="12" height="12" fill="white" transform="matrix(1 0 0 -1 0 12)"/>
                        </clipPath>
                        </defs>
                        </svg>
                    </a>
                </div>
            </div>
            <form id="openai-text-to-speech-form" enctype='multipart/form-data'>
                <div class="bg-white dark:bg-color-3A rounded-xl mt-5 md:px-6 px-4 pb-5">
                    @if ($characterLeft && auth()->user()->id == $userId)
                        <div class="flex items-center justify-start pt-6 gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_4514_3509)">
                                <path d="M13.9714 7.00665C13.8679 6.84578 13.6901 6.75015 13.5 6.75015H9.56255V0.562738C9.56255 0.297241 9.37693 0.0677446 9.11706 0.0126204C8.85269 -0.0436289 8.59394 0.0924942 8.48594 0.334366L3.986 10.4592C3.90838 10.6325 3.92525 10.835 4.02875 10.9936C4.13225 11.1533 4.31 11.2501 4.50012 11.2501H8.43757V17.4375C8.43757 17.703 8.62319 17.9325 8.88306 17.9876C8.92244 17.9955 8.96181 18 9.00006 18C9.21831 18 9.42193 17.8729 9.51418 17.6659L14.0141 7.54102C14.0906 7.36664 14.076 7.1664 13.9714 7.00665Z" fill="url(#paint0_linear_4514_3509)"/>
                                </g>
                                <defs>
                                <linearGradient id="paint0_linear_4514_3509" x1="10.5204" y1="15.7845" x2="2.32033" y2="5.3758" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#E60C84"/>
                                <stop offset="1" stop-color="#FFCF4B"/>
                                </linearGradient>
                                <clipPath id="clip0_4514_3509">
                                <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            <p class="text-color-14 dark:text-white font-Figtree font-normal">
                                {!! __('Credits Balance: :x character left', ['x' => "<span class='total-character-left font-semibold text-[#E22861] dark:text-[#FCCA19]'>" 
                                . ($characterLimit == -1 ? __('Unlimited') : ($characterLeft < 0 ? 0 : $characterLeft)) . "</span>"]) !!}
                            </p>
                        </div>
                    @endif
                    <div class="pt-5 flex justify-start flex-wrap gap-4 items-center text-speech">
                        <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                            <label>{{ __('Language') }}</label>
                            <select class="select block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]" id="language">
                                @foreach ($languages as $key => $data)
                                    <option value="{{ $key }}" {{ $key == preference('dflt_lang') ? 'selected' : '' }}> {{ $data }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                            <label>{{ __('Audio Effect') }}</label>
                            <select class="select block text-base leading-6 font-medium text-color-14 bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:outline-none md:w-[225px] w-[170px]" id="audio_effect">
                                @foreach ( processPreferenceData($meta->audio_effect) as $key => $data)
                                    <option value="{{ audioEffect($data) }}"> {{ $data }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="font-normal custom-dropdown-arrow font-Figtree text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                            <label>{{ __('Voice') }}</label>
                            <div class="relative img-option md:w-[225px] w-[170px]">
                                <select id="data-attr">
                                    @foreach ($voices as $voice)
                                        <option data-lang-code="{{ $voice->language_code }}" data-gender="{{ $voice->gender }}" data-name="{{ $voice->voice_name }}" data-src="{{ $voice->fileUrl() }}" value="{{ $voice->name }}">{{ $voice->name }}</option>
                                    @endforeach
                                 </select>
                            </div>
                        </div>
                        <div class="flex gap-1.5 justify-start items-center cursor-pointer mt-6" id="advanceToggle">
                            <p class="font-Figtree text-[13px] font-medium leading-5 text-color-89">{{ __('Advanced Options') }}</p>
                            <div class="cursor-pointer" id="arrow-switch">
                                <svg class="up-arrow" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_9805_5993)">
                                    <path d="M9.825 3L6 6.7085L2.175 3L1 4.1417L6 9L11 4.1417L9.825 3Z" fill="#898989"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_9805_5993">
                                    <rect width="12" height="12" fill="white" transform="matrix(1.19249e-08 1 1 -1.19249e-08 0 0)"/>
                                    </clipPath>
                                    </defs>
                                </svg>

                                <svg class="down-arrow hidden" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_9805_6120)">
                                    <path d="M9.825 9L6 5.2915L2.175 9L1 7.8583L6 3L11 7.8583L9.825 9Z" fill="#898989"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_9805_6120">
                                    <rect width="12" height="12" fill="white" transform="translate(0 12) rotate(-90)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="hidden mt-6" id="advanceContent">
                        <div class="flex justify-start flex-wrap items-center gap-4 text-speech">
                            <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                <label>{{ __('Volume') }}</label>
                                <select class="select block md:w-[225px] w-[170px] text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" id="volume">
                                    @foreach ( processPreferenceData($meta->volume) as $key => $data)
                                        <option value="{{ volume($data) }}" {{ $key == 1 ? 'selected' : '' }}> {{ $data }} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                <label>{{ __('Speed') }}</label>
                                <select class="select block md:w-[225px] w-[170px] text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" id="speed">
                                    @foreach ( processPreferenceData($meta->speed) as $key => $data)
                                        <option value="{{ speed($data) }}" {{ $key == 2 ? 'selected' : '' }}> {{ $data }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                <label>{{ __('Pitch') }}</label>
                                <select class="select block md:w-[225px] w-[170px] text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" id="pitch">
                                    @foreach ( processPreferenceData($meta->pitch) as $key => $data)
                                        <option value="{{ pitch($data) }}" {{ $key == 1 ? 'selected' : '' }}> {{ $data }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="font-normal custom-dropdown-arrow text-14 text-color-14 dark:text-white flex flex-col gap-1.5">
                                <label>{{ __('Pauses') }}</label>
                                <select class="select block md:w-[225px] w-[170px] text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" id="pause">
                                    @foreach ( processPreferenceData($meta->pause) as $key => $data)
                                        <option value="{{ $data }}" {{ $key == 0 ? 'selected' : '' }}> {{ $data }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="flex justify-between items-center">
                            <p class="font-Figtree text-color-14 font-medium leading-6 text-base dark:text-white"> {{ __('Your Text') }}</p>
                            <p class="text-color-89 font-Figtree font-medium text-[13px] leading-5">{{ __('Words Limit: :x', ['x' => preference('long_desc_length')]) }} </p>
                        </div>
                        <div id="textFieldsContainer">
                            <div class="flex gap-3 w-full text-area-content">
                                <div class="relative valid-parent border grow border-color-89 dark:border-color-47 dark:bg-[#333332] rounded-xl p-2 flex gap-3 mt-1.5" id="text-area">
                                    <img class="w-8 h-8 object-cover rounded-full" src="{{ $voices[0]->googleAudioUrl() }}"alt="{{ __('Image') }}">
                                    <textarea maxlength="{{ preference('long_desc_length') }}" id="textToSpeech-0" required class="py-1 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light !text-color-14 dark:!text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-none dark:!border-none mx-auto focus:text-color-14 focus:bg-white focus:border-none focus:dark:!border-none focus:outline-none px-0 outline-none form-control w-full textToSpeechInput" placeholder="{{ __('Write down the text you want to voiceover..') }}" rows="4" name="prompt[]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-7 lg:mt-3 flex justify-between items-center gap-2">
                        <div class="flex gap-5">
                            @foreach ( processPreferenceData($meta->target_format) as $key => $data)
                                <div class="flex items-center">
                                    <input type="radio" id="title_{{ $key }}" name="titles" class="hidden" value={{ $data }} @if ($key == 0) checked @endif>
                                    <label for="title_{{ $key }}" class="relative flex justify-center text-color-14 dark:text-white font-Figtree font-medium leading-5 text-[13px] uppercase cursor-pointer">
                                        {{ $data }}
                                        <div class="absolute -bottom-0.5 w-3 rounded-xl"></div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input class="hidden conversation-limit" value="{{ preference('conversation_limit') }}" />
                        <a id="addTextField" class="flex justify-end items-center text-color-14 dark:text-white font-Figtree text-[13px] leading-5 font-normal gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 1.5C6.20711 1.5 6.375 1.66789 6.375 1.875V5.625H10.125C10.3321 5.625 10.5 5.79289 10.5 6C10.5 6.20711 10.3321 6.375 10.125 6.375H6.375V10.125C6.375 10.3321 6.20711 10.5 6 10.5C5.79289 10.5 5.625 10.3321 5.625 10.125V6.375H1.875C1.66789 6.375 1.5 6.20711 1.5 6C1.5 5.79289 1.66789 5.625 1.875 5.625H5.625V1.875C5.625 1.66789 5.79289 1.5 6 1.5Z" fill="currentColor"/>
                            </svg>
                            <p> {{ __('Text Block') }}</p>
                        </a>
                    </div>
                    <button
                        class="magic-bg w-max rounded-lg text-16 text-white font-semibold py-2.5 px-[38px] flex justify-center items-center gap-3 mt-[17px] mx-auto"
                        id="voice-generation">
                        <span>
                            {{ __('Generate Voice') }}
                        </span>
                        <svg class="loader animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="72"
                            height="72" viewBox="0 0 72 72" fill="none">
                            <mask id="path-1-inside-1_1032_3036" fill="white">
                                <path
                                    d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" />
                            </mask>
                            <path
                                d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"
                                stroke="url(#paint0_linear_1032_3036)" stroke-width="24"
                                mask="url(#path-1-inside-1_1032_3036)" />
                            <defs>
                                <linearGradient id="paint0_linear_1032_3036" x1="46.8123" y1="63.1382" x2="21.8195"
                                    y2="6.73779" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#E60C84" />
                                    <stop offset="1" stop-color="#FFCF4B" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </button>
                </div>
            </form>
            <div class="rounded-xl documents-table image-list-table">
                <div class="overflow-auto" id="text-to-speech-table">  
                    @foreach ($audios as $audio)  
                    <table class="min-w-full my-3 rounded-xl bg-white dark:bg-[#3A3A39]" id="audio_{{ $audio->id }}">
                        <tbody id="documents-table-body">
                            <tr class="border-b dark:border-[#474746]" id="speechTableRow">
                                <td class=" py-[18px] 3xl:pl-[18px] md:pr-6 px-3">
                                    <span class="text-[12px] leading-6 font-Figtree text-color-89 font-medium hidden min-[890px]:block">{{ __('Prompt') }}</span>
                                    <a href="{{ route('user.textToSpeechView', ['id' => $audio->id]) }}"
                                        class="flex items-center justify-start">
                                        <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree w-[200px] xs:w-[234px] min-[500px]:w-[300px]
                                        md:w-full min-[850px]:w-[260px] lg:w-[350px] xl:w-[265px] 5xl:w-[300px] word-break flex items-center wrap-anywhere">
                                        {!! trimWords($audio->prompt, 80) !!}
                                        </span>
                                        
                                    </a>
                                    <div class="flex gap-2 items-start mt-2 xl:hidden">
                                        <div class="w-[112px] min-[500px]:w-[150px]">
                                            <span class="text-color-89 font-medium text-xs font-Figtree word-break flex items-center ">
                                                {{ $audio->language }}
                                            </span>
                                            <span class="text-color-89 mt-2 font-medium text-xs font-Figtree word-break flex items-center">
                                                {{ !empty($audio->created_at) ? timeToGo($audio->created_at, false, 'ago') : '-' }}
                                            </span>
                                        </div>
                                        <span class="text-color-89 font-medium text-xs font-Figtree wrap-anywhere flex items-center min-[890px]:hidden w-[112px] min-[500px]:w-[150px]">
                                            {{ $audio->voice . ' ' . '(' . $audio->gender . ')' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden xl:table-cell break-words align-top">
                                    <span class="text-12 font-Figtree mb-1.5 block text-color-89 font-medium">{{ __('Language') }}</span>
                                    <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                        {{ $audio->language }}
                                    </span>
                                </td>
                                <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden min-[890px]:table-cell break-words align-top">
                                    <span class="text-12 font-Figtree mb-1.5 block text-color-89 font-medium">{{ __('Voice') }}</span>
                                    <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                        {{ $audio->voice . ' ' . '(' . $audio->gender . ')' }}
                                    </span>
                                </td>
                                <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden xl:table-cell break-words align-top">
                                    <span class="text-12 font-Figtree mb-1.5 block text-color-89 font-medium">{{ __('Date') }}</span>
                                    <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                        {{ !empty($audio->created_at) ? timeToGo($audio->created_at, false, 'ago') : '-' }}
                                        </span>
                                </td>
                                <td class="py-[18px] text-color-89 font-medium px-3 w-[135px] whitespace-nowrap hidden xl:table-cell break-words align-top">
                                    <span class="text-12 font-Figtree mb-1.5 block text-color-89 font-medium">{{ __('Characters') }}</span>
                                    <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                        {{ $audio->characters }}
                                    </span>
                                </td>
                                <td class="py-[18px] text-color-14 dark:text-white font-medium ltr:3xl:pr-[25px] ltr:pr-3 rtl:3xl:pl-[25px] rtl:pl-3 w-max align-middle text-right">
                                    <div class="flex items-center justify-end gap-4 w-[200px] lg:w-[240px]">
                                        <div class="gap-4 justify-end items-center flex">
                                            <div class="relative play-nav">
                                                <a class="speech-tooltip-delete flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 play-nav-toggle rounded-lg justify-center cursor-pointer" title="{{ __('Play Audio')}}">
                                                    <button data-src="{{ $audio->googleAudioUrl() }}" class="play-pause-button">
                                                        <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                            <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"/>
                                                        </svg>
                                                    </button>
                                                    <div class="play-collapse hidden">
                                                        <div class="flex justify-center gap-2 items-center">
                                                            <div class="w-[60px] waveform"></div>
                                                            <div class="w-9" id="waveform-time-indicator-view">
                                                                <p class="font-medium text-color-14 text-[10px] font-Figtree leading-[14px] dark:text-white ltr:pr-2 rtl:pl-2 time">00:00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="xl:flex gap-4 hidden">
                                                <div class="relative">
                                                    <a href="{{ $audio->googleAudioUrl() }}" download={{ $audio->file_name }} class="file-need-download speech-tooltip-delete flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center cursor-pointer" title="{{ __('Download Audio')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                            <path d="M8 11.5L3.625 7.125L4.85 5.85625L7.125 8.13125V1H8.875V8.13125L11.15 5.85625L12.375 7.125L8 11.5ZM1 15V10.625H2.75V13.25H13.25V10.625H15V15H1Z" fill="currentColor"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <a id="{{ $audio->id }}" class="speech-tooltip-delete delete-wavesuffer-audio relative flex items-center p-2 border border-color-89 dark:border-color-47 bg-white text-color-14 dark:text-white dark:bg-color-47 rounded-lg justify-center modal-toggle" title="{{ __('Delete Audio')}}" href="javascript: void(0)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M3.84615 2.8C3.37884 2.8 3 3.15817 3 3.6V4.4C3 4.84183 3.37884 5.2 3.84615 5.2H4.26923V12.4C4.26923 13.2837 5.0269 14 5.96154 14H11.0385C11.9731 14 12.7308 13.2837 12.7308 12.4V5.2H13.1538C13.6212 5.2 14 4.84183 14 4.4V3.6C14 3.15817 13.6212 2.8 13.1538 2.8H10.1923C10.1923 2.35817 9.81347 2 9.34615 2H7.65385C7.18653 2 6.80769 2.35817 6.80769 2.8H3.84615ZM6.38462 6C6.61827 6 6.80769 6.17909 6.80769 6.4V12C6.80769 12.2209 6.61827 12.4 6.38462 12.4C6.15096 12.4 5.96154 12.2209 5.96154 12L5.96154 6.4C5.96154 6.17909 6.15096 6 6.38462 6ZM8.5 6C8.73366 6 8.92308 6.17909 8.92308 6.4V12C8.92308 12.2209 8.73366 12.4 8.5 12.4C8.26634 12.4 8.07692 12.2209 8.07692 12V6.4C8.07692 6.17909 8.26634 6 8.5 6ZM11.0385 6.4V12C11.0385 12.2209 10.849 12.4 10.6154 12.4C10.3817 12.4 10.1923 12.2209 10.1923 12V6.4C10.1923 6.17909 10.3817 6 10.6154 6C10.849 6 11.0385 6.17909 11.0385 6.4Z" fill="currentColor"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="relative xl:hidden inline-block">
                                            <button class="table-dropdown-click">
                                                <a href="javascript: void(0)" class="cursor-pointer border p-2 border-color-89 dark:bg-color-47 dark:border-color-47 rounded-lg flex justify-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                        <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z" fill="#898989"></path>
                                                    </svg>
                                                </a>
                                            </button>
                                            <div class="absolute ltr:right-0 rtl:left-0 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-50 table-drop-body dropdown-shadow">
                                                <div>
                                                    <a href="{{ $audio->googleAudioUrl() }}" download={{ $audio->file_name }} class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg text-left">
                                                        <span class="w-4 h-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                                <path d="M8 11.5L3.625 7.125L4.85 5.85625L7.125 8.13125V1H8.875V8.13125L11.15 5.85625L12.375 7.125L8 11.5ZM1 15V10.625H2.75V13.25H13.25V10.625H15V15H1Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        <p>{{ __('Download Audio')}}</p>
                                                    </a>
                                                    <a href="javascript: void(0)" id="{{ $audio->id }}" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-none rounded-b-lg  modal-toggle text-left delete-wavesuffer-audio">
                                                        <span class="w-4 h-3">
                                                            <svg class="w-3 h-3" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.846154 0.8C0.378836 0.8 0 1.15817 0 1.6V2.4C0 2.84183 0.378836 3.2 0.846154 3.2H1.26923V10.4C1.26923 11.2837 2.0269 12 2.96154 12H8.03846C8.9731 12 9.73077 11.2837 9.73077 10.4V3.2H10.1538C10.6212 3.2 11 2.84183 11 2.4V1.6C11 1.15817 10.6212 0.8 10.1538 0.8H7.19231C7.19231 0.358172 6.81347 0 6.34615 0H4.65385C4.18653 0 3.80769 0.358172 3.80769 0.8H0.846154ZM3.38462 4C3.61827 4 3.80769 4.17909 3.80769 4.4V10C3.80769 10.2209 3.61827 10.4 3.38462 10.4C3.15096 10.4 2.96154 10.2209 2.96154 10L2.96154 4.4C2.96154 4.17909 3.15096 4 3.38462 4ZM5.5 4C5.73366 4 5.92308 4.17909 5.92308 4.4V10C5.92308 10.2209 5.73366 10.4 5.5 10.4C5.26634 10.4 5.07692 10.2209 5.07692 10V4.4C5.07692 4.17909 5.26634 4 5.5 4ZM8.03846 4.4V10C8.03846 10.2209 7.84904 10.4 7.61538 10.4C7.38173 10.4 7.19231 10.2209 7.19231 10V4.4C7.19231 4.17909 7.38173 4 7.61538 4C7.84904 4 8.03846 4.17909 8.03846 4.4Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        
                                                        <p>{{ __('Remove from History')}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="index-modal modal absolute z-50 top-0 left-0 right-0 w-full h-full">
        <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
        </div>
        <div class="modal-wrapper modal-wrapper modal-transition fixed inset-0 z-10">
            <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                    <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                        {{ __('Are you sure you want to delete this audio?') }}</p>
                    <div class="flex justify-center items-center mt-7 gap-[16px]">
                        <a href="javascript: void(0)"
                            class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                            {{ __('Cancel') }}</a>
                        <a href="javascript: void(0)" class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-audio">
                            {{ __('Yes, Delete') }} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>
{{-- end main content --}}
@endsection
@section('js')
    <script> 
        var PROMT_URL = "{{ !empty($promtUrl) ? $promtUrl : ''  }}"; 
        var max_length = "{{ preference('long_desc_length') }}"  
    </script>
    <script src="{{ asset('public/assets/js/user/text-to-speech.min.js') }}"></script>
@endsection
