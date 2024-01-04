<div class="partialContent-{{ $partialContent->id }}">
    <div class="4xl:w-[348px] 6xl:w-[401px] 8xl:w-[474px] 4xl:border-r dark:border-[#474746] par-his-border-rtl">
        <div class="6xl:px-12 xl:px-5 pt-6 4xl:pb-[56px] 4xl:h-[calc(100vh-56px)] sidebar-scrollbar overflow-auto">
            <div class="grid grid-cols-2 h-max gap-6 justify-between">
                <div class="flex flex-col font-normal dashboardThree text-14">
                    <label class="mb-1.5 dark:text-white text-color-14" for="">{{ __('Language') }}</label>
                    <div class="w-full text-base leading-6 px-4 py-3 font-medium dark:text-white dark:bg-[#3A3A39] bg-color-F3 rounded-xl m-0"
                        id="language">
                        <p class="text-color-14R dark:text-color-FFR">{{ $partialContent->language }}</p>
                    </div>
                </div>
                <div class="flex flex-col font-normal dashboardThree text-14">
                    <label class="mb-1.5 text-color-14 dark:text-white" for="">{{ __('Tone') }}</label>
                    <div
                        class="w-full text-base leading-6 px-4 py-3 font-medium text-color-14 dark:text-white dark:bg-[#3A3A39] bg-color-F3 rounded-xl m-0">
                        <p class="text-color-14R dark:text-color-FFR">{{ $partialContent->tone }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex flex-col dashboardThree font-normal text-14">
                    <label class="mb-1.5 text-color-14 dark:text-white" for="">{{ __('Use case') }}</label>
                    <div
                        class="w-full text-base leading-6 px-4 py-3 font-medium text-color-14 dark:text-white dark:bg-[#3A3A39] bg-color-F3 rounded-xl m-0">
                        <p class="text-color-14R dark:text-color-FFR">{{ optional($partialContent->useCase)->slug }}</p>
                    </div>
                </div>
            </div>
            @foreach ($partialContent->option as $key => $data)
                <div class="mt-6 flex flex-col dashboardThree font-normal text-14">
                    <label class="mb-1.5 text-color-14 dark:text-white" for="">{{ $data->label }}</label>
                    <div
                        class="w-full  text-base leading-6 px-4 py-3 font-medium text-color-14 dark:text-white dark:bg-[#3A3A39] bg-color-F3 rounded-xl m-0 text-color-14R dark:text-color-FFR">
                        {{ $questions[$key] }}

                    </div>
                </div>
            @endforeach
            <div class="flex flex-col mt-6 dashboardThree font-normal text-14">
                <label class=" mb-1.5 text-color-14 dark:text-white" for="">{{ __('Creativity level') }}</label>
                <div
                    class="w-full  text-base leading-6 px-4 py-3 font-medium text-color-14 dark:text-white dark:bg-[#3A3A39] bg-color-F3 rounded-xl m-0">
                    <p class="text-color-14R dark:text-color-FFR">
                        {{ creativityLabel($partialContent->creativity_label) }}</p>
                </div>
            </div>
            <div class="my-6 flex justify-between items-center">
                @if(is_null($partialContent->parent_id))
                <a href="javascript: void(0)" class="flex items-center gap-1.5 modal-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                        fill="none">
                        <path
                            d="M2.1875 0.875C1.70425 0.875 1.3125 1.26675 1.3125 1.75V2.625C1.3125 3.10825 1.70425 3.5 2.1875 3.5H2.625V11.375C2.625 12.3415 3.4085 13.125 4.375 13.125H9.625C10.5915 13.125 11.375 12.3415 11.375 11.375V3.5H11.8125C12.2957 3.5 12.6875 3.10825 12.6875 2.625V1.75C12.6875 1.26675 12.2957 0.875 11.8125 0.875H8.75C8.75 0.391751 8.35825 0 7.875 0H6.125C5.64175 0 5.25 0.391751 5.25 0.875H2.1875ZM4.8125 4.375C5.05412 4.375 5.25 4.57088 5.25 4.8125V10.9375C5.25 11.1791 5.05412 11.375 4.8125 11.375C4.57088 11.375 4.375 11.1791 4.375 10.9375L4.375 4.8125C4.375 4.57088 4.57088 4.375 4.8125 4.375ZM7 4.375C7.24162 4.375 7.4375 4.57088 7.4375 4.8125V10.9375C7.4375 11.1791 7.24162 11.375 7 11.375C6.75838 11.375 6.5625 11.1791 6.5625 10.9375V4.8125C6.5625 4.57088 6.75838 4.375 7 4.375ZM9.625 4.8125V10.9375C9.625 11.1791 9.42912 11.375 9.1875 11.375C8.94588 11.375 8.75 11.1791 8.75 10.9375V4.8125C8.75 4.57088 8.94588 4.375 9.1875 4.375C9.42912 4.375 9.625 4.57088 9.625 4.8125Z"
                            fill="#898989" />
                    </svg>
                    <span class="text-[15px] text-color-14 dark:text-white leading-[22px]">{{ __('Delete') }}</span>
                </a>
                @endif
                <div class="modal absolute z-50 top-0 left-0 right-0 w-full h-full">
                    <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
                    </div>
                    <div class="modal-wrapper  modal-wrapper modal-transition fixed inset-0 z-10">
                        <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
                            <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                                <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                                    {{ __('Are you sure you want to delete this history item?') }}</p>
                                <div class="flex justify-center items-center mt-7 gap-[16px]">
                                    <a href="#"
                                        class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                                        {{ __('Cancel') }}</a>
                                    <a href="#"
                                        class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-content"
                                        id="{{ $partialContent->id }}">
                                        {{ __('Yes, Delete') }} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-8 4xl:h-[calc(100vh-56px)] sidebar-scrollbar overflow-auto w-full">

   <div class="grid grid-cols-3 mt-6 6xl:px-12 xl:px-5 ">
        <div class="col-span-2">
            <p class="text-color-14 text-14 dark:text-color-89">{{ __('Document') }}</p>
            <a href="@if(is_null($partialContent->parent_id))  {{ route('user.editContent', $partialContent->slug) }} @else # @endif" class="flex flex-wrap items-start justify-start gap-2 mr-2"><span
                    class="text-color-14 leading-[28px] text-xl font-semibold dark:text-white">
                    {{ $partialContent->title }}
                </span>
                <span>
                    <svg class="mt-1 w-5 h-5 neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 20 20" fill="none">
                    <circle cx="10" cy="10" r="9" fill="white" />
                    <path
                        d="M10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0ZM5.625 9.375C5.27982 9.375 5 9.65482 5 10C5 10.3452 5.27982 10.625 5.625 10.625H12.8661L10.1831 13.3081C9.93898 13.5521 9.93898 13.9479 10.1831 14.1919C10.4271 14.436 10.8229 14.436 11.0669 14.1919L14.8169 10.4419C15.061 10.1979 15.061 9.80214 14.8169 9.55806L11.0669 5.80806C10.8229 5.56398 10.4271 5.56398 10.1831 5.80806C9.93898 6.05214 9.93898 6.44786 10.1831 6.69194L12.8661 9.375H5.625Z"
                        fill="url(#paint0_linear_425_1759)" />
                    <defs>
                        <linearGradient id="paint0_linear_425_1759" x1="13.0034" y1="17.5384" x2="6.06098"
                            y2="1.87161" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#E60C84" />
                            <stop offset="1" stop-color="#FFCF4B" />
                        </linearGradient>
                    </defs>
                </svg>
                </span>
            </a>
        </div>
        <div class="col-span-1">
            <p class="text-color-89 text-14 font-medium text-right">{{ __('Credits used') }} <span class="text-color-14 dark:text-white ">{{ is_null($partialContent->parent_id) ? $wrodCount : 0 }}</span> </p>
            <p class="text-color-89 text-14 font-medium text-right">{{ __('Date') }} <span class="text-color-22 dark:text-white">{{ formatDate($partialContent->created_at) }}</span> </p>
        </div>
   </div>
    <div class="mt-4 6xl:px-12 xl:px-5 flex flex-col gap-3">
        <p class="text-14 font-normal text-color-14 dark:text-white">{{ !is_null($partialContent->parent_id) ? __('Generated Variants') : __('Original Variant') }}</p>
        <div class="p-5 bg-color-F3 dark:bg-[#333332] rounded-xl font-normal text-color-14 dark:text-white text-16"
            id="content-text">{!! $partialContent->content !!}
        </div>
    </div>
</div>
