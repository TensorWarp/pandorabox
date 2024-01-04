@extends('layouts.user_master')
@section('page_title', __('Templates'))
@section('content')
{{-- main-content --}}
<div class="w-[68.9%] 5xl:w-[85.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen border-right">
    <div class="subscription-main flex xl:flex-row flex-col xl:h-full md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
        <div class="bg-[#F6F3F2] dark:bg-[#3A3A39] xl:w-[401px] 5xl:w-[474px] sidebar-scrollbar xl:overflow-auto xl:h-screen pt-14">
            @include('openai::user.includes.sidebar')
        </div>
        <div class="grow xl:pt-[74px] pt-5 dark:bg-[#292929] xl:overflow-auto sidebar-scrollbar h-screen xl:w-1/2">
            <div class="flex justify-between items-center lg:mx-6 mb-4 xl:px-0 px-5 gap-5">
                <div>
                    <div class="flex gap-1.5 leading-[22px] items-center font-medium text-color-2C dark:text-white text-[15px] edit-url">
                        <a href="{{ route('openai') }}">
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.875 6C15.875 5.68934 15.6232 5.4375 15.3125 5.4375L2.0455 5.4375L5.58525 1.89775C5.80492 1.67808 5.80492 1.32192 5.58525 1.10225C5.36558 0.882582 5.00942 0.882582 4.78975 1.10225L0.289752 5.60225C0.0700827 5.82192 0.0700827 6.17808 0.289752 6.39775L4.78975 10.8977C5.00942 11.1174 5.36558 11.1174 5.58525 10.8977C5.80492 10.6781 5.80492 10.3219 5.58525 10.1023L2.0455 6.5625L15.3125 6.5625C15.6232 6.5625 15.875 6.31066 15.875 6Z" fill="currentColor" />
                            </svg>
                        </a>
                        <p class="content-name px-3 line-clamp-single break-all">{{ __('Content of a :x', ['x' => trimWords($slug, 120) ?? '']) }}</p>
                    </div>
                </div>
                <div class="flex justify-end 2xl:gap-10 gap-3">
                    <p class="text-center word-counter text-color-2c dark:text-white whitespace-nowrap text-[15px] leading-[22px] font-medium"> </p>
                    <div class="flex justify-end gap-10 items-center">
                    <div class="relative">
                        <div class="dropdown-click">
                            <a href="#" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none">
                                    <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z"fill="#898989" />
                                </svg>
                            </a>
                        </div>
                        <div class="hidden dropdown-rtl origin-top-right absolute right-1 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-[9999] drop-down dropdown-shadow">
                            <div>
                                <a href="#" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg generate-pdf">
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
                                <a href="#" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] generate-word">
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
                                <a href="#" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 hover:dark:bg-[#3A3A39] copy-text">
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
               
            </div>
            <textarea id="basic-example" class="hidden">
                {{ !empty($useCase->content) ? $useCase->content : '' }}
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
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
