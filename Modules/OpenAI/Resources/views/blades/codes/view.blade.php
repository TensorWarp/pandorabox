@extends('layouts.user_master')
@section('page_title', __('View Code'))
@section('content')
@section('css')
<link rel="stylesheet" media="all"  href="{{ asset('Modules/OpenAI/Resources/assets/css/dark.min.css') }}">
@endsection
{{-- main content --}}
<div class="dark:bg-[#292929] bg-[#F6F3F2] sidebar-scrollbar overflow-auto flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF h-screen code-view-area">
    <div class="9xl:px-[185px] 5xl:px-20 px-5 pt-[74px] 9xl:pb-[22px] pb-28">
        <div class="flex item-center gap-3 lg:mt-4 mb-5 mt-1.5">
            <a href="{{ route('user.codeList') }}" class="font-Figtree mt-0.5 font-normal text-color-14 dark:text-white text-[15px] leading-[22px]">
            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.875 9C16.875 8.68934 16.6232 8.4375 16.3125 8.4375H3.0455L6.58525 4.89775C6.80492 4.67808 6.80492 4.32192 6.58525 4.10225C6.36558 3.88258 6.00942 3.88258 5.78975 4.10225L1.28975 8.60225C1.07008 8.82192 1.07008 9.17808 1.28975 9.39775L5.78975 13.8977C6.00942 14.1174 6.36558 14.1174 6.58525 13.8977C6.80492 13.6781 6.80492 13.3219 6.58525 13.1023L3.0455 9.5625H16.3125C16.6232 9.5625 16.875 9.31066 16.875 9Z" fill="currentColor"/>
            </svg>
            </a>
            <span class="dark:text-white">{{ __('Code Details')}}</span>
        </div>

        <div class="bg-white dark:bg-color-3A lg:p-8 p-4 rounded-xl">
            <p class="text-color-89 font-Figtree text-sm font-medium">{{ __('Title')}}</p>
            <p class=" text-color-14 dark:text-white text-base font-Figtree font-normal mt-2 line-clamp-double">
                {{ ucfirst($code->promt) }}
            </p>
            <div class="flex lg:flex-row flex-col gap-8">
                <div class="5xl:w-[54%] lg:w-[74%] w-full">
                    <div class="mt-6 grid 4xl:grid-cols-3 grid-cols-2 gap-4">
                        <div class="p-4 bg-color-F3 dark:bg-color-47 rounded-lg">
                            <p class="text-color-89 font-Figtree text-sm font-medium">{{ __('Language')}}</p>
                            <p class=" text-color-14 dark:text-white text-base font-Figtree font-normal mt-2">{{ $code->language }}
                            </p>
                        </div>
                        <div class="p-4 bg-color-F3 dark:bg-color-47 rounded-lg">
                            <p class="text-color-89 font-Figtree text-sm font-medium">{{ __('Code Level')}}</p>
                            <p class="text-color-14 dark:text-white text-base font-Figtree font-normal mt-2">{{ codeLabel($code->code_label, true) }}</p>
                        </div>
                        <div class="p-4 bg-color-F3 dark:bg-color-47 rounded-lg">
                            <p class="text-color-89 font-Figtree text-sm font-medium">{{ __('Created On')}}</p>
                            <p class="text-color-14 dark:text-white text-base font-Figtree font-normal mt-2">{{ formatDate($code->created_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="code-view-content" class="mt-8">
                @php $codes = count($splitedCode) @endphp
                @for ($i = 0; $i < $codes; $i++)
                    @if ($i % 2 != 0)
                        <pre class="code area relative" data-language="php" id="codetext"><code class="!pt-10"> {{ $splitedCode[$i] }}</code>
                            <a href="javaScript:void(0);" class="absolute flex gap-2 items-center justify-center text-color-14 bg-white md:py-2.5 py-1.5 md:px-5 px-3 border border-color-89 rounded-lg top-4 right-4 font-semibold font-Figtree copy-code">
                                <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18"fill="none"><g clip-path="url(#clip0_3914_2023)"><path d="M12.5 0.75H3.5C2.675 0.75 2 1.425 2 2.25V12.75H3.5V2.25H12.5V0.75ZM11.75 3.75L16.25 8.25V15.75C16.25 16.575 15.575 17.25 14.75 17.25H6.4925C5.6675 17.25 5 16.575 5 15.75L5.0075 5.25C5.0075 4.425 5.675 3.75 6.5 3.75H11.75ZM11 9H15.125L11 4.875V9Z" fill="currentColor" /></g><defs>
                                    <clipPath id="clip0_3914_2023"><rect width="18" height="18" fill="white" transform="translate(0.5)" /></clipPath></defs>
                                </svg>
                                <span>{{ __('Copy Code')}}</span>
                            </a>
                        </pre>
                    @else
                        <div class="context-area mb-5 text-base font-Figtree text-color-14 dark:text-white font-normal leading-6">{{ $splitedCode[$i] }}</div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection
@section('js')
<script> var PROMT_URL = "{{ !empty($promtUrl) ? $promtUrl : ''  }}";  </script>
<script src="{{ asset('Modules/OpenAI/Resources/assets/js/highlight.min.js') }}" type="text/javascript"></script>
@endsection
