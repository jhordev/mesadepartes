@extends('layouts.app')

@section('content')
    <div class="mt-10 container max-w-[1050px] px-5 lg:px-0 mx-auto ">
        <section class="flex flex-col gap-4 mb-4">
            <h1 class="font-bold text-[30px]  md:text-[36px]">Mesa de partes</h1>
            <div class="ml-5 lg:m-0 text-[20px]">
                <p>
                    ¡Hola! Revisa la <strong>fecha de recepción de tus documentos</strong>, según lo establecido en el artículo
                    46.2 del <a href="https://www.gob.pe/institucion/pcm/normas-legales/4440731-075-2023-pcm"
                                class="text-blue-600" target="_blank">Decreto Supremo N.°075-2023-PCM</a>:
                </p>
                <ul class="space-y-1 list-disc list-inside">
                    <li>Horario de atención: de lunes a viernes, de 08:00 a.m. a 01:00 p.m. y de 02:30 p.m. a 05:30 p.m.</li>
                    <li>Después de las 5:30 p.m. hasta las 11:59 p.m: cuentan desde el día hábil siguiente.</li>
                    <li>Los sábados, domingos, feriados o cualquier otro día no hábil: cuentan desde el día hábil siguiente.
                    </li>
                </ul>
                <p>Para más información, comunícate con nosotros:</p>
                <ul class="space-y-1 list-disc list-inside">
                    <li>Teléfono: 067 – 451373 (solo en este horario: Mañanas : 08:30 a.m. – 01:00 p.m. – Tardes : 02:30 p.m. – 5:30 p.m.)</li>
                    <li>Correo: drahvca0407@gmail.com</li>
                    <li>RUC: 20443619811</li>
                    <li>Dirección: Av.Augusto B.Leguía N°171-Huancavelica,Peru.</li>
                </ul>
            </div>
        </section>

        <section class="bg-colorAthensGray my-[32px] p-[32px] rounded-[5px]">
            <h2 class="text-[20px] font-bold mb-4">Información del solicitante</h2>

            {{-- Enviamos al método store() del ExpedientesController --}}
            <form action="{{ route('expedientes.store') }}" id="formulario" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="ml-5">
                    <label class="font-bold">1. Persona natural o jurídica</label>
                    <div class="flex flex-col gap-1 mt-4">
                        <label class="flex w-fit items-center gap-2">
                            <input
                                type="radio"
                                name="tipo_solicitante"
                                value="Natural"
                                class="cursor-pointer"
                                onchange="toggleSections()"
                                {{ old('tipo_solicitante') == 'Natural' ? 'checked' : '' }}
                                required
                            >
                            <span>Persona natural</span>
                        </label>
                        <label class="flex w-fit items-center gap-2">
                            <input
                                type="radio"
                                name="tipo_solicitante"
                                value="Juridica"
                                class="cursor-pointer"
                                onchange="toggleSections()"
                                {{ old('tipo_solicitante') == 'Juridica' ? 'checked' : '' }}
                                required
                            >
                            <span>Persona jurídica</span>
                        </label>
                    </div>

                    <div>
                        {{-- Sección: persona natural --}}

                        @include('components.home.persona-natural')



                        @include('components.home.persona-juridica')

                        {{-- Información de contacto común (Natural o Jurídica) --}}
                        <div id="infonatural" class="hidden grid grid-cols-6 mt-[32px]">
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">2. Correo electrónico de contacto</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('email') }}"
                                />
                                <span id="error_email" class="text-red-500 text-sm col-span-6"></span>
                            </div>
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">3. Teléfono o celular de contacto</label>
                                <input
                                    type="tel"
                                    name="telefono"
                                    id="telefono"
                                    class="col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('telefono') }}"
                                />
                                <span id="error_telefono" class="text-red-500 text-sm col-span-6"></span>
                            </div>
                        </div>

                        <div id="infojuridica" class="hidden grid grid-cols-6 mt-[32px]">
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">2. Correo electrónico de contacto</label>
                                <input
                                    type="email"
                                    name="rep_email"
                                    id="rep_email"
                                    class="col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('rep_email') }}"
                                />
                                <span id="error_rep_email" class="text-red-500 text-sm col-span-6"></span>
                            </div>
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">3. Teléfono o celular de contacto</label>
                                <input
                                    type="tel"
                                    name="rep_telefono"
                                    id="rep_telefono"
                                    class="col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('rep_telefono') }}"
                                />
                                <span id="error_rep_telefono" class="text-red-500 text-sm col-span-6"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información del trámite (asunto, descripción) --}}
                <section class="mt-[32px]">
                    <div class="mb-[32px]">
                        <h2 class="font-bold text-[20px] mb-4">Descripción de la solicitud o trámite</h2>
                        <div class="ml-5">
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">4. Asunto de la solicitud o trámite</label>
                                <input
                                    type="text"
                                    name="asunto"
                                    id="asunto"
                                    class="col-span-6 md:col-span-3 h-[48px]
                                       border-2 border-colorBlack rounded-[5px] px-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('asunto') }}"
                                />
                                <span id="error_asunto" class="text-red-500 text-sm col-span-6"></span>
                            </div>
                            <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">5. Descripción de la solicitud o trámite</label>
                                <textarea
                                    name="descripcion"
                                    id="descripcion"
                                    class="h-[100px] md:h-[150px] col-span-6
                                       border-2 border-colorBlack rounded-[5px] px-4 py-4
                                       focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                >{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Documentos de sustento --}}
                    <h2 class="font-bold text-[20px] mb-4">Documentos de sustento (opcional)</h2>
                    <div class="ml-5">
                        <label class="font-bold">6. Adjunta los documentos que sustenten tu solicitud</label>
                        <p class="my-2">
                            Solo se aceptan formatos jpg, jpeg, png, pdf, doc, docx, txt, xls, xlsx, xlsm, csv
                            <strong class="block">Peso total máximo: 10 MB.</strong>
                        </p>
                        <div class="flex items-center justify-center w-full col-span-6">
                            <label
                                for="dropzone-file"
                                id="dropzone-label"
                                class="flex flex-col items-center justify-center w-full h-50
                                   border-2 border-gray-300 border-dashed rounded-lg cursor-pointer
                                   bg-white hover:bg-gray-100"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg
                                        class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 20 16"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                                           5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5
                                           a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                        />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PDF, DOC, XLS, ZIP, JPG, MP3, MP4, etc.
                                    </p>
                                </div>
                                <input
                                    id="dropzone-file"
                                    name="documentos[]"
                                    type="file"
                                    multiple
                                    class="hidden"
                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt,.xls,.xlsx,.xlsm,.csv,.rar,.zip,.mp3,.wma,.mp4,.wmv"
                                />
                            </label>
                        </div>
                        <!-- Contenedor para la lista de archivos seleccionados -->
                        <div id="filesContainer" class="mt-4 space-y-2"></div>

                        <!-- Campo para link de descarga (si supera 10 MB) -->
                        <div class="mt-[32px] mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">
                                7. Si tus archivos pesan más de 10 MB, puedes dejarnos un link de descarga
                            </label>
                            <input
                                type="text"
                                name="link_descarga"
                                id="link_descarga"
                                class="col-span-6 md:col-span-3 h-[48px]
                                   border-2 border-colorBlack rounded-[5px] px-4
                                   focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('link_descarga') }}"
                            />
                        </div>
                    </div>
                </section>

                <!-- Políticas -->
                <div class="mb-[32px]">
                    <div class="flex items-center mb-4">
                        <input
                            id="politica_privacidad"
                            type="checkbox"
                            name="politica_privacidad"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                            required
                        />
                        <label for="politica_privacidad" class="text-[16px] ml-2">
                            Acepto
                            <a href="" target="_blank" class="text-colorBlue">
                                la política de privacidad
                            </a>
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="declaracion_jurada"
                            type="checkbox"
                            name="declaracion_jurada"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                            required
                        />
                        <label for="declaracion_jurada" class="text-[16px] ml-2">
                            Acepto
                            <a
                                href="https://facilita.gob.pe/Declaraci%C3%B3n%20Jurada%20de%20Veracidad%20Informaci%C3%B3n%20-FACILITA_12.10.23.pdf"
                                target="_blank"
                                class="text-colorBlue"
                            >
                                la declaración jurada de veracidad de la información
                            </a>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button-submit>
                        Enviar
                    </x-button-submit>
                </div>
            </form>
        </section>

        @include('components.dialog-expedediente')
    </div>

    {{-- Mostrar pop-up con número y clave si se ha registrado con éxito --}}
    @if(session('numeroExpediente') && session('claveExpediente'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('expediente-numero').innerText = '{{ session('numeroExpediente') }}';
                document.getElementById('expediente-clave').innerText = '{{ session('claveExpediente') }}';
                document.getElementById('dialog-confirmation').classList.remove('hidden');
            });
            function closeDialog() {
                document.getElementById('dialog-confirmation').classList.add('hidden');
            }
        </script>
    @endif

    {{-- Script para alternar secciones Natural/Jurídica --}}
    <script>
        function toggleSections() {
            const tipoPersona = document.querySelector('input[name="tipo_solicitante"]:checked')?.value;
            const datosNatural = document.getElementById('datosNatural');
            const infoNatural = document.getElementById('infonatural');
            const datosJuridica = document.getElementById('datosJuridica');
            const infoJuridica = document.getElementById('infojuridica');

            const camposNatural = [
                'tipo_documento',
                'numero_documento',
                'nombre',
                'apellido_paterno',
                'apellido_materno',
                'natural_departamento',
                'natural_provincia',
                'natural_distrito',
                'natural_direccion',
                'email',
                'telefono',
                'asunto',
                'descripcion',
                'dropzone-file', // archivos
                'link_descarga'
            ];

            const camposJuridica = [
                'ruc',
                'nombre_entidad',
                'departamento_juridica',
                'provincia_juridica',
                'distrito_juridica',
                'direccion_juridica',
                'rep_tipo_documento',
                'rep_numero_documento',
                'rep_nombre',
                'rep_apellido_paterno',
                'rep_apellido_materno',
                'rep_email',
                'rep_telefono',
                'asunto',
                'descripcion',
                'dropzone-file', // archivos
                'link_descarga'
            ];

            if (tipoPersona === 'Natural') {
                datosNatural.classList.remove('hidden');
                datosJuridica.classList.add('hidden');
                infoNatural.classList.remove('hidden');
                infoJuridica.classList.add('hidden');

                // Required a Natural
                camposNatural.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) field.required = true;
                });
                // Quitar required a Jurídica
                camposJuridica.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) field.required = false;
                });

            } else if (tipoPersona === 'Juridica') {
                datosNatural.classList.add('hidden');
                datosJuridica.classList.remove('hidden');
                infoNatural.classList.add('hidden');
                infoJuridica.classList.remove('hidden');

                // Required a Jurídica
                camposJuridica.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) field.required = true;
                });
                // Quitar required a Natural
                camposNatural.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) field.required = false;
                });
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            toggleSections();
        });
    </script>

    {{-- Script para manejo de arrastre/selección de archivos --}}
    <script>
        let selectedFiles = [];
        const fileInput = document.getElementById('dropzone-file');
        const filesContainer = document.getElementById('filesContainer');
        const labelZone = document.getElementById('dropzone-label');

        fileInput.addEventListener('change', () => {
            const files = Array.from(fileInput.files);
            selectedFiles = selectedFiles.concat(files);
            renderFilesList();
        });

        labelZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            labelZone.classList.add('bg-gray-100');
        });
        labelZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            labelZone.classList.remove('bg-gray-100');
        });
        labelZone.addEventListener('drop', (e) => {
            e.preventDefault();
            labelZone.classList.remove('bg-gray-100');
            const droppedFiles = Array.from(e.dataTransfer.files);
            selectedFiles = selectedFiles.concat(droppedFiles);
            renderFilesList();
        });

        function renderFilesList() {
            filesContainer.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const fileSizeKB = (file.size / 1024).toFixed(2);

                const card = document.createElement('div');
                card.className = 'flex items-center justify-between bg-white px-3 py-4 rounded-md shadow';
                card.innerHTML = `
                    <div class="flex items-center w-5/6 space-x-2">
                        <span class="text-sm font-medium truncate">${file.name}</span>
                        <span class="text-xs text-gray-500">(${fileSizeKB} KB)</span>
                    </div>
                    <button
                        type="button"
                        class="text-red-500 hover:text-red-700 remove-file"
                        data-index="${index}"
                        title="Eliminar archivo"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0 1
                                    16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5
                                    4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0
                                    0-1 1v3m-4 0h14"
                            />
                        </svg>
                    </button>
                `;
                filesContainer.appendChild(card);
            });

            filesContainer.querySelectorAll('.remove-file').forEach(btn => {
                btn.addEventListener('click', removeFile);
            });
        }

        function removeFile(event) {
            const index = parseInt(event.currentTarget.getAttribute('data-index'));
            selectedFiles.splice(index, 1);
            renderFilesList();
        }
    </script>

    {{-- Script de validaciones en tiempo real (mostrando mensajes bajo cada input) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoDoc = document.getElementById('tipo_documento');
            const numDoc = document.getElementById('numero_documento');
            const errorNumDoc = document.getElementById('error_numero_documento');

            const repTipoDoc = document.getElementById('rep_tipo_documento');
            const repNumDoc = document.getElementById('rep_numero_documento');
            const errorRepNumDoc = document.getElementById('error_rep_numero_documento');

            const form = document.getElementById('formulario'); // Asegúrate de tener este ID en el <form>

            function getRequiredLengthFor(type) {
                switch (type) {
                    case 'DNI': return 8;
                    case 'Carné de extranjería': return 9;
                    case 'Pasaporte': return 7;
                    case 'RUC 10': return 10;
                    default: return null;
                }
            }

            function validarCampoDocumento(input, tipoInput, errorLabel) {
                const valor = input.value.trim();
                const docType = tipoInput.value;
                const requiredLen = getRequiredLengthFor(docType);
                errorLabel.textContent = '';

                if (!valor) {
                    errorLabel.textContent = 'Este campo es obligatorio';
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }
                if (!/^[0-9]+$/.test(valor)) {
                    errorLabel.textContent = 'Solo se permiten números';
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }
                if (requiredLen && valor.length !== requiredLen) {
                    switch (docType) {
                        case 'DNI': errorLabel.textContent = 'El número de DNI debe tener 8 dígitos'; break;
                        case 'Carné de extranjería': errorLabel.textContent = 'El carné de extranjería debe tener 9 dígitos'; break;
                        case 'Pasaporte': errorLabel.textContent = 'El pasaporte debe tener 7 dígitos'; break;
                        case 'RUC 10': errorLabel.textContent = 'El RUC debe tener 10 dígitos'; break;
                    }
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }
                return true;
            }

            numDoc.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
                validarCampoDocumento(numDoc, tipoDoc, errorNumDoc);
            });
            tipoDoc.addEventListener('change', () => validarCampoDocumento(numDoc, tipoDoc, errorNumDoc));

            if (repNumDoc && repTipoDoc) {
                repNumDoc.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '');
                    validarCampoDocumento(repNumDoc, repTipoDoc, errorRepNumDoc);
                });
                repTipoDoc.addEventListener('change', () => validarCampoDocumento(repNumDoc, repTipoDoc, errorRepNumDoc));
            }

            // -------- VALIDACIÓN ANTES DE ENVIAR --------
            form.addEventListener('submit', function (e) {
                const visibleNatural = tipoDoc && tipoDoc.offsetParent !== null;
                const visibleJuridica = repTipoDoc && repTipoDoc.offsetParent !== null;

                let esValido = true;

                if (visibleNatural) {
                    if (!validarCampoDocumento(numDoc, tipoDoc, errorNumDoc)) {
                        esValido = false;
                    }
                }

                if (visibleJuridica) {
                    if (!validarCampoDocumento(repNumDoc, repTipoDoc, errorRepNumDoc)) {
                        esValido = false;
                    }
                }

                if (!esValido) {
                    e.preventDefault();
                }
            });

            // -------- VALIDACIONES EXTRA --------
            const telefono = document.getElementById('telefono');
            const errorTelefono = document.getElementById('error_telefono');
            if (telefono) {
                telefono.addEventListener('input', function () {
                    errorTelefono.textContent = '';
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value && this.value.length !== 9) {
                        errorTelefono.textContent = 'El teléfono debe tener 9 dígitos';
                    }
                });
            }

            const email = document.getElementById('email');
            const errorEmail = document.getElementById('error_email');
            if (email) {
                email.addEventListener('input', function () {
                    errorEmail.textContent = '';
                    if (this.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value)) {
                        errorEmail.textContent = 'Ingrese un correo electrónico válido';
                    }
                });
            }

            const repTelefono = document.getElementById('rep_telefono');
            const errorRepTelefono = document.getElementById('error_rep_telefono');
            if (repTelefono) {
                repTelefono.addEventListener('input', function () {
                    errorRepTelefono.textContent = '';
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value && this.value.length !== 9) {
                        errorRepTelefono.textContent = 'El teléfono debe tener 9 dígitos';
                    }
                });
            }

            const repEmail = document.getElementById('rep_email');
            const errorRepEmail = document.getElementById('error_rep_email');
            if (repEmail) {
                repEmail.addEventListener('input', function () {
                    errorRepEmail.textContent = '';
                    if (this.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value)) {
                        errorRepEmail.textContent = 'Ingrese un correo electrónico válido';
                    }
                });
            }

            const rucInput = document.getElementById('ruc');
            const errorRuc = document.getElementById('error_ruc');
            if (rucInput) {
                rucInput.addEventListener('input', function () {
                    errorRuc.textContent = '';
                    this.value = this.value.replace(/\D/g, '');
                    if (!this.value) {
                        errorRuc.textContent = 'Este campo es obligatorio';
                    }
                });
            }

            const bindObligatorio = (idCampo, idError) => {
                const campo = document.getElementById(idCampo);
                const error = document.getElementById(idError);
                if (campo && error) {
                    campo.addEventListener('input', function () {
                        error.textContent = '';
                        if (!this.value) {
                            error.textContent = 'Este campo es obligatorio';
                        }
                    });
                }
            };

            const campos = [
                ['nombre', 'error_nombre'],
                ['apellido_paterno', 'error_apellido_paterno'],
                ['apellido_materno', 'error_apellido_materno'],
                ['natural_departamento', 'error_natural_departamento'],
                ['natural_provincia', 'error_natural_provincia'],
                ['natural_distrito', 'error_natural_distrito'],
                ['natural_direccion', 'error_natural_direccion'],
                ['nombre_entidad', 'error_nombre_entidad'],
                ['departamento_juridica', 'error_departamento_juridica'],
                ['provincia_juridica', 'error_provincia_juridica'],
                ['distrito_juridica', 'error_distrito_juridica'],
                ['direccion_juridica', 'error_direccion_juridica'],
                ['rep_nombre', 'error_rep_nombre'],
                ['rep_apellido_paterno', 'error_rep_apellido_paterno'],
                ['rep_apellido_materno', 'error_rep_apellido_materno'],
            ];

            campos.forEach(([campo, error]) => bindObligatorio(campo, error));
        });
    </script>


@endsection
