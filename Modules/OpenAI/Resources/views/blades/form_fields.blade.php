@if (!empty($options))
    @foreach ($options as $key => $value)
        @if ($value->type == 'text')
        <div class="relative flex flex-col mt-6">
            <label class="require text-color-14 dark:text-white font-Figtree text-14 font-normal">{{ $value->label }}</label>
            <input
                class="questions dynamic-input w-full px-4 h-12 py-1.5 text-base mt-[3px] leading-6 font-light text-color-14 bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl dark:!text-white focus:bg-white focus:border-color-89 focus:outline-none form-control"
                required oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')"
                placeholder="{{ $value->placeholder }}" type="text"
                data-input-name="{{ $value->key }}"
                maxlength="{{ preference('short_desc_length') }}" name="{{ $value->key }}">
            <p
                class="character-count leading-5 pt-1.5 text-[13px] font-medium text-color-89 text-right text-counterd absolute -bottom-6 right-0">
                0/{{ preference('short_desc_length') }}
            </p>
            <input type="hidden" value="" name="promt" id="promt">
        </div>
        @elseif($value->type == 'textarea')
        <div class="relative flex flex-col mt-6">
            <label class="require text-color-14 dark:text-white font-Figtree text-14 font-normal mb-1.5"
                for="">{{ $value->label }}</label>
            <textarea class="questions dynamic-input peer py-1.5 mt-1.5 text-base overflow-y-scroll middle-sidebar-scroll leading-6 font-light text-color-14 dark:text-white bg-white dark:bg-[#333332] bg-clip-padding bg-no-repeat border border-solid border-color-89 dark:!border-color-47 rounded-xl m-0 focus:text-color-14 focus:bg-white focus:border-color-89 focus:dark:!border-color-47 focus:outline-none min-h-[auto] w-full px-4 outline-none form-control"
            id="exampleFormControlTextarea1" placeholder="{{ $value->placeholder }}"
            maxlength="{{ preference('long_desc_length') }}" required
            oninvalid="this.setCustomValidity('{{ __('This field is required.') }}')" rows="3" placeholder="Your message"
            name="{{ $value->key }}"></textarea>
            <p class="character-count leading-5 text-[13px] font-medium text-color-89 text-right text-counterd absolute -bottom-6 right-0">0/{{ preference('long_desc_length') }}
            </p>
        </div>
        @endif
    @endforeach
@endif

<script src="{{ asset('public/dist/js/custom/validation.min.js') }}"></script>
