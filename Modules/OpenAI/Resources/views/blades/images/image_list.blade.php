@extends('layouts.user_master')
@section('page_title', __('Image History'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.css') }}">
@endsection
@php
    $imageToggleFavoriteUrl = route('user.image.toggle.favorite');
@endphp
@section('content')
{{-- main content --}}
<div class="dark:bg-[#292929] bg-[#F6F3F2] sidebar-scrollbar overflow-auto flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF h-screen">
    <div class="9xl:px-[185px] 7xl:px-[140px] px-5 pt-[74px] 9xl:pb-[22px] pb-28">
        <div class="flex justify-between items-center gap-3 flex-wrap mt-[9px]">
            <div class="xs:w-[61%]">
                <p class="text-color-14 font-RedHat font-semibold leading-8 text-[24px] dark:text-white wrap-anywhere">{{ __('Image Gallery')}}</p>
                <p class="font-Figtree text-color-89 font-medium leading-[22px] text-[15px] mt-2 wrap-anywhere">{{ __('All your generated images using :x in one place.', ['x' => preference('company_name')])}}</p>
            </div>
            <a class="magic-bg rounded-xl text-base text-white justify-center items-center font-semibold py-3 flex text-center mt-4 cursor-pointer font-Figtree w-max px-[21px] whitespace-nowrap magic-shadow" href="{{ route('user.imageTemplate') }}">
                <span> {{ __('Create New') }}</span>
            </a>
        </div>

        <div class="flex gap-3 justify-start image-gallery items-center flex-wrap mt-[31px]">
            <a href="{{ route('user.imageGallery') }}">
                <svg class="text-color-[#3A3A39] dark:text-color-89 Mandatory" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7587 2H16.2413C17.0463 1.99999 17.7106 1.99998 18.2518 2.04419C18.8139 2.09012 19.3306 2.18868 19.816 2.43598C20.5686 2.81947 21.1805 3.43139 21.564 4.18404C21.8113 4.66937 21.9099 5.18608 21.9558 5.74817C22 6.28936 22 6.95372 22 7.75868V16.2413C22 17.0463 22 17.7106 21.9558 18.2518C21.9099 18.8139 21.8113 19.3306 21.564 19.816C21.1805 20.5686 20.5686 21.1805 19.816 21.564C19.3306 21.8113 18.8139 21.9099 18.2518 21.9558C17.7106 22 17.0463 22 16.2413 22H7.75868C6.95372 22 6.28936 22 5.74817 21.9558C5.18608 21.9099 4.66937 21.8113 4.18404 21.564C3.43139 21.1805 2.81947 20.5686 2.43598 19.816C2.18868 19.3306 2.09012 18.8139 2.04419 18.2518C1.99998 17.7106 1.99999 17.0463 2 16.2413V7.7587C1.99999 6.95373 1.99998 6.28937 2.04419 5.74817C2.09012 5.18608 2.18868 4.66937 2.43597 4.18404C2.81947 3.43139 3.43139 2.81947 4.18404 2.43597C4.66937 2.18868 5.18608 2.09012 5.74817 2.04419C6.28937 1.99998 6.95373 1.99999 7.7587 2ZM13 20H16.2C17.0566 20 17.6389 19.9992 18.089 19.9624C18.5274 19.9266 18.7516 19.8617 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C19.8617 18.7516 19.9266 18.5274 19.9624 18.089C19.9992 17.6389 20 17.0566 20 16.2V13L13 13V20ZM11 12.001V20H7.8C6.94342 20 6.36113 19.9992 5.91104 19.9624C5.47262 19.9266 5.24842 19.8617 5.09202 19.782C4.7157 19.5903 4.40973 19.2843 4.21799 18.908C4.1383 18.7516 4.07337 18.5274 4.03755 18.089C4.00078 17.6389 4 17.0566 4 16.2V7.8C4 6.94342 4.00078 6.36113 4.03755 5.91104C4.07337 5.47262 4.1383 5.24842 4.21799 5.09202C4.40973 4.7157 4.7157 4.40973 5.09202 4.21799C5.24842 4.1383 5.47262 4.07337 5.91104 4.03755C6.36113 4.00078 6.94342 4 7.8 4H11V11.999C11 11.9993 11 12.0007 11 12.001C11 12.0013 11 12.0007 11 12.001ZM13 11L20 11V7.8C20 6.94342 19.9992 6.36113 19.9624 5.91104C19.9266 5.47262 19.8617 5.24842 19.782 5.09202C19.5903 4.7157 19.2843 4.40973 18.908 4.21799C18.7516 4.1383 18.5274 4.07337 18.089 4.03755C17.6389 4.00078 17.0566 4 16.2 4H13V11Z" fill="currentColor"/>
                </svg>
            </a>
            <div class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white">
                <select class="select block w-[140px] text-[14px] leading-[22px] font-normal text-color-2C bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" onchange="filter(this)">
                    <option class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white" value="newest">{{ __('Newest') }}</option>
                    <option class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white" value="oldest">{{ __('Oldest') }}</option>
                </select>
            </div>
        </div>
        <div class="bg-white dark:bg-[#3A3A39] rounded-xl image-list-table mt-5 sm:mt-3">
            <div class="flex flex-col">
                <div class="xl:overflow-y-auto rounded-xl p-1.5">
                    <table class="min-w-full">
                        <thead class="bg-color-DF dark:bg-[#474746] rounded-xl">
                            <tr class="rounded-lg">
                                <th
                                    class="px-3 lg:px-[34px] py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white w-[224px]">
                                    {{ __('Image') }}
                                </th>
                                <th
                                    class="md:pl-[34px] md:pr-6 px-3 py-[9px] font-Figtree text-left text-14 font-medium text-color-14 w-[200px] dark:text-white break-words docs-table-row-one">
                                    {{ __('Prompt') }}
                                </th>
                                <th
                                    class="px-6 py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white hidden xl:table-cell break-words">
                                    {{ __('Resolution') }}
                                </th>
                                <th
                                    class="px-6 py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white hidden xl:table-cell break-words">
                                    {{ __('Time') }}
                                </th>
                                <th
                                    class="pr-3 xl:pr-[34px] py-[9px] text-right font-Figtree text-14 font-medium text-color-14 dark:text-white w-max action-rtl">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="gallery">
                                @forelse ($images as $image)
                                    <tr class="gallery-item border-b dark:border-[#474746]" id="image_{{ $image->id }}">
                                        <td class="pl-3 lg:pl-[34px] 2xl:w-[224px] lg:w-[124px] flex py-5 image-table-row-one">
                                            <span class="justify-center w-[52px] h-[52px] lg:h-16 lg:w-16 flex items-center">
                                                <img class="rounded-md w-[52px] h-[52px] lg:w-16 lg:h-16 border border-color-DF dark:border-color-3A neg-transition-scale"
                                                    src="{{ $image->imageUrl(['thumbnill' => true, 'size' => 'medium']) }}"
                                                    alt="">
                                            </span>
                                        </td>
                                        <td class="text-14 font-Figtree py-[18px] text-color-14 dark:text-white font-medium md:pl-[34px] md:pr-6 px-3 docs-table-row-one">
                                            <p class="w-[138px] xs:w-[191px] lg:w-[200px] 9xl:w-[300px] 6xl:w-[200px] break-words line-clamp-double">
                                                {{ $image->promt}}
                                            </p>
                                            <p class="xl:hidden mt-2 break-words">{{ $image->size }}</p>
                                            <p class="xl:hidden mt-2 break-words">{{ timeToGo($image->created_at, false, 'ago') }}</p>
                                        </td>
                                        <td class="text-13 font-Figtree py-[22px] text-color-89 font-medium px-6 w-64 hidden xl:table-cell">
                                            {{ $image->size }}
                                        </td>
                                        <td class="text-13 font-Figtree py-[22px] text-color-89 font-medium px-6 w-64 hidden xl:table-cell whitespace-nowrap">
                                            {{ timeToGo($image->created_at, false, 'ago') }}
                                        </td>
                                        <td
                                            class="text-13 font-Figtree py-[22px] text-color-89 font-medium pr-3 xl:pr-[34px] w-max align-top xl:align-middle text-right action-rtl">
                                            <div class="gap-4 justify-end items-center hidden xl:flex">
                                                <div class="relative">
                                                    <a class="image-modal-button image-tooltip-view flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center" title="{{ __('View Image')}}"  href="javascript:void(0)" data-name="{{ $image->name }}" data-promt="{{ $image->promt }}" data-id="{{ $image->id }}" data-style="{{ $image->art_style }}" data-resulation="{{ $image->size }}" data-created="{{ $image->created_at }}" data-lightstyle="{{ $image->lighting_style }}" data-is-favorite="{{ in_array($image->id, $userFavoriteImages) ? 'true' : 'false' }}" data-source="{{ $image->imageUrl(['thumbnill' => true, 'size' => 'medium']) }}" id={{ $image->id }} data-slug="{{ $image->slug }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 16 16" fill="none">
                                                            <g clip-path="url(#clip0_2387_1688)">
                                                                <path
                                                                    d="M7.99972 3C4.66638 3 1.81972 5.07333 0.666382 8C1.81972 10.9267 4.66638 13 7.99972 13C11.333 13 14.1797 10.9267 15.333 8C14.1797 5.07333 11.333 3 7.99972 3ZM7.99972 11.3333C6.15972 11.3333 4.66638 9.84 4.66638 8C4.66638 6.16 6.15972 4.66667 7.99972 4.66667C9.83972 4.66667 11.333 6.16 11.333 8C11.333 9.84 9.83972 11.3333 7.99972 11.3333ZM7.99972 6C6.89305 6 5.99972 6.89333 5.99972 8C5.99972 9.10667 6.89305 10 7.99972 10C9.10638 10 9.99972 9.10667 9.99972 8C9.99972 6.89333 9.10638 6 7.99972 6Z"
                                                                    fill="currentColor" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_2387_1688">
                                                                    <rect width="16" height="16"
                                                                        fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="relative">
                                                    <a class="file-need-download image-tooltip-download flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center" title="{{ __('Download Image')}}"  href="{{ $image->imageUrl() }}" download="{{ $image->name }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 16 16" fill="none">
                                                        <g clip-path="url(#clip0_2387_1692)">
                                                            <path
                                                                d="M14 6.23529H10.8571V2H6.14286V6.23529H3L8.5 11.1765L14 6.23529ZM3 12.5882V14H14V12.5882H3Z"
                                                                fill="currentColor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_2387_1692">
                                                                <rect width="16" height="16" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    </a>
                                                </div>
                                                <div class="relative">
                                                    <a class="image-tooltip-delete flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center modal-toggle" title="{{ __('Delete Image')}}"  href="javascript: void(0)" id="{{ $image->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                            <path d="M3.84615 2.8C3.37884 2.8 3 3.15817 3 3.6V4.4C3 4.84183 3.37884 5.2 3.84615 5.2H4.26923V12.4C4.26923 13.2837 5.0269 14 5.96154 14H11.0385C11.9731 14 12.7308 13.2837 12.7308 12.4V5.2H13.1538C13.6212 5.2 14 4.84183 14 4.4V3.6C14 3.15817 13.6212 2.8 13.1538 2.8H10.1923C10.1923 2.35817 9.81347 2 9.34615 2H7.65385C7.18653 2 6.80769 2.35817 6.80769 2.8H3.84615ZM6.38462 6C6.61827 6 6.80769 6.17909 6.80769 6.4V12C6.80769 12.2209 6.61827 12.4 6.38462 12.4C6.15096 12.4 5.96154 12.2209 5.96154 12L5.96154 6.4C5.96154 6.17909 6.15096 6 6.38462 6ZM8.5 6C8.73366 6 8.92308 6.17909 8.92308 6.4V12C8.92308 12.2209 8.73366 12.4 8.5 12.4C8.26634 12.4 8.07692 12.2209 8.07692 12V6.4C8.07692 6.17909 8.26634 6 8.5 6ZM11.0385 6.4V12C11.0385 12.2209 10.849 12.4 10.6154 12.4C10.3817 12.4 10.1923 12.2209 10.1923 12V6.4C10.1923 6.17909 10.3817 6 10.6154 6C10.849 6 11.0385 6.17909 11.0385 6.4Z" fill="currentColor"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="relative xl:hidden inline-block">
                                                <button class="table-dropdown-click">
                                                    <a href="javascript: void(0)" class="cursor-pointer border p-2 border-color-89 rounded-lg flex justify-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                            <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z" fill="#898989"></path>
                                                        </svg>
                                                    </a>
                                                </button>
                                                <div class="absolute ltr:right-0 rtl:left-0 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-50 table-drop-body dropdown-shadow table-dropdwon-rtl">
                                                    <div>
                                                        <a href="javascript:void(0)" class="image-modal-button flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg text-left" data-name="{{ $image->name }}" data-promt="{{ $image->promt }}" data-id="{{ $image->id }}" data-style="{{ $image->art_style }}" data-resulation="{{ $image->size }}" data-created="{{ $image->created_at }}" data-lightstyle="{{ $image->lighting_style }}" data-is-favorite="{{ in_array($image->id, $userFavoriteImages) ? 'true' : 'false' }}" data-source="{{ $image->imageUrl(['thumbnill' => true, 'size' => 'medium']) }}" id={{ $image->id }} data-slug="{{ $image->slug }}">
                                                            <span class="w-4 h-4">
                                                                <svg class="w-4 h-4" width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7.99984 0C4.6665 0 1.81984 2.07333 0.666504 5C1.81984 7.92667 4.6665 10 7.99984 10C11.3332 10 14.1798 7.92667 15.3332 5C14.1798 2.07333 11.3332 0 7.99984 0ZM7.99984 8.33333C6.15984 8.33333 4.6665 6.84 4.6665 5C4.6665 3.16 6.15984 1.66667 7.99984 1.66667C9.83984 1.66667 11.3332 3.16 11.3332 5C11.3332 6.84 9.83984 8.33333 7.99984 8.33333ZM7.99984 3C6.89317 3 5.99984 3.89333 5.99984 5C5.99984 6.10667 6.89317 7 7.99984 7C9.1065 7 9.99984 6.10667 9.99984 5C9.99984 3.89333 9.1065 3 7.99984 3Z" fill="currentColor"/>
                                                                </svg>
                                                            </span>
                                                            

                                                            <p>{{ __('View Image')}}</p>
                                                        </a>
                                                        <a href={{ $image->imageUrl() }} download={{ $image->name }} class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] text-left">
                                                            <span class="w-4 h-4">
                                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                                <g clip-path="url(#clip0_1227_1376)">
                                                                    <path d="M14 6.23529H10.8571V2H6.14286V6.23529H3L8.5 11.1765L14 6.23529ZM3 12.5882V14H14V12.5882H3Z" fill="currentColor"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_1227_1376">
                                                                        <rect width="16" height="16" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                </svg>
                                                            </span>
                                                            
                                                            <p>{{ __('Download')}}</p>
                                                        </a>
                                                        <a href="javascript: void(0)" id="{{ $image->id }}" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-none rounded-b-lg modal-toggle text-left">
                                                            <span class="w-4 h-3">
                                                                <svg class="w-4 h-3" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0.846154 0.8C0.378836 0.8 0 1.15817 0 1.6V2.4C0 2.84183 0.378836 3.2 0.846154 3.2H1.26923V10.4C1.26923 11.2837 2.0269 12 2.96154 12H8.03846C8.9731 12 9.73077 11.2837 9.73077 10.4V3.2H10.1538C10.6212 3.2 11 2.84183 11 2.4V1.6C11 1.15817 10.6212 0.8 10.1538 0.8H7.19231C7.19231 0.358172 6.81347 0 6.34615 0H4.65385C4.18653 0 3.80769 0.358172 3.80769 0.8H0.846154ZM3.38462 4C3.61827 4 3.80769 4.17909 3.80769 4.4V10C3.80769 10.2209 3.61827 10.4 3.38462 10.4C3.15096 10.4 2.96154 10.2209 2.96154 10L2.96154 4.4C2.96154 4.17909 3.15096 4 3.38462 4ZM5.5 4C5.73366 4 5.92308 4.17909 5.92308 4.4V10C5.92308 10.2209 5.73366 10.4 5.5 10.4C5.26634 10.4 5.07692 10.2209 5.07692 10V4.4C5.07692 4.17909 5.26634 4 5.5 4ZM8.03846 4.4V10C8.03846 10.2209 7.84904 10.4 7.61538 10.4C7.38173 10.4 7.19231 10.2209 7.19231 10V4.4C7.19231 4.17909 7.38173 4 7.61538 4C7.84904 4 8.03846 4.17909 8.03846 4.4Z" fill="currentColor"/>
                                                                </svg>
                                                            </span>
                                                            
                                                            <p>{{ __('Remove from History')}}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr class="border-b dark:border-[#474746]">
                                    <td colspan="5" class="w-full">
                                        <p class="text-center font-Figtree text-16 font-medium text-color-14 py-5 dark:text-white">{{ __('No image is available to be displayed.') }}</p>
                                    </td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal index-modal absolute z-[9999999] top-0 left-0 right-0 w-full h-full">
            <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
            </div>
            <div class="modal-wrapper  modal-wrapper modal-transition fixed inset-0 z-10">
                <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                    <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                        <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                           {{ __('Are you sure you want to delete this Image?') }}</p>
                        <div class="flex justify-center items-center mt-7 gap-[16px]">
                            <a href="javascript: void(0)"
                                class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                                {{ __('Cancel') }}</a>
                            <a href="javascript: void(0)"
                                class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-image"
                                >
                                {{ __('Yes, Delete') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $images->onEachSide(1)->links('site.layout.partials.pagination') }}
    </div>
</div>

{{-- image-details --}}
    <div class="fixed z-index-999999 hidden items-center inset-0 bg-color-14 bg-opacity-50 overflow-y-auto image-information-modal">
        <div class="m-auto md:mx-auto mx-5 overflow-hidden">
            <div class="relative my-5 z-index-999999 md:px-6 px-4 md:py-6 py-4 xl:w-[1092px] lg:w-[900px] md:w-[740px] w-full rounded-xl bg-white dark:bg-color-29 modal-h modal-box-shadow transition-all ease-in-out billing-modal-main" id="billing-modal-main">
                <svg class="absolute md:top-2.5 top-px md:right-2.5 right-px modal-close-btn p-[1px] cursor-pointer" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.00749 3.00773C3.41754 2.59768 4.08236 2.59768 4.49241 3.00773L8.99995 7.51527L13.5075 3.00773C13.9175 2.59768 14.5824 2.59768 14.9924 3.00773C15.4025 3.41778 15.4025 4.08261 14.9924 4.49266L10.4849 9.0002L14.9924 13.5077C15.4025 13.9178 15.4025 14.5826 14.9924 14.9927C14.5824 15.4027 13.9175 15.4027 13.5075 14.9927L8.99995 10.4851L4.49241 14.9927C4.08236 15.4027 3.41754 15.4027 3.00749 14.9927C2.59744 14.5826 2.59744 13.9178 3.00749 13.5077L7.51503 9.0002L3.00749 4.49266C2.59744 4.08261 2.59744 3.41778 3.00749 3.00773Z" fill="#898989"/>
                </svg>
                @include('openai::blades.images.image_view')
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        "use strict";
        const imageToggleFavoriteUrl = "{{ $imageToggleFavoriteUrl }}";
        const storagePath = "{{ objectStorage()->url('/') }}";
    </script>
    <script src="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/user/image-gallery.min.js') }}"></script>
@endsection
