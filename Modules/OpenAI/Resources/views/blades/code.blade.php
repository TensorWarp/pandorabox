@extends('layouts.user_master')
@section('page_title', __('Code Writer'))
@section('css')
<link rel="stylesheet" media="all"  href="{{ asset('Modules/OpenAI/Resources/assets/css/dark.min.css') }}">
@endsection
@section('content')
{{-- main content --}}
<div class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="bg-[#F6F3F2] dark:bg-[#3A3A39] xl:w-[401px] 5xl:w-[474px] sidebar-scrollbar xl:overflow-auto xl:h-screen pt-14">
            @include('openai::user.includes.sidebar-code')
        </div>
        <div class="grow xl:px-0 px-5 xl:pt-[74px] pt-5 9xl:pb-[46px] dark:bg-[#292929] xl:overflow-auto sidebar-scrollbar xl:w-1/2">
            <div class="border-b border-color-DF dark:border-[#474746] mt-1">
                <div class="sm:flex justify-between items-center mb-3">
                    <div class="sm:text-left text-center">
                        <p class="font-semibold text-color-14 dark:text-white text-15 px-6">
                            {{ __('Code Writer') }}
                        </p>
                    </div>
                    <div class="flex gap-7 justify-center items-center pt-[21px] sm:pt-0 px-6">
                        <a class="flex items-center gap-2 text-color-14 dark:text-white" href="javascript: void(0)" id="download-code">
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_2836_1803)">
                                <path d="M15.75 7.01471H12.2143V2.25H6.91071V7.01471H3.375L9.5625 12.5735L15.75 7.01471ZM3.375 14.1618V15.75H15.75V14.1618H3.375Z" fill="currentColor"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_2836_1803">
                                <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg>
                            <span class="font-normal text-15">{{ __('Download Code') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="code-area 7xl:px-40 lg:px-10 px-0 2xl:py-5 overflow-hidden pb-28 pt-5">
                <p class="font-Figtree text-normal text-color-89 text-[15px] leading-[22px] text-center pt-5 static-code-text 6xl:w-[640px] xl:w-[420px] mx-auto">{{ __('Select options related to your need and write down briefly about the code that you want to generate. Your generated code will appear here.')}}</p>
            </div>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection
@section('js')
    <script> var PROMT_URL = "{{ !empty($promtUrl) ? $promtUrl : ''  }}";  </script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/highlight.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
