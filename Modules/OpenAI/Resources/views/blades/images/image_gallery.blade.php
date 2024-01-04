@extends('layouts.user_master')
@section('page_title', __('Image Gallery'))

@section('css')
    <link rel="stylesheet" href="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.css') }}">
@endsection

@php
    $imageToggleFavoriteUrl = route('user.image.toggle.favorite');
@endphp

@section('content')
<div class="dark:bg-[#292929] bg-[#F6F3F2] overflow-auto gallery-scrollbar flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF h-screen">
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
        <div class="flex justify-between gap-6 lg:flex-row flex-col mt-[31px]">
            <div class="flex gap-3 justify-start image-gallery items-center flex-wrap">
                <a href="{{ route('user.imageList') }}" class="text-color-3A dark:text-color-89">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.33333 4.22222C5.03865 4.22222 4.75603 4.33929 4.54766 4.54766C4.33929 4.75603 4.22222 5.03865 4.22222 5.33333V7.55556C4.22222 7.85024 4.33929 8.13286 4.54766 8.34123C4.75603 8.5496 5.03865 8.66667 5.33333 8.66667H18.6667C18.9614 8.66667 19.244 8.5496 19.4523 8.34123C19.6607 8.13286 19.7778 7.85024 19.7778 7.55556V5.33333C19.7778 5.03865 19.6607 4.75603 19.4523 4.54766C19.244 4.33929 18.9614 4.22222 18.6667 4.22222H5.33333ZM2.97631 2.97631C3.60143 2.35119 4.44928 2 5.33333 2H18.6667C19.5507 2 20.3986 2.35119 21.0237 2.97631C21.6488 3.60143 22 4.44928 22 5.33333V7.55556C22 8.43961 21.6488 9.28746 21.0237 9.91258C20.3986 10.5377 19.5507 10.8889 18.6667 10.8889H5.33333C4.44928 10.8889 3.60143 10.5377 2.97631 9.91258C2.35119 9.28746 2 8.43961 2 7.55556V5.33333C2 4.44928 2.35119 3.60143 2.97631 2.97631ZM5.33333 15.3333C5.03865 15.3333 4.75603 15.4504 4.54766 15.6588C4.33929 15.8671 4.22222 16.1498 4.22222 16.4444V18.6667C4.22222 18.9614 4.33929 19.244 4.54766 19.4523C4.75603 19.6607 5.03865 19.7778 5.33333 19.7778H18.6667C18.9614 19.7778 19.244 19.6607 19.4523 19.4523C19.6607 19.244 19.7778 18.9614 19.7778 18.6667V16.4444C19.7778 16.1498 19.6607 15.8671 19.4523 15.6588C19.244 15.4504 18.9614 15.3333 18.6667 15.3333H5.33333ZM2.97631 14.0874C3.60143 13.4623 4.44928 13.1111 5.33333 13.1111H18.6667C19.5507 13.1111 20.3986 13.4623 21.0237 14.0874C21.6488 14.7125 22 15.5604 22 16.4444V18.6667C22 19.5507 21.6488 20.3986 21.0237 21.0237C20.3986 21.6488 19.5507 22 18.6667 22H5.33333C4.44928 22 3.60143 21.6488 2.97631 21.0237C2.35119 20.3986 2 19.5507 2 18.6667V16.4444C2 15.5604 2.35119 14.7125 2.97631 14.0874Z" fill="currentColor"/>
                    </svg>
                </a>
                <div class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white">
                    <select class="select block w-[140px] text-[14px] leading-[22px] font-normal text-color-2C bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none" onchange="filter(this)">
                        <option class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white" value="newest">{{ __('Newest') }}</option>
                        <option class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white" value="oldest">{{ __('Oldest') }}</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-8 items-center justify-between w-full md:w-max flex-wrap -mt-1 sm:mt-0 rtl:flex-ltr flex-row-reverse">
                <div class="flex gap-7">
                    <a class="flex justify-center items-center text-[15px] leading-[22px] font-normal text-color-14 dark:text-white gap-2" href="javascript: void(0)" id="favorite-image-filter" data-text="favourite">
                        <svg class="dark:text-white text-color-14" width="17" height="17" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.50784 12.9944C2.43976 13.3824 2.82264 13.6862 3.16077 13.5124L7.00134 11.5384L10.8419 13.5124C11.18 13.6862 11.5629 13.3824 11.4948 12.9944L10.7688 8.8561L13.8509 5.91904C14.1389 5.64456 13.9898 5.14269 13.6039 5.08788L9.31778 4.47899L7.40667 0.693267C7.23452 0.352244 6.76817 0.352244 6.59601 0.693267L4.68491 4.47899L0.398743 5.08788C0.0128776 5.14269 -0.136223 5.64456 0.151811 5.91904L3.23385 8.8561L2.50784 12.9944ZM6.79937 10.5723L3.57434 12.2299L4.18181 8.76724C4.21044 8.60402 4.1566 8.43687 4.0394 8.32519L1.49592 5.90135L5.04169 5.39764C5.18827 5.37682 5.31625 5.2832 5.3854 5.14623L7.00134 1.94519L8.61729 5.14623C8.68643 5.2832 8.81442 5.37682 8.961 5.39764L12.5068 5.90135L9.96328 8.32519C9.84609 8.43687 9.79224 8.60402 9.82088 8.76724L10.4284 12.2299L7.20332 10.5723C7.07592 10.5068 6.92676 10.5068 6.79937 10.5723Z" fill="currentColor"/>
                        </svg>
                        <p class="dark:text-white text-color-14 mt-1">{{ __('Favorites') }}</p>
                    </a>
                </div>
                <div class="gap-2.5 items-center hidden min-[1200px]:flex flex-row-reverse">
                    <p class="dark:text-white text-color-14 text-[15px] font-normal leading-[22px] font-Figtree">{{ __('Columns') }}</p>
                    <input class="range progress-bar w-full" id="progress-input" min="0" max="100" type="range" value="50" step="1"/>
                </div>
            </div>
        </div>
        <div class="mt-5 sm:mt-3 -mx-[18px] sm:mx-auto relative">
            <div class="gallery" id="gallery" data-next-page-url="{{ $images->nextPageUrl() }}">
                @foreach ($images as $image) 
                    <div class="gallery-item overflow-hidden md:rounded-lg rounded h-max {{ in_array($image->id, $userFavoriteImages) ? 'favorite' : 'non-favorite' }}" id="image_{{ $image->id }}">
                        <div class="img-content bg-white img-grow md:rounded-lg rounded relative download-gallery-image-container download-image-container">
                            <div class="tab-content-{{ $image->id }}">
                                <img class="img-responsive object-cover {{ checkResulation($image->size) }}" src="{{ $image->imageUrl(['thumbnill' => true, 'size' => 'medium']) }}">
                                <div class="gallery-image-hover-overlay image-modal-button" data-name="{{ $image->name }}" data-promt="{{ $image->promt }}" data-id="{{ $image->id }}" data-style="{{ $image->art_style }}" data-resulation="{{ $image->size }}" data-created="{{ $image->created_at }}" data-lightstyle="{{ $image->lighting_style }}" data-is-favorite="{{ in_array($image->id, $userFavoriteImages) ? 'true' : 'false' }}" data-source="{{ $image->imageUrl(['thumbnill' => true, 'size' => 'medium']) }}" id={{ $image->id }} data-slug="{{ $image->slug }}"></div>
                                <div class="absolute top-0">
                                    <div class="image-download-button  mt-3 ltr:md:ml-3 ltr:ml-1  rtl:md:mr-3 rtl:mr-1 bg-color-14">
                                        <a href="javascript: void(0)" class="relative md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg delete-image-bg border border-color-47 modal-toggle image-tooltip-delete gallery-dlt" id="{{ $image->id }}">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 1.25C5 0.835786 5.33579 0.5 5.75 0.5H10.25C10.6642 0.5 11 0.835786 11 1.25C11 1.66421 10.6642 2 10.25 2H5.75C5.33579 2 5 1.66421 5 1.25ZM2.74418 2.75H1.25C0.835786 2.75 0.5 3.08579 0.5 3.5C0.5 3.91421 0.835786 4.25 1.25 4.25H2.04834L2.52961 11.4691C2.56737 12.0357 2.59862 12.5045 2.65465 12.8862C2.71299 13.2835 2.80554 13.6466 2.99832 13.985C3.29842 14.5118 3.75109 14.9353 4.29667 15.1997C4.64714 15.3695 5.0156 15.4377 5.41594 15.4695C5.80046 15.5 6.27037 15.5 6.8382 15.5H9.1618C9.72963 15.5 10.1995 15.5 10.5841 15.4695C10.9844 15.4377 11.3529 15.3695 11.7033 15.1997C12.2489 14.9353 12.7016 14.5118 13.0017 13.985C13.1945 13.6466 13.287 13.2835 13.3453 12.8862C13.4014 12.5045 13.4326 12.0356 13.4704 11.469L13.9517 4.25H14.75C15.1642 4.25 15.5 3.91421 15.5 3.5C15.5 3.08579 15.1642 2.75 14.75 2.75H13.2558C13.2514 2.74996 13.2471 2.74996 13.2427 2.75H2.75731C2.75294 2.74996 2.74857 2.74996 2.74418 2.75ZM12.4483 4.25H3.55166L4.0243 11.3396C4.06455 11.9433 4.09238 12.3525 4.13874 12.6683C4.18377 12.9749 4.23878 13.1321 4.30166 13.2425C4.45171 13.5059 4.67804 13.7176 4.95083 13.8498C5.06513 13.9052 5.22564 13.9497 5.53464 13.9742C5.85277 13.9995 6.26289 14 6.86799 14H9.13201C9.73711 14 10.1472 13.9995 10.4654 13.9742C10.7744 13.9497 10.9349 13.9052 11.0492 13.8498C11.322 13.7176 11.5483 13.5059 11.6983 13.2425C11.7612 13.1321 11.8162 12.9749 11.8613 12.6683C11.9076 12.3525 11.9354 11.9433 11.9757 11.3396L12.4483 4.25ZM6.5 6.125C6.91421 6.125 7.25 6.46079 7.25 6.875V10.625C7.25 11.0392 6.91421 11.375 6.5 11.375C6.08579 11.375 5.75 11.0392 5.75 10.625V6.875C5.75 6.46079 6.08579 6.125 6.5 6.125ZM9.5 6.125C9.91421 6.125 10.25 6.46079 10.25 6.875V10.625C10.25 11.0392 9.91421 11.375 9.5 11.375C9.08579 11.375 8.75 11.0392 8.75 10.625V6.875C8.75 6.46079 9.08579 6.125 9.5 6.125Z" fill="white"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="absolute top-0 ltr:right-0 rtl:left-0">
                                    <div class="flex justify-end items-center gap-2 mt-3 ltr:md:mr-3 ltr:mr-1 rtl:md:ml-3 rtl:ml-1">
                                        <div class="image-download-button delete-image-bg">
                                            <a class="file-need-download relative md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg border border-color-47 image-tooltip-download" href="{{ $image->imageUrl() }}" download="{{ $image->name }}">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z" fill="#F3F3F3"/>
                                                </svg>   
                                            </a>
                                        </div>
                                        <div class="image-download-button modal-not-open delete-image-bg">
                                            <a href="javascript: void(0)" class="favorite-image-{{ $image->id }}" onclick="imageToggle(this)" data-image-id="{{ $image->id }}" data-is-favorite="{{ in_array($image->id, $userFavoriteImages) ? 'true' : 'false' }}">
                                                @if ( in_array($image->id, $userFavoriteImages) )
                                                    <div class="relative tooltips md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg bg-white wishlist-border">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 4.5L6.5 3L3.5 4L2.5 6V8.5L9 15L9.5 14.5L12 11.5L14.5 9.5L15.5 7.5L14.5 4.5L11.5 3L9 4.5Z" fill="#E22861"/>
                                                            <path d="M9.00077 3.39692C9.85769 2.62982 10.9759 2.22007 12.1256 2.25187C13.2752 2.28368 14.3691 2.75462 15.1823 3.56792C15.9948 4.38031 16.4658 5.47273 16.4987 6.62123C16.5316 7.76974 16.1239 8.88733 15.3593 9.74492L8.99927 16.1139L2.64077 9.74492C1.87521 8.88689 1.46717 7.76834 1.50042 6.61891C1.53367 5.46948 2.00569 4.37638 2.81956 3.56404C3.63344 2.7517 4.72742 2.28175 5.87691 2.25067C7.02641 2.21959 8.14419 2.62974 9.00077 3.39692ZM14.1203 4.62767C13.5785 4.08626 12.85 3.77273 12.0843 3.75139C11.3187 3.73005 10.5739 4.00253 10.0028 4.51292L9.00152 5.41142L7.99952 4.51367C7.43077 4.00509 6.68961 3.73232 5.92687 3.75086C5.16412 3.7694 4.43709 4.07787 3.89373 4.61349C3.35037 5.14911 3.03151 5.87163 3.00202 6.63404C2.97254 7.39644 3.23465 8.14143 3.73502 8.71742L9.00002 13.9907L14.265 8.71817C14.7633 8.14472 15.0254 7.4036 14.9986 6.6444C14.9717 5.8852 14.6578 5.16446 14.1203 4.62767Z" fill="#E22861"/>
                                                        </svg> 
                                                    </div>
                                                @else
                                                    <div class="relative tooltips md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg border border-color-47">
                                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.00077 1.39692C8.85769 0.629819 9.97588 0.220071 11.1256 0.251875C12.2752 0.283678 13.3691 0.754618 14.1823 1.56792C14.9948 2.38031 15.4658 3.47273 15.4987 4.62123C15.5316 5.76974 15.1239 6.88733 14.3593 7.74492L7.99927 14.1139L1.64077 7.74492C0.875208 6.88689 0.467169 5.76834 0.500419 4.61891C0.533668 3.46948 1.00568 2.37638 1.81956 1.56404C2.63344 0.751699 3.72742 0.281748 4.87691 0.250669C6.02641 0.21959 7.14418 0.629741 8.00077 1.39692ZM13.1203 2.62767C12.5785 2.08626 11.85 1.77273 11.0843 1.75139C10.3187 1.73005 9.57389 2.00253 9.00277 2.51292L8.00152 3.41142L6.99952 2.51367C6.43077 2.00509 5.68961 1.73232 4.92687 1.75086C4.16412 1.7694 3.43709 2.07787 2.89373 2.61349C2.35037 3.14911 2.03151 3.87163 2.00202 4.63404C1.97254 5.39644 2.23465 6.14143 2.73502 6.71742L8.00002 11.9907L13.265 6.71817C13.7633 6.14472 14.0254 5.4036 13.9986 4.6444C13.9717 3.8852 13.6578 3.16446 13.1203 2.62767Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="image-download-button absolute bottom-3 bg-transparent hidden md:block">
                                    <p class="mx-2.5 line-clamp-double text-white text-base font-medium font-Figtree leading-6 wrap-anywhere">{{ $image->promt}}
                                    </p>
                                </div>
                            </div>
                            <div class="spinner favorite-template-loader"></div>
                        </div>
                    </div>
                @endforeach
            </div>
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

    {{-- delete modal --}}
    <div class="modal index-modal absolute z-[9999999999] top-0 left-0 right-0 w-full h-full">
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
                            class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-image">
                            {{ __('Yes, Delete') }} </a>
                    </div>
                </div>
            </div>
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
