<section id="datosJuridica" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
    <div class="col-span-6 grid grid-cols-6 mb-12">
        <h2 class="font-bold text-[20px] mb-5 col-span-6">
            Información de la entidad, empresa o institución
        </h2>

        <!-- 1.1 RUC -->
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.1. Ingresa el número de RUC</label>
            <input type="text" name="ruc" id="ruc"
                class="block col-span-6 md:col-span-3 h-[48px]
                       border-2 border-colorBlack rounded-[5px] px-4
                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('ruc') }}" />
            <span id="error_ruc" class="text-red-500 text-sm col-span-6"></span>
        </div>

        <!-- 1.2 Nombre de la Entidad -->
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">
                1.2. Nombre de la entidad, empresa o institución
            </label>
            <input type="text" name="nombre_entidad" id="nombre_entidad"
                class="block col-span-6 md:col-span-3 h-[48px]
                       border-2 border-colorBlack rounded-[5px] px-4
                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('nombre_entidad') }}" />
            <span id="error_nombre_entidad" class="text-red-500 text-sm col-span-6"></span>
        </div>

        <!-- 1.3 Dirección: Departamento, Provincia, Distrito -->
        <div class="col-span-6 grid grid-cols-6 mb-6">
            <label class="font-bold col-span-6">
                1.3. Dirección de la entidad, empresa o institución
            </label>
            <div class="col-span-6 grid grid-cols-6 gap-5">
                <!-- Departamento -->
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Departamento</label>
                    <select name="departamento_juridica" id="departamento_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                        <option value="">Selecciona un departamento</option>
                    </select>
                    <input type="hidden" name="nombre_departamento_juridica" id="nombre_departamento_juridica">
                    <span id="error_departamento_juridica" class="text-red-500 text-sm col-span-6"></span>
                </div>

                <!-- Provincia -->
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Provincia</label>
                    <select name="provincia_juridica" id="provincia_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                        <option value="">Selecciona una provincia</option>
                    </select>
                    <input type="hidden" name="nombre_provincia_juridica" id="nombre_provincia_juridica">
                    <span id="error_provincia_juridica" class="text-red-500 text-sm col-span-6"></span>
                </div>

                <!-- Distrito -->
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Distrito</label>
                    <select name="distrito_juridica" id="distrito_juridica"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                        <option value="">Selecciona un distrito</option>
                    </select>
                    <input type="hidden" name="nombre_distrito_juridica" id="nombre_distrito_juridica">
                    <span id="error_distrito_juridica" class="text-red-500 text-sm col-span-6"></span>
                </div>
            </div>
        </div>

        <!-- 1.4 Dirección (texto) -->
        <div class="col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
            <input type="text" name="direccion_juridica" id="direccion_juridica"
                class="col-span-6 md:col-span-3 h-[48px]
                       border-2 border-colorBlack rounded-[5px] px-4
                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('direccion_juridica') }}" />
            <span id="error_direccion_juridica" class="text-red-500 text-sm col-span-6"></span>
        </div>
    </div>

    <div class="col-span-6 grid grid-cols-6">
        <h2 class="font-bold text-[20px] mb-5 col-span-6">
            Información del representante legal
        </h2>

        <!-- 1.5 Tipo de documento del representante -->
        <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">
                1.5. Tipo de documento de identidad del representante legal
            </label>
            <select name="rep_tipo_documento" id="rep_tipo_documento"
                class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2
                       border-colorBlack rounded-[5px] focus:border-yellow-300">
                <option value="">Selecciona tu documento</option>
                <option value="DNI" {{ old('rep_tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                <option value="Carné de extranjería"
                    {{ old('rep_tipo_documento') == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería
                </option>
                <option value="Pasaporte" {{ old('rep_tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte
                </option>
                <option value="RUC 10" {{ old('rep_tipo_documento') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (persona
                    natural)</option>
            </select>
            <span id="error_rep_tipo_documento" class="text-red-500 text-sm col-span-6"></span>
        </div>

        <!-- 1.5 Número de documento del representante -->
        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
            <label class="font-bold col-span-6">Número de documento de identidad</label>
            <input type="text" name="rep_numero_documento" id="rep_numero_documento"
                class="block col-span-6 md:col-span-3 h-[48px]
                       border-2 border-colorBlack rounded-[5px] px-4
                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                value="{{ old('rep_numero_documento') }}" />
            <span id="error_rep_numero_documento" class="text-red-500 text-sm col-span-6"></span>
        </div>

        <!-- 1.6 Nombres y apellidos del representante -->
        <div class="col-span-6 grid grid-cols-6 mb-6">
            <label class="font-bold col-span-6">
                1.6. Nombres y apellidos del representante legal que realiza el trámite
            </label>
            <div class="col-span-6 grid grid-cols-6 gap-5">
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Nombre</label>
                    <input type="text" name="rep_nombre" id="rep_nombre"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('rep_nombre') }}" />
                    <span id="error_rep_nombre" class="text-red-500 text-sm col-span-6"></span>
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Apellido paterno</label>
                    <input type="text" name="rep_apellido_paterno" id="rep_apellido_paterno"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('rep_apellido_paterno') }}" />
                    <span id="error_rep_apellido_paterno" class="text-red-500 text-sm col-span-6"></span>
                </div>
                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                    <label class="font-bold col-span-6">Apellido materno</label>
                    <input type="text" name="rep_apellido_materno" id="rep_apellido_materno"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                        value="{{ old('rep_apellido_materno') }}" />
                    <span id="error_rep_apellido_materno" class="text-red-500 text-sm col-span-6"></span>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departamentoJuridicaSelect = document.getElementById('departamento_juridica');
        const provinciaJuridicaSelect = document.getElementById('provincia_juridica');
        const distritoJuridicaSelect = document.getElementById('distrito_juridica');

        const inputDepartamentoNombre = document.getElementById('nombre_departamento_juridica');
        const inputProvinciaNombre = document.getElementById('nombre_provincia_juridica');
        const inputDistritoNombre = document.getElementById('nombre_distrito_juridica');

        let listaDepartamentos = [];
        let listaProvincias = [];
        let listaDistritos = [];

        // Cargar Departamentos
        fetch('{{ asset('ubigeo/ubigeo_peru_2016_departamentos.json') }}')
            .then(response => response.json())
            .then(departamentos => {
                listaDepartamentos = departamentos;
                departamentos.forEach(departamento => {
                    const option = document.createElement('option');
                    option.value = departamento.id;
                    option.textContent = departamento.name;
                    departamentoJuridicaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error cargando departamentos (jurídica):', error));

        // Al cambiar Departamento
        departamentoJuridicaSelect.addEventListener('change', function () {
            const selectedDepartamentoId = this.value;
            provinciaJuridicaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
            distritoJuridicaSelect.innerHTML = '<option value="">Selecciona un distrito</option>';
            inputProvinciaNombre.value = '';
            inputDistritoNombre.value = '';

            const departamentoSeleccionado = listaDepartamentos.find(dep => dep.id === selectedDepartamentoId);
            inputDepartamentoNombre.value = departamentoSeleccionado ? departamentoSeleccionado.name : '';

            if (selectedDepartamentoId) {
                fetch('{{ asset('ubigeo/ubigeo_peru_2016_provincias.json') }}')
                    .then(response => response.json())
                    .then(provincias => {
                        listaProvincias = provincias;
                        const filteredProvincias = provincias.filter(
                            provincia => provincia.department_id === selectedDepartamentoId
                        );

                        filteredProvincias.forEach(provincia => {
                            const option = document.createElement('option');
                            option.value = provincia.id;
                            option.textContent = provincia.name;
                            provinciaJuridicaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error cargando provincias (jurídica):', error));
            }
        });

        // Al cambiar Provincia
        provinciaJuridicaSelect.addEventListener('change', function () {
            const selectedProvinciaId = this.value;
            distritoJuridicaSelect.innerHTML = '<option value="">Selecciona un distrito</option>';
            inputDistritoNombre.value = '';

            const provinciaSeleccionada = listaProvincias.find(prov => prov.id === selectedProvinciaId);
            inputProvinciaNombre.value = provinciaSeleccionada ? provinciaSeleccionada.name : '';

            if (selectedProvinciaId) {
                fetch('{{ asset('ubigeo/ubigeo_peru_2016_distritos.json') }}')
                    .then(response => response.json())
                    .then(distritos => {
                        listaDistritos = distritos;
                        const filteredDistritos = distritos.filter(
                            distrito => distrito.province_id === selectedProvinciaId
                        );

                        filteredDistritos.forEach(distrito => {
                            const option = document.createElement('option');
                            option.value = distrito.id;
                            option.textContent = distrito.name;
                            distritoJuridicaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error cargando distritos (jurídica):', error));
            }
        });

        // Al cambiar Distrito
        distritoJuridicaSelect.addEventListener('change', function () {
            const selectedDistritoId = this.value;
            const distritoSeleccionado = listaDistritos.find(dist => dist.id === selectedDistritoId);
            inputDistritoNombre.value = distritoSeleccionado ? distritoSeleccionado.name : '';
        });
    });
</script>
