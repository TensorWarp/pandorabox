<div class="package-description">
    <div class="h-max">
        <div class="rounded-xl bg-color-14 pl-6 pt-5 sub-plan-pack-des">
            <p class="text-white text-20 font-semibold font-Figtree">{{ $package->name }}
            </p>
            <div class="bg-color-47 rounded-lg py-2.5 pl-4 pr-[97px] mt-3 mr-6 active-package">
                <p class="text-24 font-medium font-RedHat text-white leading-8">
                    <span
                        class="text-36 font-bold leading-[44px]">{{ formatNumber($package->sale_price) }}</span>
                    <span class="text-14 font-Figtree leading-6">{{ $package->billing_cycle }}</span>
                </p>
            </div>

            <div class="flex flex-col gap-4 h-80 mt-5 overflow-auto sidebar-scrollbar py-5 pr-6">
                @foreach ($features as $key => $feature)
                    @if ($feature->is_visible)
                        <div class="flex items-center text-white text-14 font-medium font-Figtree gap-[9px]">
                            <svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                fill="none">
                                <path
                                    d="M11.1433 1.10826C11.4609 1.42579 11.4609 1.94146 11.1433 2.25899L4.64036 8.76197C4.32283 9.0795 3.80717 9.0795 3.48964 8.76197L0.238146 5.51048C-0.0793821 5.19295 -0.0793821 4.67728 0.238146 4.35976C0.555675 4.04223 1.07134 4.04223 1.38887 4.35976L4.06627 7.03462L9.99516 1.10826C10.3127 0.790735 10.8284 0.790735 11.1459 1.10826H11.1433Z"
                                    fill="url(#paint0_linear_950_2001)" />
                                <defs>
                                    <linearGradient id="paint0_linear_950_2001" x1="7.39992" y1="7.99947"
                                        x2="5.20783" y2="1.07424" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#E60C84" />
                                        <stop offset="1" stop-color="#FFCF4B" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <span>
                                @if ($feature->type != 'number')
                                    {{ $feature->title }}
                                @elseif ($feature->title_position == 'before')
                                    {{ $feature->title . ': ' }} {{ $feature->value == -1 ? __('Unlimited') : $feature->value }}
                                @else
                                    {{ $feature->value == -1 ? __('Unlimited') : $feature->value }} {{ $feature->title }}
                                @endif
                            </span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
