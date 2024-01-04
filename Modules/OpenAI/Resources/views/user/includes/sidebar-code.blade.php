@section('css')
    <link rel="stylesheet" href="{{ asset('public/dist/css/site_custom.min.css') }}">
@endsection
@php
    $wordLeft = 0;
    if ($userSubscription && in_array($userSubscription->status, ['Active', 'Cancel'])) {
        $wordLeft = $featureLimit['word']['remain'];
        $wordLimit = $featureLimit['word']['limit'];
    }
@endphp
<form id="openai-code-form">
    <div class="px-5 py-[22px] sm:py-8 xl:p-6 xl:pb-[56px] font-Figtree">
        <p class="text-color-14 text-24 font-semibold font-RedHat dark:text-white">{{ __('Write codes without coding!')}}</p>
        <p class="text-color-89 text-13 font-medium font-Figtree mt-2">{{ __('Let our AI write codes for your project and solve problems to speed up your work whether you know or not know any coding.') }}
        </p>
        @if ($wordLeft && auth()->user()->id == $userId)
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

            <p class="text-color-14 dark:text-white font-Figtree font-normal">{!! __('Credits Balance: :x words left', ['x' => "<span class='total-word-left font-semibold dark:text-[#FCCA19]'>" . ($wordLimit == -1 ? __('Unlimited') : ($wordLeft < 0 ? 0 : $wordLeft)) . "</span>"]) !!}</p>
        </div>
        @endif
        <div class="flex flex-col mt-6">
            <label class="require text-color-14 dark:text-white font-Figtree text-14 font-normal mb-1.5" for="">{{ __('Code Description') }}</label>
            <textarea
                class="questions dynamic-input peer py-1.5 mt-1.5 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light !text-color-14 dark:!text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:dark:!border-color-47 focus:outline-none w-full px-4 outline-none form-control"
                id="code-description" placeholder="{{ __('Briefly write down the description of the problem you want to solve..') }}" maxlength="" required
                oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" rows="3"
                name="code_description"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-6 justify-between mt-6">
            <div class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white">
                <label>{{ __('Language') }}</label>
                <select
                    class="select block w-full text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none"
                    id="language">
                    @foreach ( processPreferenceData($meta->language) as $key => $data)
                        <option value="{{ $data }}" {{ $key == 0 ? 'selected' : '' }}> {{ $data }} </option>
                    @endforeach
                </select>
            </div>
            <div class="font-normal custom-dropdown-arrow text-14 text-color-2C dark:text-white">
                <label>{{ __('Code Level') }}</label>
                <select
                    class="select block w-full text-base leading-6 font-medium text-color-2C bg-white bg-clip-padding bg-no-repeat rounded-xl dark:bg-[#333332] dark:rounded-2xl m-0 focus:text-color-2C focus:bg-white focus:border-color-89 focus:outline-none"
                    id="code-level">
                    @foreach ( processPreferenceData($meta->codeLabel) as $key => $data )
                        <option value="{{ codeLabel($data) }}" {{ $key == 0 ? 'selected' : '' }}> {{ $data }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6 xl:my-6">
            <button
                class="magic-bg w-full rounded-xl text-16 text-white font-semibold py-3 flex justify-center items-center gap-3"
                id="code-creation">
                <span>
                    {{ __('Write my Code') }}
                </span>
                <svg class="loader animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" width="72"
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
            </button>
        </div>
    </div>
</form>
