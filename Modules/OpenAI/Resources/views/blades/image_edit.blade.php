@extends('layouts.user_master')
@section('page_title', __('Image Maker'))
@section('content')
    {{-- main content --}}
    <div
        class="w-[68.9%] 7xl:w-[83.9%] dark:bg-[#292929] flex flex-col flex-1 border-l dark:border-[#474746] border-color-DF h-screen">
        <div class="subscription-main flex xl:flex-row flex-col xl:h-full subscription-main md:overflow-auto sidebar-scrollbar md:h-screen overflow-x-hidden">
            <div
                class="bg-[#F6F3F2] dark:bg-[#3A3A39] xl:w-[401px] 5xl:w-[474px] sidebar-scrollbar xl:overflow-auto xl:h-screen pt-14">
                @include('openai::user.includes.sidebar_image')
            </div>
            <div class="grow xl:px-0 px-5 xl:pt-[74px] pt-5 9xl:pb-[46px] pb-24 dark:bg-[#292929] xl:overflow-x-hidden xl:overflow-y-auto sidebar-scrollbar h-screen xl:w-1/2">
                <div class="border-b border-color-DF dark:border-[#474746] mt-1">
                    <div class="sm:flex justify-between items-center mb-3">
                        <div class="sm:text-left text-center">
                            <p class="font-semibold text-color-14 dark:text-white text-15 px-6">
                                {{ __('Image Maker') }}
                            </p>
                        </div>
                        <div class="flex gap-7 justify-center items-center pt-[21px] sm:pt-0 px-6">
                            <a class="flex items-center gap-2 text-color-14 dark:text-white" href="{{ route('user.imageGallery') }}">
                                <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <path
                                        d="M16.875 9C16.875 11.0886 16.0453 13.0916 14.5685 14.5685C13.0916 16.0453 11.0886 16.875 9 16.875C6.91142 16.875 4.90838 16.0453 3.43153 14.5685C1.95469 13.0916 1.125 11.0886 1.125 9C1.125 8.85082 1.18426 8.70775 1.28975 8.60226C1.39524 8.49677 1.53832 8.4375 1.6875 8.4375C1.83668 8.4375 1.97976 8.49677 2.08525 8.60226C2.19074 8.70775 2.25 8.85082 2.25 9C2.24775 10.5064 2.74871 11.9704 3.67338 13.1596C4.59805 14.3489 5.89344 15.1952 7.35394 15.5642C8.81444 15.9333 10.3564 15.8039 11.735 15.1967C13.1136 14.5895 14.2499 13.5393 14.9635 12.2126C15.6772 10.886 15.9273 9.35898 15.6741 7.87399C15.4209 6.38901 14.679 5.03113 13.5661 4.01589C12.4532 3.00065 11.0331 2.38621 9.53116 2.2701C8.02923 2.15399 6.53155 2.54287 5.27584 3.375H5.625C5.77418 3.375 5.91726 3.43427 6.02275 3.53976C6.12824 3.64525 6.1875 3.78832 6.1875 3.9375C6.1875 4.08669 6.12824 4.22976 6.02275 4.33525C5.91726 4.44074 5.77418 4.5 5.625 4.5H3.9375C3.86362 4.50005 3.79046 4.48553 3.72219 4.45727C3.65393 4.42902 3.5919 4.38759 3.53966 4.33535C3.48742 4.2831 3.44599 4.22108 3.41773 4.15281C3.38948 4.08455 3.37496 4.01138 3.375 3.9375V2.25C3.375 2.10082 3.43426 1.95775 3.53975 1.85226C3.64524 1.74677 3.78832 1.6875 3.9375 1.6875C4.08668 1.6875 4.22976 1.74677 4.33525 1.85226C4.44074 1.95775 4.5 2.10082 4.5 2.25V2.53908C5.68056 1.71625 7.06407 1.2327 8.50017 1.141C9.93627 1.0493 11.37 1.35295 12.6457 2.01895C13.9213 2.68495 14.99 3.68783 15.7356 4.91861C16.4813 6.14938 16.8753 7.56098 16.875 9ZM14.0625 9C14.0625 10.0013 13.7656 10.9801 13.2093 11.8126C12.653 12.6451 11.8624 13.294 10.9373 13.6771C10.0123 14.0603 8.99438 14.1606 8.01236 13.9652C7.03033 13.7699 6.12827 13.2877 5.42027 12.5797C4.71227 11.8717 4.23011 10.9697 4.03477 9.98765C3.83944 9.00562 3.93969 7.98772 4.32286 7.06267C4.70603 6.13762 5.3549 5.34696 6.18743 4.79069C7.01995 4.23441 7.99873 3.9375 9 3.9375C10.3422 3.93897 11.629 4.47281 12.5781 5.42189C13.5272 6.37098 14.061 7.6578 14.0625 9ZM10.9995 9.657L9.5625 8.69898V6.1875C9.5625 6.03832 9.50324 5.89525 9.39775 5.78976C9.29226 5.68427 9.14918 5.625 9 5.625C8.85082 5.625 8.70774 5.68427 8.60225 5.78976C8.49676 5.89525 8.4375 6.03832 8.4375 6.1875V9C8.43752 9.0926 8.46039 9.18376 8.50409 9.2654C8.54778 9.34704 8.61095 9.41663 8.68799 9.468L10.3755 10.593C10.4996 10.674 10.6507 10.7028 10.7959 10.673C10.9411 10.6432 11.0687 10.5573 11.151 10.434C11.2332 10.3107 11.2634 10.1598 11.235 10.0143C11.2067 9.86885 11.122 9.74043 10.9995 9.657Z"
                                        fill="currentColor" />
                                </svg>
                                <p>{{ __('Image History') }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="image-content" class="pb-32 md:px-10">
                    <p class="font-Figtree text-normal text-color-89 text-[15px] leading-[22px] text-center pt-5 static-image-text 7xl:w-[640px] 2xl:w-[450px] xl:w-[400px] mx-auto">{{ __('Select options related to your need and write down briefly about the image that you want to generate. Your generated image will appear here.')}}</p>
                </div>

            </div>
        </div>
    </div>
    {{-- end main content --}}
@endsection
@section('js')
    <script>
        var PROMT_URL = "{{ !empty($promtUrl) ? $promtUrl : '' }}";
        $("#tooltip-2").tooltip();
    </script>
    <script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
@endsection
