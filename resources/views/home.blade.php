@extends('layouts.app')

@section('content')
    <section class="flex flex-col gap-4 mb-4">
        <h1 class="font-bold text-[30px]  md:text-[36px]">Mesa de partes</h1>
        <div class="ml-5 lg:m-0">
            <p>
                ¡Hola! Revisa la <strong>fecha de recepción de tus documentos</strong>, según lo establecido en el artículo
                46.2 del <a href="https://www.gob.pe/institucion/pcm/normas-legales/4440731-075-2023-pcm"
                            class="text-blue-600" target="_blank">Decreto Supremo N.°075-2023-PCM</a>:
            </p>
            <ul class="space-y-1 list-disc list-inside">
                <li>Desde las 08:00 horas hasta las 17:00 cuentan como recibidos el mismo día.</li>
                <li>Después de las 17:01 hasta las 23:59 horas: cuentan desde el día hábil siguiente.</li>
                <li>Los sábados, domingos, feriados o cualquier otro día no hábil: cuentan desde el día hábil siguiente.
                </li>
            </ul>
            <p>Para más información, comunícate con nosotros:</p>
            <ul class="space-y-1 list-disc list-inside">
                <li>Teléfono: 939602189 (solo en este horario: Mañanas : 08:30 a.m. – 01:00 p.m. – Tardes : 02:30 p.m. –
                    05:15 p.m.)
                </li>
                <li>Correo: tramitedocumentario@unh.edu.pe</li>
            </ul>
        </div>
    </section>

    <section class="bg-colorAthensGray my-[32px] p-[32px] rounded-[5px]">
        <h2 class="text-[20px] font-bold mb-4">Información del solicitante</h2>

        {{-- IMPORTANTE: Ajustamos la acción para apuntar al método store de ExpedientesController --}}
        <form action="{{ route('expedientes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="ml-5">
                <label class="font-bold">1. Persona natural o jurídica</label>
                <div class="flex flex-col gap-1 mt-4">
                    <label class="flex w-fit items-center gap-2">
                        {{-- En vez de persona_tipo, usamos "tipo_solicitante" con valor "Natural" --}}
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
                        {{-- En vez de persona_tipo, usamos "tipo_solicitante" con valor "Juridica" --}}
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
                    <section id="datosNatural" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
                        <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">1.1. Tipo de documento de identidad del solicitante</label>
                            {{-- El store() espera "tipo_documento" para persona natural --}}
                            <select
                                name="tipo_documento"
                                id="tipo_documento"
                                class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] focus:border-yellow-300"
                            >
                                <option value="">Selecciona tu documento</option>
                                <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                <option value="Carné de extranjería" {{ old('tipo_documento') == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería</option>
                                <option value="Pasaporte" {{ old('tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                <option value="RUC 10" {{ old('tipo_documento') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (persona natural)</option>
                            </select>
                        </div>

                        <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">Número de documento de identidad del solicitante</label>
                            {{-- El store() espera "numero_documento" --}}
                            <input
                                type="text"
                                name="numero_documento"
                                id="numero_documento"
                                class="block col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('numero_documento') }}"
                            />
                        </div>

                        <div class="col-span-6 grid grid-cols-6 mb-6">
                            <label class="font-bold col-span-6">1.2. Nombres y apellidos del solicitante</label>
                            <div class="col-span-6 grid grid-cols-6 gap-5">
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Nombre</label>
                                    {{-- El store() espera "nombre" --}}
                                    <input
                                        type="text"
                                        name="nombre"
                                        id="nombre"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('nombre') }}"
                                    />
                                </div>
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Apellido paterno</label>
                                    {{-- El store() espera "apellido_paterno" --}}
                                    <input
                                        type="text"
                                        name="apellido_paterno"
                                        id="apellido_paterno"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('apellido_paterno') }}"
                                    />
                                </div>
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Apellido materno</label>
                                    {{-- El store() espera "apellido_materno" --}}
                                    <input
                                        type="text"
                                        name="apellido_materno"
                                        id="apellido_materno"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('apellido_materno') }}"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-6 mb-6">
                            <label class="font-bold col-span-6">1.3. Dirección actual</label>
                            <div class="col-span-6 grid grid-cols-6 gap-5">
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Departamento</label>
                                    {{-- El store() espera "departamento" --}}
                                    <input
                                        type="text"
                                        name="natural_departamento"
                                        id="natural_departamento"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('departamento') }}"
                                    />
                                </div>
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Provincia</label>
                                    {{-- El store() espera "provincia" --}}
                                    <input
                                        type="text"
                                        name="natural_provincia"
                                        id="natural_provincia"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('natural_provincia') }}"
                                    />
                                </div>
                                <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                    <label class="font-bold col-span-6">Distrito</label>
                                    {{-- El store() espera "distrito" --}}
                                    <input
                                        type="text"
                                        name="natural_distrito"
                                        id="natural_distrito"
                                        class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                        value="{{ old('natural_distrito') }}"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
                            {{-- El store() espera "direccion" --}}
                            <input
                                type="text"
                                name="natural_direccion"
                                id="natural_direccion"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('natural_direccion') }}"
                            />
                        </div>
                    </section>

                    {{-- Sección: persona jurídica --}}
                    <section id="datosJuridica" class="bg-colorGrayOpacity p-6 hidden grid grid-cols-6">
                        <div class="col-span-6 grid grid-cols-6 mb-12">
                            <h2 class="font-bold text-[20px] mb-5 col-span-6">Información de la entidad, empresa o institución</h2>
                            <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">1.1. Ingresa el número de RUC</label>
                                {{-- El store() espera "ruc" --}}
                                <input
                                    type="text"
                                    name="ruc"
                                    id="ruc"
                                    class="block col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('ruc') }}"
                                />
                            </div>
                            <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">1.2. Nombre de la entidad, empresa o institución</label>
                                {{-- El store() espera "nombre_entidad" --}}
                                <input
                                    type="text"
                                    name="nombre_entidad"
                                    id="nombre_entidad"
                                    class="block col-span-6  md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('nombre_entidad') }}"
                                />
                            </div>


                            <div class="col-span-6 grid grid-cols-6 mb-6">
                                <label class="font-bold col-span-6">1.3. Dirección de la entidad, empresa o institución</label>
                                <div class="col-span-6 grid grid-cols-6 gap-5">
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Departamento</label>
                                        {{-- El store() espera "departamento" --}}
                                        <input
                                            type="text"
                                            name="departamento_juridica"
                                            id="departamento_juridica"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('departamento') }}"
                                        />
                                    </div>
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Provincia</label>
                                        {{-- El store() espera "provincia" --}}
                                        <input
                                            type="text"
                                            name="provincia_juridica"
                                            id="provincia_juridica"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('provincia') }}"
                                        />
                                    </div>
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Distrito</label>
                                        {{-- El store() espera "distrito" --}}
                                        <input
                                            type="text"
                                            name="distrito_juridica"
                                            id="distrito_juridica"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('distrito') }}"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">1.4. Escribe la dirección</label>
                                {{-- El store() espera "direccion" --}}
                                <input
                                    type="text"
                                    name="direccion_juridica"
                                    id="direccion_juridica"
                                    class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('direccion') }}"
                                />
                            </div>
                        </div>

                        <div class="col-span-6 grid grid-cols-6">
                            <h2 class="font-bold text-[20px] mb-5 col-span-6">Información del representante legal</h2>
                            <div class="mb-2 col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">1.5. Tipo de documento de identidad del representante legal que realiza el trámite</label>
                                {{-- El store() espera "rep_tipo_documento" --}}
                                <select
                                    name="rep_tipo_documento"
                                    id="rep_tipo_documento"
                                    class="mb-4 col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] focus:border-yellow-300"
                                >
                                    <option value="">Selecciona tu documento</option>
                                    <option value="DNI" {{ old('rep_tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    <option value="Carné de extranjería" {{ old('rep_tipo_documento') == 'Carné de extranjería' ? 'selected' : '' }}>Carné de extranjería</option>
                                    <option value="Pasaporte" {{ old('rep_tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                    <option value="RUC 10" {{ old('rep_tipo_documento') == 'RUC 10' ? 'selected' : '' }}>RUC 10 (persona natural)</option>
                                </select>
                            </div>
                            <div class="mb-6 col-span-6 grid grid-cols-6 gap-2">
                                <label class="font-bold col-span-6">Número de documento de identidad</label>
                                {{-- El store() espera "rep_numero_documento" --}}
                                <input
                                    type="text"
                                    name="rep_numero_documento"
                                    id="rep_numero_documento"
                                    class="block col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                    value="{{ old('rep_numero_documento') }}"
                                />
                            </div>

                            <div class="col-span-6 grid grid-cols-6 mb-6">
                                <label class="font-bold col-span-6">1.6. Nombres y apellidos del representante legal que realiza el trámite</label>
                                <div class="col-span-6 grid grid-cols-6 gap-5">
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Nombre</label>
                                        {{-- El store() espera "rep_nombre" --}}
                                        <input
                                            type="text"
                                            name="rep_nombre"
                                            id="rep_nombre"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('rep_nombre') }}"
                                        />
                                    </div>
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Apellido paterno</label>
                                        {{-- El store() espera "rep_apellido_paterno" --}}
                                        <input
                                            type="text"
                                            name="rep_apellido_paterno"
                                            id="rep_apellido_paterno"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('rep_apellido_paterno') }}"
                                        />
                                    </div>
                                    <div class="mt-3 col-span-6 md:col-span-2 grid grid-cols-6 gap-2">
                                        <label class="font-bold col-span-6">Apellido materno</label>
                                        {{-- El store() espera "rep_apellido_materno" --}}
                                        <input
                                            type="text"
                                            name="rep_apellido_materno"
                                            id="rep_apellido_materno"
                                            class="col-span-6 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                            value="{{ old('rep_apellido_materno') }}"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Información de contacto (email, teléfono) - Esto aplica para ambos casos --}}
                    <div id="infonatural" class="hidden grid grid-cols-6 mt-[32px]">
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">2. Correo electrónico de contacto</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('email') }}"
                            />
                        </div>
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">3. Teléfono o celular de contacto</label>
                            <input
                                type="tel"
                                name="telefono"
                                id="telefono"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('telefono') }}"
                            />
                        </div>
                    </div>
                    <div id="infojuridica" class="hidden grid grid-cols-6 mt-[32px]">
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">2. Correo electrónico de contacto</label>
                            <input
                                type="email"
                                name="rep_email"
                                id="rep_email"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('rep_email') }}"
                            />
                        </div>
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">3. Teléfono o celular de contacto</label>
                            <input
                                type="tel"
                                name="rep_telefono"
                                id="rep_telefono"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('rep_telefono') }}"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Información del trámite (asunto, descripción) --}}
            <section class="mt-[32px]">
                <!-- Asunto y Descripción -->
                <div class="mb-[32px]">
                    <h2 class="font-bold text-[20px] mb-4">Descripción de la solicitud o trámite</h2>
                    <div class="ml-5">
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">4. Asunto de la solicitud o trámite</label>
                            {{-- El store() espera "asunto" --}}
                            <input
                                type="text"
                                name="asunto"
                                id="asunto"
                                class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                                value="{{ old('asunto') }}"
                            />
                        </div>
                        <div class="mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                            <label class="font-bold col-span-6">5. Descripción de la solicitud o trámite</label>
                            {{-- El store() espera "descripcion" --}}
                            <textarea
                                name="descripcion"
                                id="descripcion"
                                class="h-[100px] md:h-[150px] col-span-6 border-2 border-colorBlack rounded-[5px] px-4 py-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
                            >{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Documentos de sustento --}}
                <h2 class="font-bold text-[20px] mb-4">Descripción de la solicitud o trámite</h2>
                <div class="ml-5">
                    <label class="font-bold">6. Adjunta los documentos que sustenten tu solicitud</label>
                    <p class="my-2">
                        Solo se aceptan formatos jpg, jpeg, png, tif, bmp, pdf, doc, docx, txt, xls, xlsx, xlsm, csv, rar, zip, mp3, wma, mp4 y wmv.
                        <strong class="block">Peso total máximo: 10 MB.</strong>
                    </p>
                    <div class="flex items-center justify-center w-full col-span-6">
                        <label
                            for="dropzone-file"
                            id="dropzone-label"
                            class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100"
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
                            {{-- El store() espera los archivos en "documentos[]" --}}
                            <input
                                id="dropzone-file"
                                name="documentos[]"
                                type="file"
                                multiple
                                class="hidden"
                                accept=".jpg,.jpeg,.png,.tif,.bmp,.pdf,.doc,.docx,.txt,.xls,.xlsx,.xlsm,.csv,.rar,.zip,.mp3,.wma,.mp4,.wmv"
                            />
                        </label>
                    </div>

                    <!-- Contenedor para la lista de archivos seleccionados -->
                    <div id="filesContainer" class="mt-4 space-y-2"></div>

                    <!-- Campo para link de descarga (si supera 10 MB) -->
                    <div class="mt-[32px] mb-[32px] col-span-6 grid grid-cols-6 gap-2">
                        <label class="font-bold col-span-6">7. Si tus archivos pesan más de 10 MB, puedes dejarnos un link de descarga</label>
                        {{-- El store() espera "link_descarga" --}}
                        <input
                            type="text"
                            name="link_descarga"
                            id="link_descarga"
                            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:outline-none focus:border-yellow-300 focus:rounded-none"
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


    <script>
        function toggleSections() {
            const tipoPersona = document.querySelector('input[name="tipo_solicitante"]:checked')?.value;
            const datosNatural = document.getElementById('datosNatural');
            const infoNatural = document.getElementById('infonatural');
            const datosJuridica = document.getElementById('datosJuridica');
            const infoJuridica = document.getElementById('infojuridica');

            // Arrays con los IDs de los campos para cada tipo
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
                'documentos[]',
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
                'documentos[]',
                'link_descarga'
            ];

            if (tipoPersona === 'Natural') {
                datosNatural.classList.remove('hidden');
                datosJuridica.classList.add('hidden');
                infoNatural.classList.remove('hidden');
                infoJuridica.classList.add('hidden');

                // Agregar 'required' a los campos de Persona Natural
                camposNatural.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.required = true;
                    }
                });

                // Remover 'required' de los campos de Persona Jurídica
                camposJuridica.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.required = false;
                    }
                });

            } else if (tipoPersona === 'Juridica') {
                datosNatural.classList.add('hidden');
                datosJuridica.classList.remove('hidden');
                infoNatural.classList.add('hidden');
                infoJuridica.classList.remove('hidden');

                // Agregar 'required' a los campos de Persona Jurídica
                camposJuridica.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.required = true;
                    }
                });

                // Remover 'required' de los campos de Persona Natural
                camposNatural.forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.required = false;
                    }
                });
            }
        }

        // Mostrar la sección apropiada cuando la página se recarga o hay validaciones
        window.addEventListener('DOMContentLoaded', () => {
            toggleSections();
        });
    </script>


    {{-- Script para manejar la subida de archivos (drag & drop) --}}
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

    {{-- Script para mostrar el popup con los parámetros de la sesión --}}
    @if(session('numeroExpediente') && session('claveExpediente'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Asignar los valores de la sesión a los elementos del popup
                document.getElementById('expediente-numero').innerText = '{{ session('numeroExpediente') }}';
                document.getElementById('expediente-clave').innerText = '{{ session('claveExpediente') }}';

                // Mostrar el popup
                document.getElementById('dialog-confirmation').classList.remove('hidden');
            });

            function closeDialog() {
                document.getElementById('dialog-confirmation').classList.add('hidden');
            }
        </script>
    @endif
@endsection
