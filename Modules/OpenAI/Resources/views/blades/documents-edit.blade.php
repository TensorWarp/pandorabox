@extends('layouts.user_master')
@section('page_title', __('Edit Document'))
@section('content')
{{-- main-content --}}
<div class="w-[68.9%] 5xl:w-[85.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen border-right">
    <div class="justify-between subscription-main flex xl:flex-row flex-col xl:h-full subscription-main md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="w-full xl:px-0 px-5 pt-[74px] pb-[46px] dark:bg-[#292929] xl:overflow-auto sidebar-scrollbar h-screen">
            <div class="flex justify-between items-center lg:mx-6 mb-4 gap-5">
                <div>
                    <div class="flex gap-1.5 leading-[22px] items-center font-medium text-color-2C dark:text-white text-[15px] edit-url">
                        <a href="{{ route('user.documents') }}">
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.875 6C15.875 5.68934 15.6232 5.4375 15.3125 5.4375L2.0455 5.4375L5.58525 1.89775C5.80492 1.67808 5.80492 1.32192 5.58525 1.10225C5.36558 0.882582 5.00942 0.882582 4.78975 1.10225L0.289752 5.60225C0.0700827 5.82192 0.0700827 6.17808 0.289752 6.39775L4.78975 10.8977C5.00942 11.1174 5.36558 11.1174 5.58525 10.8977C5.80492 10.6781 5.80492 10.3219 5.58525 10.1023L2.0455 6.5625L15.3125 6.5625C15.6232 6.5625 15.875 6.31066 15.875 6Z" fill="currentColor" />
                            </svg>
                        </a>
                        <p class="content-name px-3 line-clamp-single break-all">{{ __('Content of a :x', ['x' => trimWords($useCase->title, 120) ?? '']) }}</p>
                    </div>
                </div>
                <div class="flex justify-end 2xl:gap-10 gap-3 items-center">
                    <p class="hidden xl:block text-center word-counter text-sm font-medium text-color-14 dark:text-white font-Figtree whitespace-nowrap"></p>
                    @if(empty($useCase->parent_id))
                    <p class="magic-bg text-center content-update flex justify-center items-center gap-2 text-white font-Figtree xl:text-sm text-xs border border-color-DF py-1 xl:px-6 px-4 rounded-lg cursor-pointer font-medium">{{ __('Update') }}
                        <svg class="animate-spin h-5 w-5 m-auto loader-update hidden" xmlns="http://www.w3.org/2000/svg" width="72"
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
                    </p>
                    @endif
                    <div class="relative">
                        <div class="dropdown-click">
                            <a href="javascript:void(0)" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none">
                                    <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z"fill="#898989" />
                                </svg>
                            </a>
                        </div>
                        <div class="hidden origin-top-right absolute ltr:right-1 rtl:left-1 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-[9999] drop-down dropdown-shadow">
                            <div>
                                <a href="javascript:void(0)" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg generate-pdf">
                                    <span class="w-4 h-4">
                                        <svg class="w-4 h-4 neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_1227_1376)">
                                            <path d="M14 6.23529H10.8571V2H6.14286V6.23529H3L8.5 11.1765L14 6.23529ZM3 12.5882V14H14V12.5882H3Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1227_1376">
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                    
                                    <p class="generate-pdf">{{ __('Download PDF') }}</p>
                                </a>
                                <a href="javascript:void(0)" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] generate-word">
                                    <span class="w-4 h-4">
                                        <svg class="w-4 h-4 neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_1227_1376)">
                                            <path d="M14 6.23529H10.8571V2H6.14286V6.23529H3L8.5 11.1765L14 6.23529ZM3 12.5882V14H14V12.5882H3Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1227_1376">
                                                <rect width="16" height="16" fill="white" />
                                            </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                    
                                    <p>{{__('Download DOCX') }}
                                    </p>
                                </a>
                                <a href="javascript:void(0)" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] copy-text hover:rounded-b-lg">
                                    <span class="w-4 h-4">
                                        <svg class="w-4 h-4 neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_1227_1386)">
                                        <path d="M11.1053 2H4.15789C3.52105 2 3 2.49091 3 3.09091V10.7273H4.15789V3.09091H11.1053V2ZM10.5263 4.18182L14 7.45455V12.9091C14 13.5091 13.4789 14 12.8421 14H6.46789C5.83105 14 5.31579 13.5091 5.31579 12.9091L5.32158 5.27273C5.32158 4.67273 5.83684 4.18182 6.47368 4.18182H10.5263ZM9.94737 8H13.1316L9.94737 5V8Z" fill="currentColor"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_1227_1386">
                                        <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                    
                                    <p>{{ __('Copy to clipboard') }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <textarea id="basic-example" class="hidden">
                {{ !empty($useCase->content) ? nl2br($useCase->content) : '' }}
            </textarea>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection
@section('js')
<script src="{{ asset('public/assets/plugin/tinymce 6.3.1/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('Modules/OpenAI/Resources/assets/js/tiny_mce.min.js') }}"></script>
    <script> var PROMT_URL = "{{ !empty($promtUrl) ? $promtUrl : ''  }}";  </script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/fileSaver.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/jquery.wordexport.min.js') }}"></script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/html2pdf.min.js') }}"></script>
@endsection
