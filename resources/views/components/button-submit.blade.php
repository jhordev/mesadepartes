<button
    type="submit"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-16 py-2
                    bg-[#007423] hover:bg-green-900 border border-transparent
                    rounded-md font-semibold text-white

                    transition ease-in-out duration-150'
    ]) }}
>
    {{ $slot }}
</button>
