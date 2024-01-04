@if(count($useCases) > 0)
<div class="grid 9xl:grid-cols-5 5xl:grid-cols-4 4xl:grid-cols-3 xs:grid-cols-2 grid-cols-1 gap-4 xl:gap-[23px] pb-8">
    @foreach($useCases as $useCase)
    <div class="relative bg-white dark:bg-[#3A3A39] border-design-2 cursor-pointer rounded-xl border border-color-DF dark:border-[#474746] {{ in_array($useCase->id, $userUseCaseFavorites) ? 'favorated' : 'non-favorite' }}" id="{{ $useCase->id }}">
        <a href="{{ route('user.template', $useCase->slug) }}">
            <div class="p-4 xl:p-[30px] xl:pb-6">
                <img class="rounded-full w-12 h-12 neg-transition-scale" src="{{ asset($useCase->fileUrl()) }}" alt="{{ __('Image') }}">
                <p class="text-color-14 dark:text-white font-semibold text-18 mt-7 break-words line-clamp-double">{{ trimWords($useCase->name, 55) }}</p>
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
    @endforeach
</div>
@else
<div class="xl:flex justify-center items-center w-full">
    <p class="text-color-14 dark:text-white font-semibold text-18 mt-7 text-center">{{ __('No templates found.') }}</p>
</div>
@endif
