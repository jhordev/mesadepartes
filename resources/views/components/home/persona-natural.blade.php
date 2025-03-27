<section id="datosNatural" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
    <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">
            1.1. Tipo de documento de identidad del solicitante
        </label>
        <select name="tipo_documento" id="tipo_documento"
            class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] focus:border-yellow-300">
            <option value="">Selecciona tu documento</option>
            <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
            <option value="Carné de extranjería" {{ old('tipo_documento') == 'Carné de extranjería' ? 'selected' : '' }}>
                Carné de extranjería</option>
            <option value="Pasaporte" {{ old('tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
            <option value="RUC 10" {{ old('tipo_documento') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (persona natural)
            </option>
        </select>
        <!-- Error en tiempo real -->
        <span id="error_tipo_documento" class="text-red-500 text-sm col-span-6"></span>
    </div>

    <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">Número de documento de identidad del solicitante</label>
        <input type="text" name="numero_documento" id="numero_documento"
            class="block col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('numero_documento') }}" />
        <!-- Error en tiempo real -->
        <span id="error_numero_documento" class="text-red-500 text-sm col-span-6"></span>
    </div>

    <div class="col-span-6 grid grid-cols-6 mb-6">
        <label class="font-bold col-span-6">1.2. Nombres y apellidos del solicitante</label>
        <div class="col-span-6 grid grid-cols-6 gap-5">
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Nombre</label>
                <input type="text" name="nombre" id="nombre"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('nombre') }}" />
                <span id="error_nombre" class="text-red-500 text-sm col-span-6"></span>
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Apellido paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('apellido_paterno') }}" />
                <span id="error_apellido_paterno" class="text-red-500 text-sm col-span-6"></span>
            </div>
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Apellido materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno"
                    class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                                               focus:outline-none focus:border-yellow-300 focus:rounded-none"
                    value="{{ old('apellido_materno') }}" />
                <span id="error_apellido_materno" class="text-red-500 text-sm col-span-6"></span>
            </div>
        </div>
    </div>

    <div class="col-span-6 grid grid-cols-6 mb-6">
        <label class="font-bold col-span-6">1.3. Dirección actual</label>
        <div class="col-span-6 grid grid-cols-6 gap-5">
            <!-- Departamento -->
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Departamento</label>
                <select name="natural_departamento" id="natural_departamento"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                    <option value="">Selecciona un departamento</option>
                </select>
                <input type="hidden" name="nombre_natural_departamento" id="nombre_natural_departamento">
                <span id="error_natural_departamento" class="text-red-500 text-sm col-span-6"></span>
            </div>

            <!-- Provincia -->
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Provincia</label>
                <select name="natural_provincia" id="natural_provincia"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                    <option value="">Selecciona una provincia</option>
                </select>
                <input type="hidden" name="nombre_natural_provincia" id="nombre_natural_provincia">
                <span id="error_natural_provincia" class="text-red-500 text-sm col-span-6"></span>
            </div>

            <!-- Distrito -->
            <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                <label class="font-bold col-span-6">Distrito</label>
                <select name="natural_distrito" id="natural_distrito"
                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
               focus:outline-none focus:border-yellow-300 focus:rounded-none">
                    <option value="">Selecciona un distrito</option>
                </select>
                <input type="hidden" name="nombre_natural_distrito" id="nombre_natural_distrito">
                <span id="error_natural_distrito" class="text-red-500 text-sm col-span-6"></span>
            </div>
        </div>
    </div>


    <div class="col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
        <input type="text" name="natural_direccion" id="natural_direccion"
            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('natural_direccion') }}" />
        <span id="error_natural_direccion" class="text-red-500 text-sm col-span-6"></span>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departamentoSelect = document.getElementById('natural_departamento');
        const provinciaSelect = document.getElementById('natural_provincia');
        const distritoSelect = document.getElementById('natural_distrito');

        const inputDepartamentoNombre = document.getElementById('nombre_natural_departamento');
        const inputProvinciaNombre = document.getElementById('nombre_natural_provincia');
        const inputDistritoNombre = document.getElementById('nombre_natural_distrito');

        let listaDepartamentos = [];
        let listaProvincias = [];
        let listaDistritos = [];

        // Cargar departamentos
        fetch('{{ asset('ubigeo/ubigeo_peru_2016_departamentos.json') }}')
            .then(response => response.json())
            .then(departamentos => {
                listaDepartamentos = departamentos;
                departamentos.forEach(departamento => {
                    const option = document.createElement('option');
                    option.value = departamento.id;
                    option.textContent = departamento.name;
                    departamentoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error cargando departamentos:', error));

        // Al cambiar departamento
        departamentoSelect.addEventListener('change', function () {
            const selectedDepartamentoId = this.value;
            provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
            distritoSelect.innerHTML = '<option value="">Selecciona un distrito</option>';
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
                            provinciaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error cargando provincias:', error));
            }
        });

        // Al cambiar provincia
        provinciaSelect.addEventListener('change', function () {
            const selectedProvinciaId = this.value;
            distritoSelect.innerHTML = '<option value="">Selecciona un distrito</option>';
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
                            distritoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error cargando distritos:', error));
            }
        });

        // Al cambiar distrito
        distritoSelect.addEventListener('change', function () {
            const selectedDistritoId = this.value;
            const distritoSeleccionado = listaDistritos.find(dist => dist.id === selectedDistritoId);
            inputDistritoNombre.value = distritoSeleccionado ? distritoSeleccionado.name : '';
        });
    });
</script>


