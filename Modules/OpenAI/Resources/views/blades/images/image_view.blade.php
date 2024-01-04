<div class="image-container">
    <div class="placeholder-loader gallery-placeholder placeholder-loader-animation">
        <div class="w-full">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mr-1  p-2 rounded-md">
                <div class="w-full">
                    <div data-placeholder class="mb-2 xl:!w-[512px] xl:!h-[512px] !h-[354px] overflow-hidden relative bg-gray-200 dark:bg-color-33">
                    </div>
                    <div data-placeholder class="mb-2 h-16 xl:w-[512px] overflow-hidden relative bg-gray-200 dark:bg-color-33">
                    </div>
                </div>
                <div class="w-full">
                    <div data-placeholder class="h-10 mb-2 relative bg-gray-200 dark:bg-color-33">
                    </div>
                    <div data-placeholder class="h-24 mb-2 relative bg-gray-200 dark:bg-color-33">
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-5">
                        <div data-placeholder class="h-10 sm:h-[46px] w-full mb-2 relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 sm:h-[46px] w-full mb-2 relative bg-gray-200 dark:bg-color-33"></div>
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-5">
                        <div data-placeholder class="h-10 sm:h-[46px] w-full mb-2 relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 sm:h-[46px] w-full mb-2 relative bg-gray-200 dark:bg-color-33"></div>
                    </div>
                    <div class="mt-6 sm:mt-7 flex flex-wrap sm:gap-3 gap-2.5">
                        <div data-placeholder class="h-10 w-[152px] relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 w-40 relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 w-[152px] relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 w-[152px] relative bg-gray-200 dark:bg-color-33"></div>
                        <div data-placeholder class="h-10 w-[152px] relative bg-gray-200 dark:bg-color-33"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="image-modal-container">
        <div>
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6 ltr:md:mr-1 rtl:md:ml-1">
                <div>
                {{-- main image --}}
                    <div class="swiper gallery-slider2 rtl:!overflow-visible">
                        <div class="main-image-varient swiper-wrapper xl:!w-[512px] xl:!h-[512px] !h-[354px]">
                                <div class="swiper-slide rounded-lg w-full h-full relative">
                                    <img class="rounded-lg w-full h-full object-cover main-image" src="" />
                                    <div class="absolute top-3 right-3 z-10 flex gap-2">
                                        <a href="" download="" class="file-need-download relative md:w-[34px] md:h-[34px] w-7 h-7 flex items-center m-auto justify-center rounded-lg delete-image-bg border border-color-47">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z" fill="#F3F3F3"/>
                                            </svg>   
                                        </a>
                                        <a href="javascript: void(0)" class="favorite-modal favorite-modal-image-" onclick="modalImageToggle(this)" data-image-id="" data-is-favorite="">
                                                
                                        </a>
                                    </div>
                                </div>
                        </div>
                    </div>
                {{-- main image --}} 
                {{-- varient image --}} 
                    <div class="swiper gallery-slider mt-4 cursor-grab">
                        <div class="swiper-wrapper -ml-3 justify-center varient-image">
                              
                        </div>
                    </div>
                {{-- varient image --}}    
                </div>
                {{-- curent image --}}  
                    <div>
                        <p class="text-color-14 dark:text-white font-bold text-[26px] leading-[34px] font-RedHat break-words line-clamp-triple image-title"> {{ __('demo image') }}</p>
                        <div class="flex justify-between items-center mt-5">
                            <p class="text-color-89 text-base leading-6 font-Figtree font-semibold"> {{ __('Prompt') }}</p>
                            <button onclick="copyToClipboard(this, '#image-des')" data-feedback="Copied" class="text-color-14 dark:text-white text-14 font-bold">
                                <span class="copy-data">
                                    <svg class="text-color-29 dark:text-color-F3" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8188_5495)">
                                        <path d="M12 0.75H3C2.175 0.75 1.5 1.425 1.5 2.25V12.75H3V2.25H12V0.75ZM14.25 3.75H6C5.175 3.75 4.5 4.425 4.5 5.25V15.75C4.5 16.575 5.175 17.25 6 17.25H14.25C15.075 17.25 15.75 16.575 15.75 15.75V5.25C15.75 4.425 15.075 3.75 14.25 3.75ZM14.25 15.75H6V5.25H14.25V15.75Z" fill="currentColor"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_8188_5495">
                                        <rect width="18" height="18" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="mt-2 bg-color-F6 dark:bg-color-3A rounded-xl p-3">
                            <p id="image-des" class="font-Figtree text-[15px] text-color-29 dark:text-color-F3 font-medium leading-[22px] break-words image-promt"></p>
                        </div>
                        <div class="mt-5 grid grid-cols-2 gap-5">
                            <div>
                                <p class="font-Figtree text-14 font-sm text-color-89 font-medium">{{ __('Style')}}</p>
                                <p class="font-Figtree leading-6 font-base text-color-14 dark:text-white font-semibold break-words line-clamp-double image-style"></p>
                            </div>
                            <div>
                                <p class="font-Figtree text-14 font-sm text-color-89 font-medium">{{ __('Lighting Effects')}}</p>
                                <p class="font-Figtree leading-6 font-base text-color-14 dark:text-white font-semibold break-words line-clamp-double lighting-style"></p>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-5"> 
                            <div>
                                <p class="font-Figtree text-14 font-sm text-color-89 font-medium">{{ __('Resolution')}}</p>
                                <p class="font-Figtree leading-6 font-base text-color-14 dark:text-white font-semibold break-words line-clamp-double image-resulation"></p>
                            </div>
                            <div>
                                <p class="font-Figtree text-14 font-sm text-color-89 font-medium">{{ __('Created On')}}</p>
                                <p class="font-Figtree leading-6 font-base text-color-14 dark:text-white font-semibold break-words line-clamp-double image-created"></p>
                            </div>
                        </div>
                        <div class="mt-6 md:mt-7 flex flex-wrap gap-3">
                            <button class="flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-14 down-img-btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z" fill="#F3F3F3"/>
                                </svg>
                                <span class="wrap-anywhere text-white text-14 font-Figtree font-medium" onclick="downloadAll()">{{ __('Download All')}}</span>
                            </button>
                            <a href="javascript: void(0)" class="varient-url flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-F6 dark:bg-color-3A border border-color-89 dark:border-color-47 text-color-14 dark:text-white">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 12.75H15M15 12.75L12 9.75M15 12.75L12 15.75M15 5.25H3M3 5.25L6 2.25M3 5.25L6 8.25" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="wrap-anywhere text-14 font-Figtree font-medium">{{ __('Make Variations')}}</span>
                            </a>
                            <button class="share-information flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-F6 dark:bg-color-3A border border-color-89 dark:border-color-47 text-color-14 dark:text-white" data-image-url="" >
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.1251 1.875C12.7806 1.87487 12.4407 1.95381 12.1316 2.10576C11.8225 2.25771 11.5524 2.4786 11.3421 2.75141C11.1318 3.02422 10.987 3.34167 10.9188 3.67929C10.8505 4.01691 10.8607 4.36569 10.9486 4.69875C10.8942 4.71023 10.8419 4.72969 10.7933 4.7565L8.72555 5.88375L6.09605 7.3875C6.06973 7.40247 6.04465 7.41952 6.02105 7.4385C5.65524 7.22216 5.23563 7.11386 4.81081 7.12612C4.38599 7.13838 3.97333 7.27071 3.62061 7.50779C3.26788 7.74487 2.98951 8.077 2.81773 8.46573C2.64594 8.85446 2.58777 9.2839 2.64994 9.70432C2.71211 10.1247 2.89208 10.519 3.16902 10.8413C3.44596 11.1637 3.80854 11.4011 4.21479 11.5259C4.62103 11.6508 5.05433 11.658 5.46452 11.5468C5.87471 11.4356 6.24501 11.2105 6.53255 10.8975L8.72705 12.1178L10.9426 13.326C10.8084 13.857 10.8726 14.4186 11.1229 14.9057C11.3733 15.3928 11.7927 15.7718 12.3026 15.9717C12.8124 16.1717 13.3777 16.1788 13.8924 15.9918C14.4071 15.8048 14.836 15.4364 15.0986 14.9558C15.3611 14.4752 15.4394 13.9154 15.3187 13.3812C15.198 12.847 14.8866 12.3752 14.443 12.0542C13.9993 11.7331 13.4537 11.5849 12.9086 11.6374C12.3635 11.6898 11.8562 11.9393 11.4818 12.339L9.27155 11.133L7.06205 9.906C7.19649 9.34903 7.1139 8.76178 6.83105 8.2635L9.27455 6.867L11.3318 5.74425C11.3807 5.71775 11.4255 5.68413 11.4646 5.6445C11.7172 5.92044 12.0347 6.12902 12.3883 6.25135C12.7419 6.37368 13.1204 6.40589 13.4896 6.34509C13.8588 6.28428 14.207 6.13237 14.5027 5.9031C14.7984 5.67383 15.0322 5.37445 15.183 5.03204C15.3339 4.68963 15.3969 4.31502 15.3665 3.9421C15.3361 3.56919 15.2132 3.20974 15.0088 2.8963C14.8045 2.58286 14.5253 2.32532 14.1963 2.147C13.8674 1.96867 13.4992 1.87518 13.1251 1.875Z" fill="currentColor"/>
                                </svg>
                                <span class="wrap-anywhere text-14 font-Figtree font-medium">{{ __('Share')}}</span>
                            </button>
                           
                            <a href="javascript:void(0)" class="flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-F6 dark:bg-color-3A border border-color-89 dark:border-color-47 text-color-14 dark:text-white modal-toggle modal-image-delete" id="">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2.25C6 1.83579 6.33579 1.5 6.75 1.5H11.25C11.6642 1.5 12 1.83579 12 2.25C12 2.66421 11.6642 3 11.25 3H6.75C6.33579 3 6 2.66421 6 2.25ZM3.74418 3.75H2.25C1.83579 3.75 1.5 4.08579 1.5 4.5C1.5 4.91421 1.83579 5.25 2.25 5.25H3.04834L3.52961 12.4691C3.56737 13.0357 3.59862 13.5045 3.65465 13.8862C3.71299 14.2835 3.80554 14.6466 3.99832 14.985C4.29842 15.5118 4.75109 15.9353 5.29667 16.1997C5.64714 16.3695 6.0156 16.4377 6.41594 16.4695C6.80046 16.5 7.27037 16.5 7.8382 16.5H10.1618C10.7296 16.5 11.1995 16.5 11.5841 16.4695C11.9844 16.4377 12.3529 16.3695 12.7033 16.1997C13.2489 15.9353 13.7016 15.5118 14.0017 14.985C14.1945 14.6466 14.287 14.2835 14.3453 13.8862C14.4014 13.5045 14.4326 13.0356 14.4704 12.469L14.9517 5.25H15.75C16.1642 5.25 16.5 4.91421 16.5 4.5C16.5 4.08579 16.1642 3.75 15.75 3.75H14.2558C14.2514 3.74996 14.2471 3.74996 14.2427 3.75H3.75731C3.75294 3.74996 3.74857 3.74996 3.74418 3.75ZM13.4483 5.25H4.55166L5.0243 12.3396C5.06455 12.9433 5.09238 13.3525 5.13874 13.6683C5.18377 13.9749 5.23878 14.1321 5.30166 14.2425C5.45171 14.5059 5.67804 14.7176 5.95083 14.8498C6.06513 14.9052 6.22564 14.9497 6.53464 14.9742C6.85277 14.9995 7.26289 15 7.86799 15H10.132C10.7371 15 11.1472 14.9995 11.4654 14.9742C11.7744 14.9497 11.9349 14.9052 12.0492 14.8498C12.322 14.7176 12.5483 14.5059 12.6983 14.2425C12.7612 14.1321 12.8162 13.9749 12.8613 13.6683C12.9076 13.3525 12.9354 12.9433 12.9757 12.3396L13.4483 5.25ZM7.5 7.125C7.91421 7.125 8.25 7.46079 8.25 7.875V11.625C8.25 12.0392 7.91421 12.375 7.5 12.375C7.08579 12.375 6.75 12.0392 6.75 11.625V7.875C6.75 7.46079 7.08579 7.125 7.5 7.125ZM10.5 7.125C10.9142 7.125 11.25 7.46079 11.25 7.875V11.625C11.25 12.0392 10.9142 12.375 10.5 12.375C10.0858 12.375 9.75 12.0392 9.75 11.625V7.875C9.75 7.46079 10.0858 7.125 10.5 7.125Z" fill="currentColor"/>
                                </svg>                                            
                                <span class="wrap-anywhere text-14 font-Figtree font-medium">{{ __('Delete')}}</span>
                            </a>
                        </div>
                    </div>
                {{-- curent image --}} 
            </div>
            {{-- releted image --}}
                <div class="releted-image-body mt-[26px] sm:mt-[30px]">
                    <p class="text-color-14 text-18 dark:text-white font-Figtree font-semibold">{{ __('Related Images')}}</p>
                    <div class="flex flex-wrap gap-2 sm:gap-3 mt-5 sm:mt-3 justify-center xs:justify-start releted-image">
                          
                    </div>
                </div>
            {{-- releted image --}}
        </div>
    </div>
</div>
 {{-- share modal --}}
    <div class="fixed z-index-999999 hidden items-center inset-0 bg-color-14 bg-opacity-50 overflow-y-auto share-information-modal">
        <div class="xxs:m-auto mx-5">
            <div class="relative my-5 z-index-999999 md:px-6 px-3 py-5 sm:w-[388px] xs:w-[350px] w-[320px] rounded-xl bg-white dark:bg-color-29 modal-h modal-box-shadow transition-all ease-in-out billing-modal-main" id="billing-modal-main">
                <svg class="absolute top-2.5 right-2.5 share-modal-close-btn p-[1px] cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.00749 3.00773C3.41754 2.59768 4.08236 2.59768 4.49241 3.00773L8.99995 7.51527L13.5075 3.00773C13.9175 2.59768 14.5824 2.59768 14.9924 3.00773C15.4025 3.41778 15.4025 4.08261 14.9924 4.49266L10.4849 9.0002L14.9924 13.5077C15.4025 13.9178 15.4025 14.5826 14.9924 14.9927C14.5824 15.4027 13.9175 15.4027 13.5075 14.9927L8.99995 10.4851L4.49241 14.9927C4.08236 15.4027 3.41754 15.4027 3.00749 14.9927C2.59744 14.5826 2.59744 13.9178 3.00749 13.5077L7.51503 9.0002L3.00749 4.49266C2.59744 4.08261 2.59744 3.41778 3.00749 3.00773Z" fill="#898989"/>
                </svg>
                <div class="Image-modal-container">
                    <p class="font-RedHat text-color-14 dark:text-white text-18 leading-7 font-bold pb-5 text-center">{{ __("Share Your Work") }}</p>
                    <div>
                        <img class="w-[192px] h-[192px] object-cover rounded-lg mx-auto share-image" src="">
                    </div>
                    @php
                        $social = option('default_template_social', '');
                    @endphp
                    @if ($social['facebook'] || $social['whatsapp'] || $social['pinterest'] || $social['instagram'] || $social['linkedin'])
                        <div class="flex flex-wrap gap-4 mt-9 mx-[38px] justify-center items-center">
                            @if ($social['facebook'])
                                <a class="image-share-slug" href="https://www.facebook.com/sharer.php?u={{ urlencode(route('imageShare', ['slug' => '$currentImage->slug'])) }}">
                                    <img class="w-[38px] h-[38px] object-cover" src="{{ asset('public/assets/image/facebook.png') }}" alt="{{ __('Facebook') }}">
                                </a>
                            @endif
                            @if ($social['linkedin'])
                                <a class="image-share-slug" href="http://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('imageShare', ['slug' => '$currentImage->slug'])) }}"> 
                                    <img class="w-[38px] h-[38px] object-cover" src="{{ asset('public/assets/image/linkedin.png') }}" alt="{{ __('Linkedin') }}">
                                </a>
                            @endif
                            @if ($social['instagram'])
                                <a class="image-share-slug" href="https://www.instagram.com/sharer.php?u={{ urlencode(route('imageShare', ['slug' => '$currentImage->slug'])) }}">
                                    <img class="w-[38px] h-[38px] object-cover" src="{{ asset('public/assets/image/instagram.png') }}" alt="{{ __('Instagram') }}">
                                </a>
                            @endif
                            @if ($social['whatsapp'])
                                <a class="image-share-slug" href="https://api.whatsapp.com/send?text={{ urlencode(route('imageShare', ['slug' => '$currentImage->slug'])) }}">
                                    <img class="w-[38px] h-[38px] object-cover" src="{{ asset('public/assets/image/whatsapp.png') }}" alt="{{ __('Whatsapp') }}">
                                </a>
                            @endif
                            @if ($social['pinterest'])
                                <a class="image-share-slug" href="http://pinterest.com/pin/create/button/?url={{ urlencode(route('imageShare', ['slug' => '$currentImage->slug'])) }}">
                                    <img class="w-[38px] h-[38px] object-cover" src="{{ asset('public/assets/image/pinterest.png') }}" alt="{{ __('Pinterest') }}">
                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="mt-9">
                        <p class="font-Figtree text-color-89 text-[15px] font-medium leading-[22px] text-center">{{ __('or copy link') }}</p>
                        <div class="flex mt-3">
                            <input type="text" class="image-share-text-box text-color-14 dark:text-white border focus:!border-color-DF dark:focus:!border-color-47 border-color-DF dark:border-color-47 ltr:border-r-0 rtl:border-l-0 bg-color-F6 dark:bg-color-3A p-[13px] font-Figtree font-normal text-14 rounded-xl ltr:rounded-r-none rtl:rounded-l-none w-full" value="{{ route('imageShare', ['slug' => '$currentImage->slug']) }}">
                            <button class="copy-btn text-color-14 dark:text-white border border-color-DF dark:border-color-47 ltr:border-l-0 rtl:border-r-o bg-color-F6 dark:bg-color-3A p-[13px] font-Figtree font-bold text-14 rounded-xl ltr:rounded-l-none rtl:rounded-r-none" data-feedback="Copied"><span class="copy-link text-[#292929] dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_9881_5163)">
                                <path d="M12 0.75H3C2.175 0.75 1.5 1.425 1.5 2.25V12.75H3V2.25H12V0.75ZM14.25 3.75H6C5.175 3.75 4.5 4.425 4.5 5.25V15.75C4.5 16.575 5.175 17.25 6 17.25H14.25C15.075 17.25 15.75 16.575 15.75 15.75V5.25C15.75 4.425 15.075 3.75 14.25 3.75ZM14.25 15.75H6V5.25H14.25V15.75Z" fill="currentColor"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_9881_5163">
                                    <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
