<section id="datosJuridica" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
    <div class="col-span-6 grid grid-cols-6 mb-12">
        <h2 class="font-bold text-[20px] mb-5 col-span-6">Información de la entidad, empresa o institución</h2>
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.1. Ingresa el número de RUC</label>
            <input
                type="text"
                name="numero_ruc"
                class="block col-span-6  md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('numero_ruc') }}"
            />
        </div>
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.2. Nombre de la entidad, empresa o institución</label>
            <input
                type="text"
                name="nombre_entidad"
                class="block col-span-6  md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('nombre_entidad') }}"
            />
        </div>

        <div class="col-span-6 grid grid-cols-6 mb-6">
            <label class="font-bold col-span-6">1.3. Dirección de la entidad, empresa o institución</label>
            <div class="col-span-6 grid grid-cols-6 gap-5">
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Departamento</label>
                    <input
                        type="text"
                        name="departamento_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('departamento_juridica') }}"
                    />
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Provincia</label>
                    <input
                        type="text"
                        name="provincia_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('provincia_juridica') }}"
                    />
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Distrito</label>
                    <input
                        type="text"
                        name="distrito_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('distrito_juridica') }}"
                    />
                </div>
            </div>
        </div>

        <div class="col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
            <input
                type="text"
                name="direccion_juridica"
                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('direccion_juridica') }}"
            />
        </div>
    </div>

    <div class="col-span-6 grid grid-cols-6">
        <h2 class="font-bold text-[20px] mb-5 col-span-6">Información del representante legal</h2>
        <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.5. Tipo de documento de identidad del representante legal que realiza el trámite</label>
            <select
                name="tipo_documento_representante"
                id="large"
                class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] focus:border-yellow-300"
            >
                <option value="">Selecciona tu documento</option>
                <option value="DNI" {{ old('tipo_documento_representante') == 'DNI' ? 'selected' : '' }}>DNI</option>
                <option value="Carné de extranjería" {{ old('tipo_documento_representante') == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería</option>
                <option value="Pasaporte" {{ old('tipo_documento_representante') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                <option value="RUC 10" {{ old('tipo_documento_representante') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (de persona natural)</option>
            </select>
        </div>
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">Número de documento de identidad</label>
            <input
                type="text"
                name="numero_documento_representante"
                class="block col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('numero_documento_representante') }}"
            />
        </div>

        <div class="col-span-6 grid grid-cols-6 mb-6">
            <label class="font-bold col-span-6">1.6. Nombres y apellidos del representante legal que realiza el trámite</label>
            <div class="col-span-6 grid grid-cols-6 gap-5">
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Nombre</label>
                    <input
                        type="text"
                        name="nombre_representante"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('nombre_representante') }}"
                    />
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Apellido paterno</label>
                    <input
                        type="text"
                        name="apellido_paterno_representante"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('apellido_paterno_representante') }}"
                    />
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Apellido materno</label>
                    <input
                        type="text"
                        name="apellido_materno_representante"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('apellido_materno_representante') }}"
                    />
                </div>
            </div>
        </div>
    </div>
</section>
