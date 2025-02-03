<section id="datosNatural" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
    <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">1.1. Tipo de documento de identidad del solicitante</label>
        <select
            name="tipo_documento_natural"
            id="large"
            class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] focus:border-yellow-300"
        >
            <option value="">Selecciona tu documento</option>
            <option value="DNI" {{ old('tipo_documento_natural') == 'DNI' ? 'selected' : '' }}>DNI</option>
            <option value="Carné de extranjería" {{ old('tipo_documento_natural') == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería</option>
            <option value="Pasaporte" {{ old('tipo_documento_natural') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
            <option value="RUC 10" {{ old('tipo_documento_natural') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (de persona natural)</option>
        </select>
    </div>

    <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">Número de documento de identidad del solicitante</label>
        <input
            type="text"
            name="numero_documento_natural"
            class="block col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('numero_documento_natural') }}"
        />
    </div>

    <div class="col-span-6 grid grid-cols-6 mb-6">
        <label class="font-bold col-span-6">1.2. Nombres y apellidos del solicitante</label>
        <div class="col-span-6 grid grid-cols-6 gap-5">
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Nombre</label>
                <input
                    type="text"
                    name="nombre_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('nombre_natural') }}"
                />
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Apellido paterno</label>
                <input
                    type="text"
                    name="apellido_paterno_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('apellido_paterno_natural') }}"
                />
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Apellido materno</label>
                <input
                    type="text"
                    name="apellido_materno_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('apellido_materno_natural') }}"
                />
            </div>
        </div>
    </div>

    <div class="col-span-6 grid grid-cols-6 mb-6">
        <label class="font-bold col-span-6">1.3. Dirección actual</label>
        <div class="col-span-6 grid grid-cols-6 gap-5">
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Departamento</label>
                <input
                    type="text"
                    name="departamento_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('departamento_natural') }}"
                />
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Provincia</label>
                <input
                    type="text"
                    name="provincia_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('provincia_natural') }}"
                />
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Distrito</label>
                <input
                    type="text"
                    name="distrito_natural"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('distrito_natural') }}"
                />
            </div>
        </div>
    </div>

    <div class="col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
        <input
            type="text"
            name="direccion_natural"
            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('direccion_natural') }}"
        />
    </div>
</section>
