@extends('layouts.user_master')
@section('page_title', __('View Image'))
@section('content')
<div class="dark:bg-[#292929] bg-[#F6F3F2] sidebar-scrollbar overflow-auto flex flex-col flex-1 font-Figtree">
    <div>
        <div class="7xl:px-[185px] px-5 pt-[74px] pb-[56px]">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <div class="font-normal text-color-14 dark:text-white text-15 flex justify-start gap-3 items-center">
                        <a  href="{{ route('user.imageList') }}">
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.875 6C15.875 5.68934 15.6232 5.4375 15.3125 5.4375L2.0455 5.4375L5.58525 1.89775C5.80492 1.67808 5.80492 1.32192 5.58525 1.10225C5.36558 0.882582 5.00942 0.882582 4.78975 1.10225L0.289752 5.60225C0.0700827 5.82192 0.0700827 6.17808 0.289752 6.39775L4.78975 10.8977C5.00942 11.1174 5.36558 11.1174 5.58525 10.8977C5.80492 10.6781 5.80492 10.3219 5.58525 10.1023L2.0455 6.5625L15.3125 6.5625C15.6232 6.5625 15.875 6.31066 15.875 6Z" fill="currentColor" />
                            </svg>
                        </a>
                        <span>{{ __('Image Details') }}</span>
                    </div>
                    <a class="flex items-center text-color-14 dark:text-white font-normal text-15 gap-3"
                        href="{{ route('user.imageTemplate', ['promt' => $images->promt]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7 1.75C7.24162 1.75 7.4375 1.94588 7.4375 2.1875V6.5625H11.8125C12.0541 6.5625 12.25 6.75838 12.25 7C12.25 7.24162 12.0541 7.4375 11.8125 7.4375H7.4375V11.8125C7.4375 12.0541 7.24162 12.25 7 12.25C6.75837 12.25 6.5625 12.0541 6.5625 11.8125V7.4375H2.1875C1.94588 7.4375 1.75 7.24162 1.75 7C1.75 6.75838 1.94588 6.5625 2.1875 6.5625H6.5625V2.1875C6.5625 1.94588 6.75838 1.75 7 1.75Z"
                                fill="currentColor" />
                        </svg>
                        <span class="w-40 md:w-full text-right">{{ __('Generate Similar Image') }}</span>
                    </a>
                </div>
                <div
                    class="bg-white dark:bg-color-3A rounded-xl lg:p-8 p-4 flex xl:flex-row flex-col lg:gap-8 gap-6">
                    <span class="h-[512px] 3xl:w-[512px] xl:w-[400px] w-full">
                        <img class="rounded-md h-full w-full border border-color-DF dark:border-color-3A object-cover"
                            src="{{ $images->imageUrl() }}" alt="">
                    </span>
                    <div class="grow xl:w-1/3 w-full">
                        <p class="text-14 font-Figtree text-color-89 font-medium">{{ __('Image Prompt') }}</p>
                        <p class="mt-2 font-Figtree font-normal text-color-14 dark:text-white text-16 break-words line-clamp-double">
                            {{$images->name }}
                        </p>
                        <div class="mt-6 flex items-center flex-wrap lg:gap-4 gap-3">
                        <div class="bg-color-F3 dark:bg-color-47 md:p-4 p-3 rounded-lg lg:w-[200px] xs:w-[167px] w-full">
                                <p class="text-14 font-Figtree text-color-89 font-medium">{{ __('Image Style') }}
                                </p>
                                <p class="mt-2 font-Figtree font-medium text-color-14 dark:text-white text-16 break-words">
                                    {{ ucfirst($images->art_style) }}</p>
                            </div>
                            <div class="bg-color-F3 dark:bg-color-47 md:p-4 p-3 rounded-lg lg:w-[200px] xs:w-[167px] w-full">
                                <p class="text-14 font-Figtree text-color-89 font-medium">{{ __('Ligting Effect') }}
                                </p>
                                <p class="mt-2 font-Figtree font-medium text-color-14 dark:text-white text-16 break-words">
                                    {{ ucfirst($images->lighting_style) }}
                                </p>
                            </div>
                            <div class="bg-color-F3 dark:bg-color-47 md:p-4 p-3 rounded-lg lg:w-[200px] xs:w-[167px] w-full">
                                <p class="text-14 font-Figtree text-color-89 font-medium">{{ __('Resolution') }}
                                </p>
                                <p class="mt-2 font-Figtree font-medium text-color-14 dark:text-white text-16 break-words">
                                    {{ $images->size }}
                                </p>
                            </div>
                            <div class="bg-color-F3 dark:bg-color-47 md:p-4 p-3 rounded-lg lg:w-[200px] xs:w-[167px] w-full">
                                <p class="text-14 font-Figtree text-color-89 font-medium">{{ __('Created On') }}
                                </p>
                                <p
                                    class="mt-2 font-Figtree whitespace-nowrap font-medium text-color-14 dark:text-white text-16">
                                    {{ formatDate($images->created_at) }}
                                </p>
                            </div>
                        </div>

                        @php
                            $social = option('default_template_social', '');
                        @endphp

                        @if ($social['facebook'] || $social['whatsapp'] || $social['pinterest'] || $social['instagram'] || $social['linkedin'])
                            <div
                                class="mt-6 border border-color-DF dark:border-color-47 py-7 md:px-4 px-3 flex lg:items-center items-start justify-start gap-4">
                                <p class="font-Figtree font-medium text-15 text-color-14 dark:text-white whitespace-nowrap"> Share on: </p>
                                <div class="flex md:gap-3 gap-2.5 flex-wrap">
                                    @if ($social['facebook'])
                                        <div class="relative">
                                            <a href="https://www.facebook.com/sharer.php?u={{ urlencode(route('user.image.view', ['slug' => $images->slug])) }}"
                                                target="_blank"
                                                class="tooltips share-button-hover bg-color-14 dark:bg-white text-white dark:text-color-14 dark:hover:text-white hover:text-white flex items-center justify-center w-8 h-8 bg-gray-3 rounded-full social-transition cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="17"
                                                    viewBox="0 0 10 17" fill="none">
                                                    <path
                                                        d="M6.94805 4.01476H9.01006V0.96875H6.58611V0.979735C3.64907 1.08376 3.04712 2.73473 2.99406 4.46875H2.98802V5.98978H0.988068V8.97273H2.98802V16.9687H6.00206V8.97273H8.47105L8.948 5.98978H6.00305V5.07081C6.00305 4.48479 6.393 4.01476 6.94805 4.01476Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span
                                                    class="image-download-tooltip-text w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[142%] right-[-60%]">{{ __('Facebook') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($social['linkedin'])
                                        <div class="relative">
                                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('user.image.view', ['slug' => $images->slug])) }}"
                                            target="_blank"
                                                class="tooltips share-button-hover text-white dark:text-color-14 dark:hover:text-white hover:text-white bg-color-14 dark:bg-white flex items-center justify-center w-8 h-8 bg-gray-3 rounded-full social-transition cursor-pointer">
                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.4 7.59561V12.0082H9.81707V7.86467C9.81707 6.84225 9.44038 6.1427 8.52559 6.1427C7.82603 6.1427 7.39554 6.627 7.2341 7.0575C7.18029 7.21893 7.12648 7.43418 7.12648 7.70324V12.0082H4.54352C4.54352 12.0082 4.59733 5.01266 4.54352 4.3131H7.12648V5.38934C7.44935 4.85122 8.09509 4.09786 9.44038 4.09786C11.1085 4.09786 12.4 5.2279 12.4 7.59561ZM1.85294 0.600098C0.991951 0.600098 0.400024 1.19203 0.400024 1.94539C0.400024 2.69875 0.93814 3.29068 1.79913 3.29068C2.71393 3.29068 3.25204 2.69875 3.25204 1.94539C3.30585 1.13821 2.76774 0.600098 1.85294 0.600098ZM0.561459 12.0082H3.14442V4.3131H0.561459V12.0082Z"
                                                        fill="currentColor" />
                                                </svg>
                                                <span
                                                    class="image-download-tooltip-text w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[142%] right-[-55%]">{{ __('LinkedIn') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($social['instagram'])
                                        <div class="relative">
                                            <a href="https://www.instagram.com/sharer.php?u={{ urlencode(route('user.image.view', ['slug' => $images->slug])) }}"
                                                    target="_blank"
                                                class="tooltips share-button-hover bg-color-14 dark:bg-white text-white dark:text-color-14 flex items-center justify-center w-8 h-8 bg-gray-3 rounded-full social-transition cursor-pointer dark:hover:text-white hover:text-white">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.2335 0H4.76649C2.13823 0 0 2.13823 0 4.76649V11.2335C0 13.8618 2.13823 16 4.76649 16H11.2335C13.8618 16 16 13.8618 16 11.2335V4.76649C16 2.13823 13.8617 0 11.2335 0ZM14.3904 11.2335C14.3904 12.977 12.977 14.3904 11.2335 14.3904H4.76649C3.023 14.3904 1.6096 12.977 1.6096 11.2335V4.76649C1.6096 3.02297 3.023 1.6096 4.76649 1.6096H11.2335C12.977 1.6096 14.3904 3.02297 14.3904 4.76649V11.2335Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M7.99999 3.86182C5.7182 3.86182 3.86182 5.7182 3.86182 7.99996C3.86182 10.2817 5.7182 12.1381 7.99999 12.1381C10.2818 12.1381 12.1382 10.2817 12.1382 7.99996C12.1382 5.71817 10.2818 3.86182 7.99999 3.86182ZM7.99999 10.5286C6.60348 10.5286 5.47142 9.39649 5.47142 7.99999C5.47142 6.60348 6.60351 5.47142 7.99999 5.47142C9.39649 5.47142 10.5286 6.60348 10.5286 7.99999C10.5286 9.39646 9.39646 10.5286 7.99999 10.5286Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M12.1462 4.88455C12.6938 4.88455 13.1378 4.4406 13.1378 3.89296C13.1378 3.34532 12.6938 2.90137 12.1462 2.90137C11.5986 2.90137 11.1546 3.34532 11.1546 3.89296C11.1546 4.4406 11.5986 4.88455 12.1462 4.88455Z"
                                                        fill="currentColor" />
                                                </svg>

                                                <span
                                                    class="image-download-tooltip-text w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[142%] right-[-65%]">{{ __('Instagram') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($social['whatsapp'])
                                        <div class="relative">
                                            <a href="https://api.whatsapp.com/send?text={{ urlencode(route('user.image.view', ['slug' => $images->slug])) }}"
                                                target="_blank"
                                                class="tooltips share-button-hover bg-color-14 dark:bg-white text-white dark:text-color-14 dark:hover:text-white hover:text-white flex items-center justify-center w-8 h-8 bg-gray-3 rounded-full social-transition cursor-pointer">

                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.3415 2.65019C12.761 1.07519 10.6537 0.200195 8.42927 0.200195C3.80488 0.200195 0.0585357 3.93353 0.0585357 8.54186C0.0585357 10.0002 0.468293 11.4585 1.17073 12.6835L0 17.0002L4.44878 15.8335C5.67805 16.4752 7.02439 16.8252 8.42927 16.8252C13.0537 16.8252 16.8 13.0919 16.8 8.48353C16.7415 6.3252 15.9219 4.22519 14.3415 2.65019ZM12.4683 11.5169C12.2927 11.9835 11.4732 12.4502 11.0634 12.5085C10.7122 12.5669 10.2439 12.5669 9.77561 12.4502C9.48293 12.3335 9.07317 12.2169 8.60488 11.9835C6.49756 11.1085 5.15122 9.00853 5.03415 8.83353C4.91707 8.71686 4.1561 7.72519 4.1561 6.67519C4.1561 5.62519 4.68293 5.15853 4.85854 4.92519C5.03415 4.69186 5.26829 4.69186 5.4439 4.69186C5.56098 4.69186 5.73658 4.69186 5.85366 4.69186C5.97073 4.69186 6.14634 4.63353 6.32195 5.04186C6.49756 5.45019 6.90732 6.5002 6.96585 6.55853C7.02439 6.6752 7.02439 6.79186 6.96585 6.90853C6.90732 7.02519 6.84878 7.14186 6.7317 7.25853C6.61463 7.37519 6.49756 7.55019 6.43902 7.60853C6.32195 7.72519 6.20488 7.84186 6.32195 8.01686C6.43902 8.25019 6.84878 8.89186 7.49268 9.47519C8.31219 10.1752 8.9561 10.4085 9.19024 10.5252C9.42439 10.6419 9.54146 10.5835 9.65853 10.4669C9.77561 10.3502 10.1854 9.88353 10.3024 9.6502C10.4195 9.41686 10.5951 9.47519 10.7707 9.53353C10.9463 9.59186 12 10.1169 12.1756 10.2335C12.4098 10.3502 12.5268 10.4085 12.5854 10.4669C12.6439 10.6419 12.6439 11.0502 12.4683 11.5169Z"
                                                        fill="currentColor" />
                                                </svg>

                                                <span
                                                    class="image-download-tooltip-text w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[142%] right-[-65%]">{{ __('Whatsapp') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($social['pinterest'])
                                        <div class="relative">
                                            <a href="http://pinterest.com/pin/create/button/?url={{ urlencode(route('user.image.view', ['slug' => $images->slug])) }}"
                                            target="_blank"
                                                class="tooltips share-button-hover bg-color-14 dark:bg-white text-white dark:text-color-14 flex items-center justify-center w-8 h-8 bg-gray-3 rounded-full social-transition cursor-pointer dark:hover:text-white hover:text-white">

                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.8043 10.3317C19.783 9.31045 18.3149 8.7998 16.7192 8.7998C14.2936 8.7998 12.8256 9.82109 11.9958 10.6509C10.9745 11.6722 10.4 13.0126 10.4 14.4168C10.4 16.1402 11.1022 17.4168 12.3149 17.9275C12.3787 17.9913 12.5064 17.9913 12.5702 17.9913C12.8256 17.9913 13.0171 17.7998 13.0809 17.5445C13.1447 17.4168 13.2085 17.0339 13.2724 16.8424C13.3362 16.5232 13.2724 16.3956 13.0809 16.1402C12.7617 15.7573 12.5702 15.2466 12.5702 14.6083C12.5702 12.7573 13.9745 10.7785 16.5277 10.7785C18.5702 10.7785 19.8468 11.9275 19.8468 13.7785C19.8468 14.9275 19.5915 16.0126 19.1447 16.8424C18.8256 17.4168 18.2511 18.0551 17.4213 18.0551C17.0383 18.0551 16.7192 17.9275 16.5277 17.6083C16.3362 17.353 16.2724 17.0339 16.3362 16.7147C16.4 16.3317 16.5277 15.9487 16.6553 15.5658C16.8468 14.8636 17.1022 14.1615 17.1022 13.6509C17.1022 12.7573 16.5277 12.119 15.6979 12.119C14.6128 12.119 13.783 13.2041 13.783 14.5445C13.783 15.2466 13.9745 15.6934 14.0383 15.8849C13.9107 16.4594 13.0809 19.8424 12.9532 20.4168C12.8894 20.7998 12.3149 23.736 13.2085 23.9275C14.166 24.1828 15.0596 21.3105 15.1234 20.9913C15.1873 20.736 15.4426 19.7147 15.5702 19.1402C16.0171 19.587 16.783 19.9062 17.549 19.9062C18.9532 19.9062 20.166 19.2679 21.0596 18.119C21.8894 17.0339 22.4 15.5019 22.4 13.7785C22.3362 12.6296 21.8256 11.2892 20.8043 10.3317Z" 
                                                    fill="currentColor"/>
                                                </svg>
                                                    
                                                <span
                                                    class="image-download-tooltip-text w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[142%] right-[-45%]">{{ __('Pinterest') }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div
                            class="mt-6 flex gap-3 lg:justify-between justify-start flex-wrap xs:flex-nowrap items-center">
                            <a href= {{ $images->imageUrl()}} download= {{ $images->promt }}>
                                <button
                                    class="magic-bg rounded-xl text-15 lg:text-16 text-white font-semibold py-[13px] lg:px-[52px] px-5 xs:px-[29px] whitespace-nowrap flex justify-center items-center gap-3 font-Figtree"
                                    id="magic-submit-button">
                                    <span>
                                        {{ __('Download Image') }}
                                    </span>
                                </button> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection
