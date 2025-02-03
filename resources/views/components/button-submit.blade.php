<button
    type="submit"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center px-16 py-2
                    bg-blue-600 border border-transparent
                    rounded-md font-semibold text-white
                    hover:bg-blue-700 active:bg-blue-800
                    transition ease-in-out duration-150'
    ]) }}
>
    {{ $slot }}
</button>
