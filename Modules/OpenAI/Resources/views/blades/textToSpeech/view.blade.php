@extends('layouts.user_master')
@section('page_title', __('View Audio'))
@section('content')
<div class="dark:bg-[#292929] bg-[#F6F3F2] sidebar-scrollbar overflow-auto flex flex-col flex-1">
    <div>
        <div class="7xl:px-[185px] px-5 pt-[74px] pb-[56px]">
            <div>
                <div class="font-normal text-color-14 dark:text-white text-15 flex justify-start gap-3 items-center mt-2 mb-5">
                    <a href="{{ route('user.textToSpeechList') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.875 6C15.875 5.68934 15.6232 5.4375 15.3125 5.4375L2.0455 5.4375L5.58525 1.89775C5.80492 1.67808 5.80492 1.32192 5.58525 1.10225C5.36558 0.882582 5.00942 0.882582 4.78975 1.10225L0.289752 5.60225C0.0700827 5.82192 0.0700827 6.17808 0.289752 6.39775L4.78975 10.8977C5.00942 11.1174 5.36558 11.1174 5.58525 10.8977C5.80492 10.6781 5.80492 10.3219 5.58525 10.1023L2.0455 6.5625L15.3125 6.5625C15.6232 6.5625 15.875 6.31066 15.875 6Z" fill="currentColor" />
                        </svg>
                    </a>
                    <span>{{ __('Voiceover Lists') }}</span>
                </div>
                <div class="bg-white dark:bg-color-3A rounded-xl lg:p-6 p-4">
                    <div>
                        <p class="font-bold text-color-14 dark:text-white font-RedHat text-20 pb-3">{{ __('Voiceover Details') }}</p>
                        <div class="border-b border-color-DF dark:border-[#474746]"></div>
                    </div>
                    <div class="grid xl:grid-cols-2 mt-5">
                        <div class="mr-8">
                            <div class="grid grid-cols-2 gap-[100px]">
                                <div>
                                    <div>
                                        <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Voice') }}</p>
                                        <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ $audio->voice }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Speaking Style') }}</p>
                                        <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ audioEffect($audio->audio_effect, true) }}</p>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Language') }}</p>
                                        <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ ucfirst($audio->language) }}</p></p>
                                    </div>
                                    <div class="mt-4">
                                        <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Created On') }}</p>
                                        <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ !empty($audio->created_at) ? timeToGo($audio->created_at,  false, 'ago') : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 xl:mt-0">
                            <div class="flex justify-between items-center">
                                <p class="font-Figtree text-color-89 text-base leading-6 font-medium">{{ __('Text') }}</p>
                                <p class="font-Figtree text-color-89 text-[12px] leading-[18px] font-medium">{{ __(':x Characters', ['x' => $audio->characters ]) }} </p>
                            </div>
                            <div class="mt-2 p-5 bg-[#F6F3F2] dark:border rounded-xl dark:bg-[#474746] dark:border-color-47">
                                <p class="word-breaks font-medium font-Figtree text-[15px] text-color-2C dark:text-white leading-[22px]"> {{ $audio->prompt }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="grid xl:grid-cols-2 grid-cols-1 gap-8 mt-5">
                       <div>
                        <div class="flex gap-2 items-center">
                            <p class="font-Figtree text-color-89 text-[13px] leading-[22px] font-medium whitespace-nowrap">{{ __('Advanced Options')}}</p>
                            <div class="border-b border-color-DF dark:border-color-47 w-full"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-[100px] mt-5">
                            <div>
                                <div>
                                    <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Volume')}}</p>
                                    <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ volume($audio->volume, true) }}</p>
                                </div>
                                <div class="mt-4">
                                    <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Pitch')}}</p>
                                    <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ pitch($audio->pitch, true) }}</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Speed')}}</p>
                                    <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ speed($audio->speed, true) }}</p>
                                </div>
                                <div class="mt-4">
                                    <p class="font-Figtree text-color-89 text-[14px] leading-[22px] font-medium">{{ __('Pauses')}}</p>
                                    <p class="font-Figtree text-color-14 dark:text-white text-base leading-6 font-semibold line-clamp-single">{{ $audio->pause }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[92px] flex md:gap-5 gap-4 justify-start items-center mt-8">
                            <button class="siglePlay" data-src="{{ $audio->googleAudioUrl() }}" onclick="playstop()">
                                <svg id="playIcon" class="text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.8176 14.0271L8.08059 20.7949C7.16938 21.3686 6 20.6739 6 19.5172V5.98176C6 4.82693 7.16769 4.13036 8.08059 4.70594L18.8176 11.4737C19.0249 11.6022 19.1972 11.788 19.317 12.0122C19.4369 12.2365 19.5 12.4911 19.5 12.7504C19.5 13.0097 19.4369 13.2643 19.317 13.4886C19.1972 13.7128 19.0249 13.8986 18.8176 14.0271Z" fill="currentColor"/>
                                </svg>  
                              
                                <svg id="pauseIcon" class="text-color-14 dark:text-white hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 20.25H6.75V3.75H10.5V20.25ZM17.25 20.25H13.5V3.75H17.25V20.25Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <div class="flex md:gap-5 gap-4 items-center">
                                <div id="waveform" class="lg:w-[448px] h-[60px] res-audio"></div>
                                 <div class="w-[70px]" id="waveform-time-indicator">
                                    <p class="font-medium text-color-14 font-Figtree leading-6 dark:text-white time">00:00:00</p>
                                </div>
                            </div>
                            <button id="speakerButton">
                                <svg  id="unmutedIcon" class="text-color-14 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <g clip-path="url(#clip0_9805_6393)">
                                        <path d="M13.134 4.18446C13.2749 4.08389 13.4397 4.02196 13.612 4.00485C13.7844 3.98774 13.9582 4.01606 14.1161 4.08697C14.2741 4.15789 14.4106 4.26891 14.5121 4.40897C14.6136 4.54902 14.6765 4.7132 14.6946 4.88512L14.7 4.98752V19.0116C14.7001 19.1844 14.6547 19.3543 14.5684 19.5042C14.4821 19.654 14.3579 19.7787 14.2083 19.8657C14.0586 19.9527 13.8887 19.999 13.7155 20C13.5423 20.0009 13.3719 19.9565 13.2213 19.8712L13.1349 19.8155L7.212 15.5927H4.8C4.34588 15.5928 3.90849 15.4216 3.57551 15.1135C3.24252 14.8053 3.03856 14.3828 3.0045 13.9309L3 13.7961V10.203C2.99986 9.74972 3.17137 9.31316 3.48015 8.98081C3.78893 8.64846 4.21216 8.44488 4.665 8.41089L4.8 8.4064H7.212L13.134 4.18446ZM18.9003 7.31319C19.5615 7.90242 20.0904 8.62457 20.4523 9.43223C20.8142 10.2399 21.0008 11.1148 21 11.9995C21.0008 12.8843 20.8142 13.7592 20.4523 14.5669C20.0904 15.3745 19.5615 16.0967 18.9003 16.6859C18.8125 16.7659 18.7096 16.8277 18.5977 16.8677C18.4858 16.9078 18.367 16.9254 18.2483 16.9194C18.1296 16.9134 18.0132 16.884 17.9059 16.8328C17.7986 16.7817 17.7026 16.7098 17.6233 16.6214C17.5439 16.533 17.483 16.4298 17.4439 16.3177C17.4048 16.2057 17.3883 16.087 17.3954 15.9685C17.4025 15.8501 17.433 15.7342 17.4853 15.6276C17.5375 15.521 17.6104 15.4258 17.6997 15.3475C18.1724 14.9267 18.5504 14.4109 18.809 13.8338C19.0676 13.2568 19.2008 12.6317 19.2 11.9995C19.2 10.6701 18.6222 9.47536 17.6997 8.65163C17.6104 8.5733 17.5375 8.47809 17.4853 8.37148C17.433 8.26488 17.4025 8.14901 17.3954 8.03056C17.3883 7.9121 17.4048 7.79342 17.4439 7.68136C17.483 7.5693 17.5439 7.46608 17.6233 7.37767C17.7026 7.28926 17.7986 7.21741 17.9059 7.16627C18.0132 7.11513 18.1296 7.08571 18.2483 7.07971C18.367 7.07372 18.4858 7.09126 18.5977 7.13134C18.7096 7.17141 18.8125 7.23322 18.9003 7.31319ZM17.1003 9.32175C17.478 9.65838 17.7801 10.0709 17.9868 10.5322C18.1936 10.9935 18.3003 11.4933 18.3 11.9986C18.3006 12.5043 18.194 13.0044 17.9873 13.4661C17.7805 13.9278 17.4782 14.3405 17.1003 14.6773C16.9296 14.8286 16.7077 14.9095 16.4795 14.9037C16.2513 14.8978 16.0339 14.8056 15.8712 14.6458C15.7086 14.486 15.6128 14.2704 15.6034 14.0428C15.594 13.8151 15.6716 13.5924 15.8205 13.4197L15.8997 13.3389C16.2687 13.0083 16.5 12.5313 16.5 11.9995C16.5011 11.5395 16.3244 11.0968 16.0068 10.7635L15.8997 10.6602C15.8104 10.5819 15.7375 10.4867 15.6853 10.3801C15.633 10.2735 15.6025 10.1576 15.5954 10.0391C15.5883 9.92067 15.6048 9.80198 15.6439 9.68992C15.683 9.57786 15.7439 9.47465 15.8233 9.38624C15.9026 9.29783 15.9986 9.22598 16.1059 9.17483C16.2132 9.12369 16.3296 9.09428 16.4483 9.08828C16.567 9.08228 16.6858 9.09983 16.7977 9.1399C16.9096 9.17998 17.0125 9.24178 17.1003 9.32175Z" fill="currentColor"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_9805_6393">
                                        <rect width="24" height="24" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg> 

                                <svg id="mutedIcon" class="text-color-14 dark:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_10964_6466)">
                                    <path d="M13.134 4.18446C13.2749 4.08389 13.4397 4.02196 13.612 4.00485C13.7844 3.98774 13.9582 4.01606 14.1161 4.08697C14.2741 4.15789 14.4106 4.26891 14.5121 4.40897C14.6136 4.54902 14.6765 4.7132 14.6946 4.88512L14.7 4.98752V19.0116C14.7001 19.1844 14.6547 19.3543 14.5684 19.5042C14.4821 19.654 14.3579 19.7787 14.2083 19.8657C14.0586 19.9527 13.8887 19.999 13.7155 20C13.5423 20.0009 13.3719 19.9565 13.2213 19.8712L13.1349 19.8155L7.212 15.5927H4.8C4.34588 15.5928 3.90849 15.4216 3.57551 15.1135C3.24252 14.8053 3.03856 14.3828 3.0045 13.9309L3 13.7961V10.203C2.99986 9.74972 3.17137 9.31316 3.48015 8.98081C3.78893 8.64846 4.21216 8.44489 4.665 8.41089L4.8 8.4064H7.212L13.134 4.18446Z" fill="#141414"/>
                                    <path d="M22 13.9995L20 12L22 10.0005L21.0014 9L19 10.9995L17 9L16 10.0005L18 12L16 13.9995L17 15L19 13.0005L21 15L22 13.9995Z" fill="currentColor"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_10964_6466">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                       </div>
                    </div>
                    <div class="mt-6 flex flex-wrap sm:gap-3 gap-2.5">
                        <a href="{{ $audio->googleAudioUrl() }}" download="{{ $audio->file_name }}" class="file-need-download flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-14 down-img-btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.25C9.41421 2.25 9.75 2.58579 9.75 3V10.1893L12.2197 7.71967C12.5126 7.42678 12.9874 7.42678 13.2803 7.71967C13.5732 8.01256 13.5732 8.48744 13.2803 8.78033L9.53033 12.5303C9.23744 12.8232 8.76256 12.8232 8.46967 12.5303L4.71967 8.78033C4.42678 8.48744 4.42678 8.01256 4.71967 7.71967C5.01256 7.42678 5.48744 7.42678 5.78033 7.71967L8.25 10.1893V3C8.25 2.58579 8.58579 2.25 9 2.25ZM3 12C3.41421 12 3.75 12.3358 3.75 12.75V14.25C3.75 14.4489 3.82902 14.6397 3.96967 14.7803C4.11032 14.921 4.30109 15 4.5 15H13.5C13.6989 15 13.8897 14.921 14.0303 14.7803C14.171 14.6397 14.25 14.4489 14.25 14.25V12.75C14.25 12.3358 14.5858 12 15 12C15.4142 12 15.75 12.3358 15.75 12.75V14.25C15.75 14.8467 15.5129 15.419 15.091 15.841C14.669 16.2629 14.0967 16.5 13.5 16.5H4.5C3.90326 16.5 3.33097 16.2629 2.90901 15.841C2.48705 15.419 2.25 14.8467 2.25 14.25V12.75C2.25 12.3358 2.58579 12 3 12Z" fill="#F3F3F3"/>
                            </svg>
                            <span class="wrap-anywhere text-white font-sm leading-[22px] font-Figtree font-medium">{{ __('Download')}}</span>
                        </a>
                        <a href="javascript: void(0)" class="flex justify-center items-center gap-2 px-4 py-[9px] rounded-xl bg-color-F6 dark:bg-color-3A border border-color-89 dark:border-color-47 text-color-14 dark:text-white modal-toggle" id ="{{ $audio->id}}">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2.25C6 1.83579 6.33579 1.5 6.75 1.5H11.25C11.6642 1.5 12 1.83579 12 2.25C12 2.66421 11.6642 3 11.25 3H6.75C6.33579 3 6 2.66421 6 2.25ZM3.74418 3.75H2.25C1.83579 3.75 1.5 4.08579 1.5 4.5C1.5 4.91421 1.83579 5.25 2.25 5.25H3.04834L3.52961 12.4691C3.56737 13.0357 3.59862 13.5045 3.65465 13.8862C3.71299 14.2835 3.80554 14.6466 3.99832 14.985C4.29842 15.5118 4.75109 15.9353 5.29667 16.1997C5.64714 16.3695 6.0156 16.4377 6.41594 16.4695C6.80046 16.5 7.27037 16.5 7.8382 16.5H10.1618C10.7296 16.5 11.1995 16.5 11.5841 16.4695C11.9844 16.4377 12.3529 16.3695 12.7033 16.1997C13.2489 15.9353 13.7016 15.5118 14.0017 14.985C14.1945 14.6466 14.287 14.2835 14.3453 13.8862C14.4014 13.5045 14.4326 13.0356 14.4704 12.469L14.9517 5.25H15.75C16.1642 5.25 16.5 4.91421 16.5 4.5C16.5 4.08579 16.1642 3.75 15.75 3.75H14.2558C14.2514 3.74996 14.2471 3.74996 14.2427 3.75H3.75731C3.75294 3.74996 3.74857 3.74996 3.74418 3.75ZM13.4483 5.25H4.55166L5.0243 12.3396C5.06455 12.9433 5.09238 13.3525 5.13874 13.6683C5.18377 13.9749 5.23878 14.1321 5.30166 14.2425C5.45171 14.5059 5.67804 14.7176 5.95083 14.8498C6.06513 14.9052 6.22564 14.9497 6.53464 14.9742C6.85277 14.9995 7.26289 15 7.86799 15H10.132C10.7371 15 11.1472 14.9995 11.4654 14.9742C11.7744 14.9497 11.9349 14.9052 12.0492 14.8498C12.322 14.7176 12.5483 14.5059 12.6983 14.2425C12.7612 14.1321 12.8162 13.9749 12.8613 13.6683C12.9076 13.3525 12.9354 12.9433 12.9757 12.3396L13.4483 5.25ZM7.5 7.125C7.91421 7.125 8.25 7.46079 8.25 7.875V11.625C8.25 12.0392 7.91421 12.375 7.5 12.375C7.08579 12.375 6.75 12.0392 6.75 11.625V7.875C6.75 7.46079 7.08579 7.125 7.5 7.125ZM10.5 7.125C10.9142 7.125 11.25 7.46079 11.25 7.875V11.625C11.25 12.0392 10.9142 12.375 10.5 12.375C10.0858 12.375 9.75 12.0392 9.75 11.625V7.875C9.75 7.46079 10.0858 7.125 10.5 7.125Z" fill="currentColor"/>
                            </svg>
                            <span class="wrap-anywhere font-sm leading-[22px] font-Figtree font-medium">{{ __('Delete')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal index-modal absolute z-[9999999999] top-0 left-0 right-0 w-full h-full">
        <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
        </div>
        <div class="modal-wrapper modal-wrapper modal-transition fixed inset-0 z-10">
            <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                    <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                       {{ __('Are you sure you want to delete this Audio?') }}</p>
                    <div class="flex justify-center items-center mt-7 gap-[16px]">
                        <a href="javascript: void(0)"
                            class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                            {{ __('Cancel') }}</a>
                        <a href="javascript: void(0)"
                            class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl modal-delete-audio">
                            {{ __('Yes, Delete') }} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection
@section('js')
<script src="{{ asset('public/assets/js/user/speech-view.min.js') }}"></script>
@endsection
