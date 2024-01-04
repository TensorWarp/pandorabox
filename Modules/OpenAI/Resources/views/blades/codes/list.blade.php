@extends('layouts.user_master')
@section('page_title', __('Code History'))
@section('content')
{{-- main content --}}
<div class="dark:bg-[#292929] bg-[#F6F3F2] sidebar-scrollbar overflow-auto flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF relative">
    @include('openai::blades.history-nav', ['menu' => 'codes'])
    <div class="9xl:px-[185px] 7xl:px-[140px] px-5 pt-5 9xl:pb-[22px] pb-28">
        <div class="flex justify-end items-center mt-2.5 mb-5 gap-3">
            <a href="{{ route('user.codeTemplate') }}" class="justify-end items-center gap-2 text-color-14 dark:text-white inline-block text-right">
                <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 1.75C7.24162 1.75 7.4375 1.94588 7.4375 2.1875V6.5625H11.8125C12.0541 6.5625 12.25 6.75838 12.25 7C12.25 7.24162 12.0541 7.4375 11.8125 7.4375H7.4375V11.8125C7.4375 12.0541 7.24162 12.25 7 12.25C6.75837 12.25 6.5625 12.0541 6.5625 11.8125V7.4375H2.1875C1.94588 7.4375 1.75 7.24162 1.75 7C1.75 6.75838 1.94588 6.5625 2.1875 6.5625H6.5625V2.1875C6.5625 1.94588 6.75838 1.75 7 1.75Z" fill="currentColor"/>
                </svg>
                <span class="text-[15px] leading-[22px] font-Figtree font-normal text-right">{{ __('Get New Code')}}</span>
            </a>
        </div>
        <div class="bg-white dark:bg-[#3A3A39] rounded-xl image-list-table">
            <div class="flex flex-col">
                <div class="xl:overflow-auto rounded-xl p-1.5">
                    <table class="min-w-full">
                        <thead class="bg-color-DF dark:bg-[#474746] rounded-xl">
                            <tr class="rounded-lg">
                                <th class="md:pl-[34px] md:pr-6 px-3 py-[9px] font-Figtree text-left text-14 font-medium text-color-14 md:w-[200px] w-28 dark:text-white docs-table-row-one">
                                    {{ __('Name') }}
                                </th>
                                <th class="xs:px-6 py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white">
                                    {{ __('Language') }}
                                </th>
                                <th
                                    class="xs:px-6 py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white hidden xl:table-cell">
                                    {{ __('Level') }}
                                </th>
                                <th class="xs:px-6 py-[9px] text-left font-Figtree text-14 font-medium text-color-14 dark:text-white hidden xl:table-cell">
                                    {{ __('Time') }}
                                </th>
                                <th class="md:pr-[34px] pr-3 py-[9px] text-right font-Figtree text-14 font-medium text-color-14 dark:text-white w-max action-rtl">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($codes as $code)
                                <tr class="border-b dark:border-[#474746]" id="code_{{ $code->id }}">
                                    <td class="text-14 font-Figtree py-[18px] text-color-14 dark:text-white font-medium md:pl-[34px] md:pr-6 px-3  docs-table-row-one">
                                        <a href="{{ route('user.codeView', $code->slug) }}"
                                            class="flex items-center justify-start">
                                            <span class="w-[138px] xs:w-[170px] 4xl:w-[300px] lg:w-[200px] break-words flex items-center line-clamp-double">
                                                {{ trimWords($code->promt,80) }}
                                            </span>
                                        </a>
                                        <span class="text-[13px] font-Figtree text-color-89 font-medium mt-2 xl:hidden block break-words">{{ codeLabel($code->code_label, true) }}</span>
                                        <span class="text-[13px] font-Figtree text-color-89 font-medium mt-2 xl:hidden block">{{ timeToGo($code->created_at, false, 'ago') }}</span>
                                    </td>
                                    <td  class="text-14 font-Figtree py-[18px] text-color-89 font-medium xs:px-6 lg:w-64 whitespace-nowrap align-top xl:align-middle">
                                        {{ $code->language }}
                                    </td>
                                    <td class="text-14 font-Figtree py-[18px] text-color-89 font-medium px-6 w-64 whitespace-nowrap hidden xl:table-cell">
                                        {{ codeLabel($code->code_label, true) }}
                                    </td>
                                    <td class="text-14 font-Figtree py-[18px] text-color-89 font-medium px-6 w-64 whitespace-nowrap hidden xl:table-cell">
                                        {{ timeToGo($code->created_at, false, 'ago')}}
                                    </td>
                                    <td class="text-14 font-Figtree py-[18px] text-color-14 dark:text-white font-medium md:pr-[34px] pr-3 w-max align-top xl:align-middle text-right action-rtl">
                                        <div class="gap-4 justify-end items-center hidden xl:flex">
                                            <div class="relative">
                                                <a class="tooltip-edit flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center neg-transition-scale" title = "{{ __('View Code')}}"
                                                    href="{{ route('user.codeView', $code->slug) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 16 16" fill="none">
                                                        <g clip-path="url(#clip0_2387_1688)">
                                                            <path d="M7.99972 3C4.66638 3 1.81972 5.07333 0.666382 8C1.81972 10.9267 4.66638 13 7.99972 13C11.333 13 14.1797 10.9267 15.333 8C14.1797 5.07333 11.333 3 7.99972 3ZM7.99972 11.3333C6.15972 11.3333 4.66638 9.84 4.66638 8C4.66638 6.16 6.15972 4.66667 7.99972 4.66667C9.83972 4.66667 11.333 6.16 11.333 8C11.333 9.84 9.83972 11.3333 7.99972 11.3333ZM7.99972 6C6.89305 6 5.99972 6.89333 5.99972 8C5.99972 9.10667 6.89305 10 7.99972 10C9.10638 10 9.99972 9.10667 9.99972 8C9.99972 6.89333 9.10638 6 7.99972 6Z" fill="currentColor" />
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
                                            <a class="tooltip-delete relative flex items-center p-2 border border-color-89 dark:border-color-47 bg-white text-color-14 dark:text-white dark:bg-color-47 rounded-lg justify-center modal-toggle" id="{{ $code->id }}" title ="{{ __('Delete Code')}}" href="javascript: void(0)" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.84615 2.8C3.37884 2.8 3 3.15817 3 3.6V4.4C3 4.84183 3.37884 5.2 3.84615 5.2H4.26923V12.4C4.26923 13.2837 5.0269 14 5.96154 14H11.0385C11.9731 14 12.7308 13.2837 12.7308 12.4V5.2H13.1538C13.6212 5.2 14 4.84183 14 4.4V3.6C14 3.15817 13.6212 2.8 13.1538 2.8H10.1923C10.1923 2.35817 9.81347 2 9.34615 2H7.65385C7.18653 2 6.80769 2.35817 6.80769 2.8H3.84615ZM6.38462 6C6.61827 6 6.80769 6.17909 6.80769 6.4V12C6.80769 12.2209 6.61827 12.4 6.38462 12.4C6.15096 12.4 5.96154 12.2209 5.96154 12L5.96154 6.4C5.96154 6.17909 6.15096 6 6.38462 6ZM8.5 6C8.73366 6 8.92308 6.17909 8.92308 6.4V12C8.92308 12.2209 8.73366 12.4 8.5 12.4C8.26634 12.4 8.07692 12.2209 8.07692 12V6.4C8.07692 6.17909 8.26634 6 8.5 6ZM11.0385 6.4V12C11.0385 12.2209 10.849 12.4 10.6154 12.4C10.3817 12.4 10.1923 12.2209 10.1923 12V6.4C10.1923 6.17909 10.3817 6 10.6154 6C10.849 6 11.0385 6.17909 11.0385 6.4Z" fill="currentColor"/>
                                                </svg>
                                            </a>

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
                                                    <a href="{{ route('user.codeView', $code->slug) }}" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg text-left">
                                                        <span class="w-4 h-4">
                                                            <svg class="w-4 h-4" width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.99984 0C4.6665 0 1.81984 2.07333 0.666504 5C1.81984 7.92667 4.6665 10 7.99984 10C11.3332 10 14.1798 7.92667 15.3332 5C14.1798 2.07333 11.3332 0 7.99984 0ZM7.99984 8.33333C6.15984 8.33333 4.6665 6.84 4.6665 5C4.6665 3.16 6.15984 1.66667 7.99984 1.66667C9.83984 1.66667 11.3332 3.16 11.3332 5C11.3332 6.84 9.83984 8.33333 7.99984 8.33333ZM7.99984 3C6.89317 3 5.99984 3.89333 5.99984 5C5.99984 6.10667 6.89317 7 7.99984 7C9.1065 7 9.99984 6.10667 9.99984 5C9.99984 3.89333 9.1065 3 7.99984 3Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        
                                                        <p>{{ __('View Code')}}</p>
                                                    </a>
                                                    <a href="javascript: void(0)" id="{{ $code->id }}" class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-none rounded-b-lg  modal-toggle text-left">
                                                        <span class="w-4 h-3">
                                                            <svg class="w-3 h-3" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                        <p class="text-center font-Figtree text-16 font-medium text-color-14 py-5 dark:text-white">{{ __('No code is available to be displayed.') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- pagination --}}
        {{ $codes->onEachSide(1)->links('site.layout.partials.pagination') }}
    </div>
</div>
{{-- modal --}}
<div class="index-modal modal absolute z-50 top-0 left-0 right-0 w-full h-full">
    <div class="modal-overlay fixed z-10 top-0 right-0 left-0 w-full h-full">
    </div>
    <div class="modal-wrapper modal-wrapper modal-transition fixed inset-0 z-10">
        <div class="modal-body flex h-full justify-center p-4 text-center items-center sm:p-0">
            <div class="modal-content modal-transition rounded-xl py-6 md:px-[54px] bg-white dark:bg-color-3A px-8">
                <p class="font-Figtree text-color-14 dark:text-white text-16 font-medium text-center">
                    {{ __('Are you sure you want to delete this Code?') }}</p>
                <div class="flex justify-center items-center mt-7 gap-[16px]">
                    <a href="javascript: void(0)"
                        class="font-Figtree text-color-14 dark:text-white font-semibold text-15 py-[11px] px-[42px] border border-color-89 dark:border-color-47 bg-color-F6 dark:bg-color-47 rounded-xl modal-toggle">
                        {{ __('Cancel') }}</a>
                    <a href="javascript: void(0)" class="font-Figtree text-white font-semibold text-15 py-[11px] px-[30px] modal-toggle bg-color-DFF rounded-xl delete-code">
                        {{ __('Yes, Delete') }} </a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end main content --}}
@endsection

