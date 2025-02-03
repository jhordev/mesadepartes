<div class="grid grid-cols-6 mt-[32px]">
    <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">2. Correo electrónico de contacto</label>
        <input
            type="email"
            name="email"
            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('email') }}"
        />
    </div>
    <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">3. Teléfono o celular de contacto</label>
        <input
            type="tel"
            name="telefono"
            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('telefono') }}"
        />
    </div>
</div>
