@extends('layouts.master')
@section('page_title', __('Image Gallery'))

@section('child-css')
<link rel="stylesheet" href="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.css') }}">
@endsection

@section('child-content')

<div class="bg-[#292929] h-screen overflow-auto">

    <div class="flex justify-center pt-[22px] sm:pt-7 pb-[121px] sm:pb-[56px]">
        <div class="w-[356px] sm:w-[512px]">
            <div class="flex items-center justify-center">
                <a href="javascript:void(0)" class="b-brand">
                    @php $logo = App\Models\Preference::getLogo() @endphp
                    <img class="w-[144px] sm:w-[147px] h-[34px] sm:h-[40px] object-contain" 
                    src="{{ $logo }}">
                </a> 
            </div>
            <p
                class="mt-[38px] sm:mt-[40px] text-center text-white text-24 leading-[34px] font-RedHat word-breaks line-clamp-double font-semibold">
               {{ $currentImage->promt }}
            </p>

            <p class="mt-3 text-center text-color-89 text-15 font-Figtree word-breaks font-normal">{{ __('Created by :x', ['x' => $currentImage->user?->name ]) }}</p>

            <div class="mt-5">
                <div class="swiper mySwiper2 !h-[356px] sm:!h-[512px]">
                    <div class="swiper-wrapper">
                        @foreach($variants as $variant)
                            <div class="swiper-slide">
                                <img class="rounded-lg w-full h-full object-cover"
                                    src="{{ $variant->imageUrl() }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper mySwiper mt-4 gallery-slider">
                    <div class="swiper-wrapper flex justify-center">
                        @foreach($variants as $variant)
                            <div class="swiper-slide cursor-grab !mr-3 !w-[60px] !h-[60px]">
                                <img class="mx-auto rounded-[10px] object-cover w-full h-full"
                                    src="{{ $variant->imageUrl() }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <p class="mt-[44px] text-center text-color-89 text-15 font-Figtree word-breaks font-normal"> {{ __('Want to create images like this in seconds with the help of AI?') }}</p>
            <a href="{{ route('users.registration') }}"
                class="mt-2 text-center underline block text-white text-15 font-Figtree word-breaks font-normal">
                {{ __('Sign up here') }}
            </a>
        </div>
    </div>
</div>

@endsection

@section('child-js')

<script src="{{ asset('public/assets/plugin/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/dist/js/custom/site/share-gallery.min.js')}}"></script>

@endsection
