@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/site_custom.min.css') }}">
@endsection

@php
    $languages = App\Models\Language::get();
    $minuteLeft = 0;
    if ($userSubscription && in_array($userSubscription->status, ['Active', 'Cancel'])) {
        $minuteLeft = $featureLimit['minute']['remain'];
        $minuteLimit = $featureLimit['minute']['limit'];
    }
@endphp
<form id="speech-to-text-form" class="bg-[#F6F3F2] dark:bg-[#3A3A39] font-Figtree h-full flex flex-col justify-between">
    <div class="bg-[#F6F3F2] dark:bg-[#3A3A39] xl:w-[401px] 5xl:w-[474px] sidebar-scrollbar xl:overflow-auto h-full pt-14">
        <div class=" px-5 py-[22px] !pb-0 sm:py-8 xl:p-6 pt-5">
            <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere">{{ __('Any voice, we’ll write it down!') }}</p>
            <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mt-2 wrap-anywhere">
                {{ __('Artifism Works with any language and accent. Great for notes, messages, and more.') }}</p>
            @if($minuteLeft && auth()->user()->id == $userId)
                <div class="bg-white dark:bg-[#474746] p-3 rounded-xl flex items-center justify-start mt-6 gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <g clip-path="url(#clip0_4514_3509)">
                        <path d="M13.9714 7.00665C13.8679 6.84578 13.6901 6.75015 13.5 6.75015H9.56255V0.562738C9.56255 0.297241 9.37693 0.0677446 9.11706 0.0126204C8.85269 -0.0436289 8.59394 0.0924942 8.48594 0.334366L3.986 10.4592C3.90838 10.6325 3.92525 10.835 4.02875 10.9936C4.13225 11.1533 4.31 11.2501 4.50012 11.2501H8.43757V17.4375C8.43757 17.703 8.62319 17.9325 8.88306 17.9876C8.92244 17.9955 8.96181 18 9.00006 18C9.21831 18 9.42193 17.8729 9.51418 17.6659L14.0141 7.54102C14.0906 7.36664 14.076 7.1664 13.9714 7.00665Z" fill="url(#paint0_linear_4514_3509)"/>
                        </g>
                        <defs>
                        <linearGradient id="paint0_linear_4514_3509" x1="10.5204" y1="15.7845" x2="2.32033" y2="5.3758" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#E60C84"/>
                        <stop offset="1" stop-color="#FFCF4B"/>
                        </linearGradient>
                        <clipPath id="clip0_4514_3509">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>

                    <p class="text-color-14 dark:text-white font-Figtree font-normal text-[14px] leading-[22px] wrap-anywhere"> {!! __('Credits Balance: :x mins left', ['x' => "<span class='minute-credit-remaining font-semibold dark:text-[#FCCA19] text-[#E22861]'>" . ($minuteLimit == -1 ? __('Unlimited') : ($minuteLeft < 0 ? 0 : formatDecimal($minuteLeft))) . "</span>"]) !!}</p>
                </div>
            @endif
            <div class="flex flex-col mt-6">
                <div class="flex justify-between items-center mb-1.5">
                    <label class="font-normal text-14 text-color-2C dark:text-white require wrap-anywhere" for="">{{ __('Upload Audio') }}</label>
                    <p class="text-[13px] leading-5 text-color-89 font-Figtree font-medium">{{ __('Max size: :x MB', ['x' => preference('file_size')]) }}</p>
                </div>
            </div>
            <div class="file-drop-area border border-dashed border-color-89 rounded-xl bg-white dark:bg-color-33 dark:border-color-47 text-[13px] leading-[18px] font-normal font-Figtree text-color-14 wrap-anywhere text-center py-[37px] px-4 audio-speech relative">
                <div class="file-msg justify-center items-center flex gap-2.5 text-color-14 dark:text-white line-clamp-single">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99935 0.666016C6.36754 0.666016 6.66602 0.964492 6.66602 1.33268V5.33268H10.666C11.0342 5.33268 11.3327 5.63116 11.3327 5.99935C11.3327 6.36754 11.0342 6.66602 10.666 6.66602H6.66602V10.666C6.66602 11.0342 6.36754 11.3327 5.99935 11.3327C5.63116 11.3327 5.33268 11.0342 5.33268 10.666V6.66602H1.33268C0.964492 6.66602 0.666016 6.36754 0.666016 5.99935C0.666016 5.63116 0.964492 5.33268 1.33268 5.33268H5.33268V1.33268C5.33268 0.964492 5.63116 0.666016 5.99935 0.666016Z" fill="currentColor"/>
                    </svg>
                    <p>{{ __('Click or drag audio file here')}}</p>
                </div>
                <div class="upload-loader hidden"> 
                    <div class="text-[13px] leading-[18px] font-normal font-Figtree text-color-14 dark:text-white wrap-anywhere text-center justify-center items-center flex gap-2.5">
                        <svg class="animate-spin" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="path-1-inside-1_8860_7682" fill="white">
                            <path d="M14.6223 8C15.3832 8 16.0121 8.62132 15.8817 9.37094C15.6309 10.8124 14.9878 12.1669 14.0107 13.2794C12.7284 14.7392 10.9587 15.6825 9.032 15.9332C7.10524 16.1838 5.15313 15.7247 3.54009 14.6415C1.92705 13.5583 0.763355 11.9251 0.266254 10.0467C-0.230846 8.16843 -0.0273716 6.17339 0.838691 4.4341C1.70475 2.69481 3.1742 1.33015 4.9727 0.594902C6.7712 -0.140348 8.77582 -0.195932 10.6123 0.438526C12.0118 0.922023 13.2408 1.78107 14.1717 2.90981C14.6559 3.49679 14.4166 4.34785 13.7554 4.72422C13.0941 5.1006 12.2632 4.8519 11.728 4.31106C11.1665 3.74366 10.4785 3.30747 9.71257 3.04286C8.50861 2.62692 7.19443 2.66336 6.01537 3.14537C4.83631 3.62739 3.87297 4.52203 3.3052 5.66227C2.73742 6.80251 2.60403 8.11042 2.92992 9.3418C3.25581 10.5732 4.0187 11.6439 5.07617 12.354C6.13365 13.0641 7.41342 13.3651 8.67656 13.2008C9.93969 13.0365 11.0999 12.4181 11.9405 11.4611C12.4752 10.8522 12.8574 10.1328 13.0647 9.36193C13.2623 8.62716 13.8614 8 14.6223 8Z"/>
                            </mask>
                            <path d="M14.6223 8C15.3832 8 16.0121 8.62132 15.8817 9.37094C15.6309 10.8124 14.9878 12.1669 14.0107 13.2794C12.7284 14.7392 10.9587 15.6825 9.032 15.9332C7.10524 16.1838 5.15313 15.7247 3.54009 14.6415C1.92705 13.5583 0.763355 11.9251 0.266254 10.0467C-0.230846 8.16843 -0.0273716 6.17339 0.838691 4.4341C1.70475 2.69481 3.1742 1.33015 4.9727 0.594902C6.7712 -0.140348 8.77582 -0.195932 10.6123 0.438526C12.0118 0.922023 13.2408 1.78107 14.1717 2.90981C14.6559 3.49679 14.4166 4.34785 13.7554 4.72422C13.0941 5.1006 12.2632 4.8519 11.728 4.31106C11.1665 3.74366 10.4785 3.30747 9.71257 3.04286C8.50861 2.62692 7.19443 2.66336 6.01537 3.14537C4.83631 3.62739 3.87297 4.52203 3.3052 5.66227C2.73742 6.80251 2.60403 8.11042 2.92992 9.3418C3.25581 10.5732 4.0187 11.6439 5.07617 12.354C6.13365 13.0641 7.41342 13.3651 8.67656 13.2008C9.93969 13.0365 11.0999 12.4181 11.9405 11.4611C12.4752 10.8522 12.8574 10.1328 13.0647 9.36193C13.2623 8.62716 13.8614 8 14.6223 8Z" stroke="url(#paint0_linear_8860_7682)" stroke-width="24" mask="url(#path-1-inside-1_8860_7682)"/>
                            <defs>
                            <linearGradient id="paint0_linear_8860_7682" x1="10.4027" y1="14.0307" x2="4.84878" y2="1.49729" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#E60C84"/>
                            <stop offset="1" stop-color="#FFCF4B"/>
                            </linearGradient>
                            </defs>
                        </svg>
                        <p>{{ __('Uploading audio')}}</p>
                    </div>
                </div>
                <input class="file_input form-control" name="audio" id="file_input" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" type="file">
                <input type="text" class="hidden" name="duration" id="duration">
                <button id="deleteButton" class="hidden absolute top-3 right-3">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.33301 0.999674C4.33301 0.631485 4.63148 0.333008 4.99967 0.333008H8.99967C9.36786 0.333008 9.66634 0.631485 9.66634 0.999674C9.66634 1.36786 9.36786 1.66634 8.99967 1.66634H4.99967C4.63148 1.66634 4.33301 1.36786 4.33301 0.999674ZM2.32784 2.33301H0.999674C0.631485 2.33301 0.333008 2.63148 0.333008 2.99967C0.333008 3.36786 0.631485 3.66634 0.999674 3.66634H1.70931L2.1371 10.0833C2.17067 10.5869 2.19845 11.0037 2.24826 11.3429C2.30011 11.6961 2.38237 12.0189 2.55374 12.3197C2.82049 12.7879 3.22287 13.1644 3.70783 13.3994C4.01936 13.5504 4.34687 13.611 4.70274 13.6392C5.04453 13.6664 5.46223 13.6663 5.96697 13.6663H8.03238C8.53712 13.6663 8.95482 13.6664 9.29661 13.6392C9.65248 13.611 9.97999 13.5504 10.2915 13.3994C10.7765 13.1644 11.1789 12.7879 11.4456 12.3197C11.617 12.0189 11.6992 11.6961 11.7511 11.3429C11.8009 11.0037 11.8287 10.5869 11.8623 10.0832L12.29 3.66634H12.9997C13.3679 3.66634 13.6663 3.36786 13.6663 2.99967C13.6663 2.63148 13.3679 2.33301 12.9997 2.33301H11.6715C11.6676 2.33297 11.6637 2.33297 11.6598 2.33301H2.3395C2.33562 2.33297 2.33173 2.33297 2.32784 2.33301ZM10.9537 3.66634H3.0456L3.46572 9.96819C3.5015 10.5049 3.52624 10.8686 3.56745 11.1492C3.60747 11.4218 3.65637 11.5616 3.71226 11.6597C3.84564 11.8938 4.04682 12.082 4.2893 12.1995C4.3909 12.2488 4.53358 12.2883 4.80825 12.3101C5.09103 12.3325 5.45558 12.333 5.99344 12.333H8.0059C8.54377 12.333 8.90832 12.3325 9.1911 12.3101C9.46577 12.2883 9.60845 12.2488 9.71004 12.1995C9.95252 12.082 10.1537 11.8938 10.2871 11.6597C10.343 11.5616 10.3919 11.4218 10.4319 11.1492C10.4731 10.8686 10.4978 10.5049 10.5336 9.96819L10.9537 3.66634ZM5.66634 5.33301C6.03453 5.33301 6.33301 5.63148 6.33301 5.99967V9.33301C6.33301 9.7012 6.03453 9.99967 5.66634 9.99967C5.29815 9.99967 4.99967 9.7012 4.99967 9.33301V5.99967C4.99967 5.63148 5.29815 5.33301 5.66634 5.33301ZM8.33301 5.33301C8.7012 5.33301 8.99967 5.63148 8.99967 5.99967V9.33301C8.99967 9.7012 8.7012 9.99967 8.33301 9.99967C7.96482 9.99967 7.66634 9.7012 7.66634 9.33301V5.99967C7.66634 5.63148 7.96482 5.33301 8.33301 5.33301Z" fill="#898989"/>
                    </svg>
                </button>
            </div>
            <p class="text-color-89 text-[13px] leading-5 font-medium font-Figtree mt-1"><span class="text-color-14 dark:text-white">{{ __('Note') }}: </span>{{ __('Supported files are mp3, mp4, mpga, m4a, wav, and webm') }}</p>
            <div class="gap-6 mt-6 grid grid-cols-2">
                <div class="custom-dropdown-arrow font-normal text-14 text-color-2C dark:text-white">
                    <label>{{ __('Language') }}</label>
                    <select
                        class="select block w-full text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                        id="language" required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')">
                        @foreach ( $languages as $key => $language)
                            @if( in_array( $language->short_name , $meta_languages) )
                                <option value="{{ $language->short_name }}" {{ $key == 0 ? 'selected' : '' }}> {{ $language->name }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="custom-dropdown-arrow font-normal text-14 text-color-2C dark:text-white">
                    <label>{{ __('Word Filter') }}</label>
                    <select
                        class="select block w-full text-base leading-6 font-medium text-color-FFR bg-white bg-clip-padding bg-no-repeat dark:bg-[#333332] rounded-xl dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none form-control"
                        required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"  id="word_filter">
                            <option value="active"> {{ __('Active') }} </option>
                            <option value="inactive"> {{ __('Inactive') }} </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-[#F6F3F2] dark:bg-[#3A3A39] py-6 w-full relative px-5 xl:px-6 h-max">
        <button class="magic-bg w-full rounded-xl text-16 bottom-0 z-[99999] text-white font-semibold py-3 flex justify-center items-center gap-3 transcribe-btn" id="text-generate">
            <span>
                {{ __('Transcribe') }}
            </span>
            <svg class="loader animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">
                <mask id="path-1-inside-1_1032_3036" fill="white">
                    <path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" />
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
        </button>
    </div>
</form>
