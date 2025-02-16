@extends('layouts.app')
@section('content')

    <main class=" mt-20 max-w-[1480px] w-auto m-auto px-5 pb-10">
        <div class="border rounded-lg pb-6">
            <div class="bg-[#F7F7F7] py-3 px-5 rounded-tl-lg rounded-tr-lg border-b">
                <h1 class="text-[24px] font-bold text-center ">Consulta Expediente</h1>
            </div>

            <div class="w-full flex justify-center py-6 px-4 md:px-10">
                <span class="text-center">Estimado usuario, aquí puede consultar el estado de su trámite.</span>
            </div>

            {{-- FORMULARIO DE CONSULTA --}}
            <form action="{{ route('expedientes.consultar') }}" method="POST" class="px-4 md:px-10 grid grid-cols-8 gap-6 items-end">
                @csrf

                @if(session('error'))
                    <div class="flex justify-between items-center col-span-8 text-red-600 bg-red-100 border border-red-400 px-4 py-3 rounded relative" role="alert">
                       <div>
                           <strong class="font-bold">Error:</strong>
                           <span class="block sm:inline">{{ session('error') }}</span>
                       </div>
                        <a href="/expedientes" class="border border-red-400 px-4 p-2 rounded-lg text-red-600 hover:bg-blue-400 hover:text-blue-800">Intentar otra ves</a>
                    </div>
                @endif

                <div class="col-span-8 md:col-span-3 flex flex-col gap-2">
                    <label for="numero_expediente" class="font-bold">Número de Expediente</label>
                    <input
                        type="text"
                        name="numero_expediente"
                        id="numero_expediente"
                        required
                        placeholder="Ingrese el número de expediente"
                        class="h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:rounded-none transition-all duration-300 ease-in-out"
                    />
                </div>

                <div class="col-span-8 md:col-span-3 flex flex-col gap-2">
                    <label for="clave" class="font-bold">Código</label>
                    <input
                        type="text"
                        name="clave"
                        id="clave"
                        required
                        placeholder="Ingrese su código de seguridad"
                        class="h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:rounded-none transition-all duration-300 ease-in-out"
                    />
                </div>

                <button
                    type="submit"
                    class="col-span-8 md:col-span-2 px-5 flex justify-center py-3 text-base font-medium text-center items-center text-white bg-[#007423] hover:bg-green-900 rounded-lg hover:bg-blue-800"
                >
                    Buscar
                </button>
            </form>

            {{-- SOLO MOSTRAR LA INFORMACIÓN SI $expediente EXISTE --}}
            @if(isset($expediente))
                <div class="px-4 md:px-10 mt-8">
                    {{-- Encabezado con Nro. Expediente y Estado --}}
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            {{-- Muestra el número de expediente --}}
                            <h1 class="text-[20px] font-bold uppercase">
                                {{ $expediente->Numero_Expediente }}
                            </h1>

                            {{-- Muestra fecha de creación si la tienes (o created_at) --}}
                            <p class="uppercase text-[12px]">
                                <strong>Fecha: </strong>
                                {{ optional($expediente->created_at)->format('d-m-Y') }}
                            </p>
                        </div>

                        {{-- Muestra el estado con color (a modo de ejemplo si es Pendiente = rojo) --}}
                        @php
                            // Ejemplo de asignar clase según estado
                            $estadoColor = match($expediente->Estado) {
                                'Pendiente' => 'bg-red-100 text-red-800',
                                'En Tramite' => 'bg-yellow-100 text-yellow-800',
                                'Atendido' => 'bg-green-100 text-green-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <span class="w-fit mt-1 flex inline-flex items-center {{ $estadoColor }} text-[16px] font-medium px-2.5 py-0.5 rounded-full">
                        <span class="w-2 h-2 me-1 bg-current rounded-full"></span>
                        {{ $expediente->Estado }}
                    </span>
                    </div>

                    {{-- Secciones de información --}}
                    <div class="grid grid-cols-6 mt-6 gap-6">

                        {{-- Información del Expediente --}}
                        <div class=" col-span-6 md:col-span-3 bg-white shadow rounded-[10px]">
                            <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                                <h2 class="text-[14px] md:text-[18px] font-semibold">Expediente</h2>
                            </div>
                            <div class="p-4 text-[12px] md:text-[14px]">
                                <table class="table-auto w-full">
                                    <tbody>
                                    <tr>
                                        <td class="pb-2 font-semibold">Número:</td>
                                        <td class="pb-2">{{ $expediente->Numero_Expediente }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Asunto:</td>
                                        <td class="py-2">{{ $expediente->Asunto }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-semibold">Descripción:</td>
                                        <td class="py-2">{{ $expediente->Descripcion }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Dependiendo de si es Natural o Jurídica --}}
                        @if($expediente->Tipo_Solicitante === 'Natural' && $expediente->personaNatural)
                            {{-- Datos Personales: Persona Natural --}}
                            <div class="col-span-6 md:col-span-3 bg-white shadow rounded-[10px]">
                                <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                                    <h2 class="text-[14px] md:text-[18px] font-semibold">Datos Personales</h2>
                                </div>
                                <div class="p-4 text-[12px] md:text-[14px]">
                                    <table class="table-auto w-full">
                                        <tbody>
                                        <tr>
                                            <td class="pb-2 font-semibold">Documento:</td>
                                            <td class="pb-2">
                                                {{ $expediente->personaNatural->Tipo_Documento }} -
                                                {{ $expediente->personaNatural->Numero_Documento }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 font-semibold">Nombre:</td>
                                            <td class="py-2">
                                                {{ $expediente->personaNatural->Nombre }}
                                                {{ $expediente->personaNatural->Apellido_Paterno }}
                                                {{ $expediente->personaNatural->Apellido_Materno }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 font-semibold">Departamento:</td>
                                            <td class="py-2">
                                                {{ $expediente->personaNatural->Departamento }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 font-semibold">Provincia:</td>
                                            <td class="pt-2">
                                                {{ $expediente->personaNatural->Provincia }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 font-semibold">Distrito:</td>
                                            <td class="pt-2">
                                                {{ $expediente->personaNatural->Distrito }}
                                            </td>
                                        </tr>
                                        {{-- Muestra otros campos si lo requieres (Dirección, Email, etc.) --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @elseif($expediente->Tipo_Solicitante === 'Juridica' && $expediente->personaJuridica)
                            {{-- Datos: Persona Jurídica --}}
                            <div class="col-span-6 md:col-span-3 bg-white shadow rounded-[10px]">
                                <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                                    <h2 class="text-[14px] md:text-[18px] font-semibold">Datos de la Empresa</h2>
                                </div>
                                <div class="p-4 text-[12px] md:text-[14px]">
                                    <table class="table-auto w-full">
                                        <tbody>
                                        <tr>
                                            <td class="pb-2 font-semibold">RUC:</td>
                                            <td class="pb-2">{{ $expediente->personaJuridica->RUC }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 font-semibold">Nombre Entidad:</td>
                                            <td class="py-2">{{ $expediente->personaJuridica->Nombre_Entidad }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 font-semibold">Departamento:</td>
                                            <td class="py-2">{{ $expediente->personaJuridica->Departamento }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 font-semibold">Provincia:</td>
                                            <td class="pt-2">{{ $expediente->personaJuridica->Provincia }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2 font-semibold">Distrito:</td>
                                            <td class="pt-2">{{ $expediente->personaJuridica->Distrito }}</td>
                                        </tr>
                                        {{-- Muestra otros campos: Direccion, etc. --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Si existe representante legal --}}
                            @if($expediente->personaJuridica->representanteLegal)
                                <div class="col-span-6 bg-white shadow rounded-[10px]">
                                    <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                                        <h2 class="text-[14px] md:text-[18px] font-semibold">Representante Legal</h2>
                                    </div>
                                    <div class="p-4 text-[12px] md:text-[14px]">
                                        <table class="table-auto w-full">
                                            <tbody>
                                            <tr>
                                                <td class="pb-2 font-semibold">Tipo Documento:</td>
                                                <td class="pb-2">
                                                    {{ $expediente->personaJuridica->representanteLegal->Tipo_Documento }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 font-semibold">Número Documento:</td>
                                                <td class="py-2">
                                                    {{ $expediente->personaJuridica->representanteLegal->Numero_Documento }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 font-semibold">Nombre:</td>
                                                <td class="py-2">
                                                    {{ $expediente->personaJuridica->representanteLegal->Nombre }}
                                                    {{ $expediente->personaJuridica->representanteLegal->Apellido_Paterno }}
                                                    {{ $expediente->personaJuridica->representanteLegal->Apellido_Materno }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 font-semibold">Email:</td>
                                                <td class="py-2">
                                                    {{ $expediente->personaJuridica->representanteLegal->Email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 font-semibold">Teléfono:</td>
                                                <td class="py-2">
                                                    {{ $expediente->personaJuridica->representanteLegal->Telefono }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                        @endif
                    </div>  {{-- Fin flex-col mt-6 --}}

                    <!-- INFORMACIÓN DE DE TABLA -->

                    <div class=" mt-6 relative overflow-x-auto">
                        <h2 class="text-[20px] mb-2 font-bold">Seguimiento</h2>
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">Fecha</th>
                                <th class="border border-gray-300 px-4 py-2">Descripción</th>
                                <th class="border border-gray-300 px-4 py-2">Adjunto</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Área</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($seguimientos as $seguimiento)
                                <tr>

                                    {{-- Fecha (usa Fecha_Accion o created_at) --}}
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ optional($seguimiento->created_at)->format('d-m-Y') }}
                                    </td>

                                    {{-- Descripción (Mensaje) --}}
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $seguimiento->Mensaje }}
                                    </td>

                                    {{-- Adjunto (Documento_Adjunto) --}}
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($seguimiento->Documento_Adjunto)
                                            <a href="{{ route('expediente.verPDF', ['nombreDocumento' => $seguimiento->Documento_Adjunto]) }}"
                                               class="text-blue-600 flex flex-col items-center flex justify-center text-center" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                                                Descargar
                                            </a>
                                        @else
                                            <span class="text-gray-500 text-center w-full flex justify-center text-[14px] text-yellow-700">No se adjuntó ningún documento</span>
                                        @endif
                                    </td>

                                    {{-- Área (ejemplo: Área de Origen) --}}
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        {{ optional($seguimiento->areaOrigen)->Nombre_Area ?? 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div> {{-- Fin px-4 md:px-10 mt-8 --}}
            @endif

        </div> {{-- Fin .border rounded-lg pb-6 --}}
    </main>
@endsection
