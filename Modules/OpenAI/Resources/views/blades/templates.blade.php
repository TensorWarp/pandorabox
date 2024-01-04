@extends('layouts.user_master')
@section('page_title', __('Templates'))
@php
    $useCaseSearchUrl = route('user.use_case.search');
    $useCaseToggleFavoriteUrl = route('user.use_case.toggle.favorite');
@endphp

@section('content')
    {{-- main content --}}
    <div class="w-[68.9%] relative 5xl:w-[85.9%] pt-[88px] px-6 5xl:px-[67px] 9xl:pb-8 pb-24 overflow-auto main-content flex flex-col flex-1 font-Figtree bg-color-F6 dark:bg-[#292929] border-l dark:border-[#474746] border-color-DF h-screen">
            <p class="tracking-[0.2em] uppercase text-color-89 font-bold text-sm"> {{ __('Template Category') }} </p>
            <div class="mt-3 xl:mt-2.5 xl:flex justify-between items-center">
                <p class="text-color-14 dark:text-white text-2xl leading-8 font-semibold">{{ __('Pre-built Templates to get you started fast.') }}</p>
                <div class="flex gap-7 mt-5 xl:mt-0">
                    <a class="flex justify-center items-center text-15 font-normal text-color-14 dark:text-white gap-2" href="javascript: void(0)" id="favorites_filter" data-textval="favorated">
                        <svg class="dark:text-white text-color-14" width="17" height="17" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.50784 12.9944C2.43976 13.3824 2.82264 13.6862 3.16077 13.5124L7.00134 11.5384L10.8419 13.5124C11.18 13.6862 11.5629 13.3824 11.4948 12.9944L10.7688 8.8561L13.8509 5.91904C14.1389 5.64456 13.9898 5.14269 13.6039 5.08788L9.31778 4.47899L7.40667 0.693267C7.23452 0.352244 6.76817 0.352244 6.59601 0.693267L4.68491 4.47899L0.398743 5.08788C0.0128776 5.14269 -0.136223 5.64456 0.151811 5.91904L3.23385 8.8561L2.50784 12.9944ZM6.79937 10.5723L3.57434 12.2299L4.18181 8.76724C4.21044 8.60402 4.1566 8.43687 4.0394 8.32519L1.49592 5.90135L5.04169 5.39764C5.18827 5.37682 5.31625 5.2832 5.3854 5.14623L7.00134 1.94519L8.61729 5.14623C8.68643 5.2832 8.81442 5.37682 8.961 5.39764L12.5068 5.90135L9.96328 8.32519C9.84609 8.43687 9.79224 8.60402 9.82088 8.76724L10.4284 12.2299L7.20332 10.5723C7.07592 10.5068 6.92676 10.5068 6.79937 10.5723Z" fill="currentColor"/>
                        </svg>

                        <p class="dark:text-white text-color-14 font-semibold mt-1">{{ __('Favorites') }}</p>
                    </a>
                </div>
            </div>
            <div class="mt-6 xl:mt-7">
                <div class="xl:flex justify-between items-center w-full gap-5">
                    <div
                        class="xl:w-[65.3%] flex items-center border border-color-DF dark:border-[#474746] rounded-xl bg-white dark:bg-[#474746] relative overflow-hidden nav-scroller-wrapper">
                        <div class="nav-scroller relative overflow-x-auto scroll-hide overflow-y-hidden whitespace-nowrap">
                            <ul class="nav nav-tabs flex justify-around float-left px-1.5 items-center whitespace-nowrap flex-row list-none py-1.5 nav-scroller-content relative w-min min-w-full">
                                <li class="nav-item nav-scroller-item" role="presentation">
                                    <a href="#tabs-home"class="nav-link rounded-lg block font-normal text-color-14 dark:text-white text-15 px-6 py-[7px] active" id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" data-category-id="0" role="tab" aria-controls="tabs-home" aria-selected="true">
                                        {{ __("All") }}
                                    </a>
                                </li>
                                @foreach($useCaseCategories as $category)
                                <li class="nav-item nav-scroller-item" role="presentation">
                                    <a href="#tabs-category-tab-id-{{ $category->id }}" class="nav-link rounded-lg block font-normal text-color-14 dark:text-white text-15 px-6 py-[7px]" id="tabs-category-id-{{ $category->id }}" data-bs-toggle="pill" data-bs-target="#tabs-category-tab-id-{{ $category->id }}" data-category-id="{{ $category->id }}" role="tab" aria-controls="tabs-category-tab-id-{{ $category->id }}" aria-selected="false">
                                        {{trimWords($category->name,40)}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <button
                            class="nav-scroller-btn nav-scroller-btn--left bg-white dark:bg-[#474746] px-1.5 absolute top-0 bottom-0 left-0;">
                            <svg class="text-color-89 dark:text-white neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                fill="none">
                                <g clip-path="url(#clip0_360_1562)">
                                    <path
                                        d="M8.25 8.78063L5.46862 5.625L8.25 2.46937L7.39372 1.5L3.75 5.625L7.39372 9.75L8.25 8.78063Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_360_1562">
                                        <rect width="12" height="12" fill="white"
                                            transform="matrix(-1 0 0 1 12 0)" />
                                    </clipPath>
                                </defs>
                            </svg></button>

                        <button
                            class="nav-scroller-btn nav-scroller-btn--right bg-white dark:bg-[#474746] px-1.5 absolute top-0 bottom-0 right-0"><svg class="text-color-89 dark:text-white neg-transition-scale"
                                xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                fill="none">
                                <g clip-path="url(#clip0_360_1559)">
                                    <path
                                        d="M3.75 8.78063L6.53138 5.625L3.75 2.46937L4.60628 1.5L8.25 5.625L4.60628 9.75L3.75 8.78063Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_360_1559">
                                        <rect width="12" height="12" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg></button>

                    </div>
                    <div class="xl:w-[36.7%] mt-4 xl:mt-0">
                        <div class="flex justify-end">
                            <button class="search-btn text-[#141414] dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <g clip-path="url(#clip0_351_1296)">
                                        <path d="M18.641 17.5848L14.2471 13.0149C15.3768 11.6719 15.9958 9.98217 15.9958 8.22307C15.9958 4.11308 12.652 0.769226 8.54197 0.769226C4.43199 0.769226 1.08813 4.11308 1.08813 8.22307C1.08813 12.333 4.43199 15.6769 8.54197 15.6769C10.0849 15.6769 11.5553 15.2115 12.8124 14.3281L17.2396 18.9326C17.4247 19.1248 17.6736 19.2308 17.9403 19.2308C18.1927 19.2308 18.4322 19.1345 18.6141 18.9595C19.0004 18.5878 19.0127 17.9714 18.641 17.5848ZM8.54197 2.71371C11.5799 2.71371 14.0513 5.18514 14.0513 8.22307C14.0513 11.261 11.5799 13.7324 8.54197 13.7324C5.50405 13.7324 3.03261 11.261 3.03261 8.22307C3.03261 5.18514 5.50405 2.71371 8.54197 2.71371Z" fill="currentColor" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_351_1296">
                                            <rect width="18.4615" height="18.4615" fill="white" transform="translate(0.769287 0.769226)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                            <input name="search_use_case" id="search-use-case-input" class="search-input w-full bg-white dark:bg-[#474746] py-[13px] text-color-14 dark:text-white rounded-xl text-15 font-normal ltr:pl-12 rtl:pr-12 ltr:pr-3 rtl:pl-3 border border-color-DF dark:border-color-47" type="text" placeholder="{{ __('Search templates') }}">
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-6 xl:mt-8" id="tabs-tabContent">
                    <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
                        <div class="grid 9xl:grid-cols-5 5xl:grid-cols-4 4xl:grid-cols-3 xs:grid-cols-2 grid-cols-1 gap-4 xl:gap-[23px] pb-8">
                        @foreach($useCases as $key => $useCase)
                            <div class="parent-template relative bg-white dark:bg-[#3A3A39] border-design-2 rounded-xl border border-color-DF dark:border-[#474746] {{ in_array($useCase->id, $userUseCaseFavorites) ? 'favorated' : 'non-favorite' }}">
                                <div class="tab-content-{{$useCase->id}}">
                                    <a href="{{ route('user.template', $useCase->slug) }}">
                                        <div class="p-4 xl:p-[30px] xl:pb-6">
                                            <img class="rounded-full w-12 h-12 neg-transition-scale" src="{{ asset($useCase->fileUrl()) }}" alt="{{ __('Image') }}">
                                            <p class="text-color-14 dark:text-white font-semibold text-18 mt-7 break-words line-clamp-double">
                                                {{ trimWords($useCase->name, 55) }}
                                            </p>
                                            <p class="text-13 xl:text-14 text-color-14 dark:text-color-DF font-light mt-2.5 break-words font-Figtree">{{ trimWords($useCase->description,85)}}</p>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0)" class="absolute top-0 right-0 p-4 toggle-favorite favorite-use-case-{{ $useCase->id }} " data-use-case-id="{{ $useCase->id }}" data-is-favorite="{{ in_array($useCase->id, $userUseCaseFavorites) ? 'true' : 'false' }}">
                                        <span class="flex items-center justify-center">
                                            @if (in_array($useCase->id, $userUseCaseFavorites))
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.06383 17.3731C3.62909 17.5965 3.13682 17.206 3.22435 16.7071L4.15779 11.3864L0.195168 7.6102C-0.175161 7.25729 0.0165395 6.61204 0.512652 6.54156L6.02344 5.7587L8.48057 0.891343C8.70191 0.452886 9.3015 0.452886 9.52285 0.891343L11.98 5.7587L17.4908 6.54156C17.9869 6.61204 18.1786 7.25729 17.8083 7.6102L13.8456 11.3864L14.7791 16.7071C14.8666 17.206 14.3743 17.5965 13.9396 17.3731L9.00171 14.8351L4.06383 17.3731Z" fill="url(#paint0_linear_301_431)"/>
                                                    <defs>
                                                    <linearGradient id="paint0_linear_301_431" x1="11.7048" y1="15.3605" x2="6.10185" y2="1.87361" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#E60C84"/>
                                                    <stop offset="1" stop-color="#FFCF4B"/>
                                                    </linearGradient>
                                                    </defs>
                                                </svg>
                                            @else
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.22435 16.7071C3.13682 17.206 3.62909 17.5965 4.06383 17.3731L9.00171 14.8351L13.9396 17.3731C14.3743 17.5965 14.8666 17.206 14.7791 16.7071L13.8456 11.3864L17.8083 7.6102C18.1786 7.25729 17.9869 6.61204 17.4908 6.54156L11.98 5.7587L9.52285 0.891343C9.3015 0.452886 8.70191 0.452886 8.48057 0.891343L6.02344 5.7587L0.512652 6.54156C0.0165395 6.61204 -0.175161 7.25729 0.195168 7.6102L4.15779 11.3864L3.22435 16.7071ZM8.74203 13.5929L4.59556 15.7241L5.37659 11.2722C5.41341 11.0623 5.34418 10.8474 5.1935 10.7038L1.92331 7.58745L6.48215 6.93983C6.67061 6.91305 6.83516 6.79269 6.92406 6.61658L9.00171 2.50096L11.0794 6.61658C11.1683 6.79269 11.3328 6.91305 11.5213 6.93983L16.0801 7.58745L12.8099 10.7038C12.6592 10.8474 12.59 11.0623 12.6268 11.2722L13.4079 15.7241L9.26139 13.5929C9.0976 13.5088 8.90582 13.5088 8.74203 13.5929Z" fill="#898989"/>
                                                </svg>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                                <div class="spinner favorite-template-loader"></div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    @foreach($useCaseCategories as $category)
                    <div class="tab-pane fade" id="tabs-category-tab-id-{{ $category->id }}" role="tabpanel" aria-labelledby="tabs-category-tab">
                        <div class="grid 9xl:grid-cols-5 5xl:grid-cols-4 4xl:grid-cols-3 xs:grid-cols-2 grid-cols-1 gap-4 xl:gap-[23px] pb-8 parent-class">
                            @foreach($category->useCases as $useCase)
                            <div class="parent-template relative bg-white dark:bg-[#3A3A39] border-design-2 rounded-xl border border-color-DF dark:border-[#474746] {{ in_array($useCase->id, $userUseCaseFavorites) ? 'favorated' : 'non-favorite' }}">
                                <div class="tab-content-{{$useCase->id}}">
                                    <a href="{{ route('user.template', $useCase->slug) }}">
                                        <div class="p-4 xl:p-[30px] xl:pb-6">
                                            <img class="rounded-full w-12 h-12 neg-transition-scale" src="{{ asset($useCase->fileUrl()) }}" alt="{{ __('Image') }}">
                                            <p class="text-color-14 dark:text-white font-semibold text-18 mt-7 break-words line-clamp-double">{{ trimWords($useCase->name, 55) }}</p>
                                            <p class="text-13 xl:text-14 text-color-14 dark:text-color-DF font-light mt-2.5 break-all">
                                                {{ trimWords($useCase->description,85)}}
                                            </p>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0)" class="absolute top-0 right-0 p-4 toggle-favorite favorite-use-case-{{ $useCase->id }}" data-use-case-id="{{ $useCase->id }}" data-is-favorite="{{ in_array($useCase->id, $userUseCaseFavorites) ? 'true' : 'false' }}">
                                        <span class="flex items-center justify-center">
                                            @if (in_array($useCase->id, $userUseCaseFavorites))
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.06383 17.3731C3.62909 17.5965 3.13682 17.206 3.22435 16.7071L4.15779 11.3864L0.195168 7.6102C-0.175161 7.25729 0.0165395 6.61204 0.512652 6.54156L6.02344 5.7587L8.48057 0.891343C8.70191 0.452886 9.3015 0.452886 9.52285 0.891343L11.98 5.7587L17.4908 6.54156C17.9869 6.61204 18.1786 7.25729 17.8083 7.6102L13.8456 11.3864L14.7791 16.7071C14.8666 17.206 14.3743 17.5965 13.9396 17.3731L9.00171 14.8351L4.06383 17.3731Z" fill="url(#paint0_linear_301_431-{{ $useCase->id }})"/>
                                                    <defs>
                                                    <linearGradient id="paint0_linear_301_431-{{ $useCase->id }}" x1="11.7048" y1="15.3605" x2="6.10185" y2="1.87361" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#E60C84"/>
                                                    <stop offset="1" stop-color="#FFCF4B"/>
                                                    </linearGradient>
                                                    </defs>
                                                </svg>
                                            @else
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.22435 16.7071C3.13682 17.206 3.62909 17.5965 4.06383 17.3731L9.00171 14.8351L13.9396 17.3731C14.3743 17.5965 14.8666 17.206 14.7791 16.7071L13.8456 11.3864L17.8083 7.6102C18.1786 7.25729 17.9869 6.61204 17.4908 6.54156L11.98 5.7587L9.52285 0.891343C9.3015 0.452886 8.70191 0.452886 8.48057 0.891343L6.02344 5.7587L0.512652 6.54156C0.0165395 6.61204 -0.175161 7.25729 0.195168 7.6102L4.15779 11.3864L3.22435 16.7071ZM8.74203 13.5929L4.59556 15.7241L5.37659 11.2722C5.41341 11.0623 5.34418 10.8474 5.1935 10.7038L1.92331 7.58745L6.48215 6.93983C6.67061 6.91305 6.83516 6.79269 6.92406 6.61658L9.00171 2.50096L11.0794 6.61658C11.1683 6.79269 11.3328 6.91305 11.5213 6.93983L16.0801 7.58745L12.8099 10.7038C12.6592 10.8474 12.59 11.0623 12.6268 11.2722L13.4079 15.7241L9.26139 13.5929C9.0976 13.5088 8.90582 13.5088 8.74203 13.5929Z" fill="#898989"/>
                                                </svg>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                                <div class="spinner favorite-template-loader"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <div class="tab-pane fade" id="tabs-search-results-tab" role="tabpanel" aria-labelledby="tabs-search-results-tab">

                    <div class="grid 9xl:grid-cols-5 5xl:grid-cols-4 4xl:grid-cols-3 xs:grid-cols-2 grid-cols-1 gap-4 xl:gap-[23px] pb-8">
                        @foreach($useCases as $useCase)
                        <div class="relative bg-white dark:bg-[#3A3A39] border-design-2 cursor-pointer rounded-xl border border-color-DF dark:border-[#474746] {{ in_array($useCase->id, $userUseCaseFavorites) ? 'favorated' : 'non-favorite' }}" id="{{ $useCase->id }}">
                            <div class="tab-content-{{$useCase->id}}">
                                <a href="{{ route('user.template', $useCase->slug) }}">
                                    <div class="p-4 xl:p-[30px] xl:pb-6">
                                        <img class="rounded-full w-12 h-12 neg-transition-scale" src="{{ asset($useCase->fileUrl()) }}" alt="{{ __('Image') }}">
                                        <p class="text-color-14 dark:text-white font-semibold text-18 mt-7 break-words line-clamp-double">
                                            {{ trimWords($useCase->name, 55) }}
                                        </p>
                                        <p class="text-13 xl:text-14 text-color-14 dark:text-color-DF font-light mt-2.5 break-words font-Figtree">
                                            {{ trimWords($useCase->description,85)}}
                                        </p>
                                    </div>
                                </a>
                                <a href="javascript: void(0)" class="absolute top-0 right-0 p-4 dynamic-use-case toggle-favorite favorite-use-case-{{ $useCase->id }}" data-use-case-id="{{ $useCase->id }}" data-is-favorite="{{ in_array($useCase->id, $userUseCaseFavorites) ? 'true' : 'false' }}">
                                    <span class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 51 48">
                                            <path fill="{{ in_array($useCase->id, $userUseCaseFavorites) ? '#ff994b' : '#ffffff' }}" stroke="#ff554b" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="spinner"></div>
                        </div>
                        @endforeach
                    </div>

                    </div>
                </div>

                <div class="template-loader mx-auto items-center dark:bg-color-29 hidden absolute left-0 right-0 xl:top-[51%] top-[70%]">
                    <svg class="animate-spin h-7 w-7 m-auto" xmlns="http://www.w3.org/2000/svg" width="72"
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
                    <p class="text-center text-color-14 dark:text-white text-16 font-normal font-Figtree mt-5">{{ __('Processing..')}}</p>
                </div>
            </div>
        </div>

        <div id="template_not_found" class="hidden">
            <div class="xl:flex justify-center align-items-center w-full template_not_found_child">
                <p class="text-color-14 dark:text-white text-center font-semibold text-18 mt-7">{{ __('No templates found under this category.') }}</p>
            </div>
        </div>
        {{-- end main content --}}
@endsection
@section('js')
    <script>
        "use strict";
        const useCaseSearchURL = "{{ $useCaseSearchUrl }}";
        const useCaseToggleFavoriteUrl = "{{ $useCaseToggleFavoriteUrl }}";
        var processing = "{{  __('Processing..') }}";
    </script>
    <script src="{{ asset('Modules/OpenAI/Resources/assets/js/customer/templates.min.js') }}"></script>
@endsection
