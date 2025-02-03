@extends('layouts.dasboard')

@section('content')
    <div class="flex flex-col gap-3   mb-4">
        <div class="flex w-full justify-between items-center">
            <div class="flex flex-col">
                <h1 class="text-xl font-bold  uppercase">{{ $expediente->Numero_Expediente }}</h1>
                <p class="uppercase text-[12px]"><strong>Fecha: </strong> {{ $expediente->created_at }}</p>
                @if($expediente->Estado === 'Pendiente')
                    <span class="w-fit mt-1 flex md:hidden inline-flex items-center bg-red-100 text-red-800 text-[13px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
                @endif
                @if($expediente->Estado === 'En Tramite')
                    <span class="w-fit mt-1 flex md:hidden inline-flex items-center bg-yellow-100 text-yellow-800 text-[13px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
                @endif
                @if($expediente->Estado === 'Atendido')
                    <span class="w-fit mt-1 flex md:hidden inline-flex items-center bg-green-100 text-green-800 text-[13px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
                @endif
            </div>

            @if($expediente->Estado === 'Pendiente')
                <span class="hidden md:flex inline-flex items-center bg-red-100 text-red-800 text-[18px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
            @endif
            @if($expediente->Estado === 'En Tramite')
                <span class="hidden md:flex inline-flex items-center bg-yellow-100 text-yellow-800 text-[18px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-yellow-800 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
            @endif
            @if($expediente->Estado === 'Atendido')
                <span class="hidden md:flex inline-flex items-center bg-green-100 text-green-800 text-[18px] font-medium px-2.5 py-0.5 rounded-full">
            <span class="w-2 h-2 me-1 bg-green-800 rounded-full"></span>
            {{ $expediente->Estado }}
            </span>
            @endif

            <button onclick="openModal('modal')" type="button" class="px-10 py-3 h-fit text-base font-medium text-center inline-flex items-center justify-center text-white bg-green-700 rounded-lg hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-800 ">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-text-grammar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 9a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M4 12v-5a3 3 0 1 1 6 0v5" /><path d="M4 9h6" /><path d="M20 6v6" /><path d="M4 16h12" /><path d="M4 20h6" /><path d="M14 20l2 2l5 -5" /></svg>
                <span class="ml-3 hidden md:flex">Atender</span>
            </button>

        </div>

        <form action="{{ route('expedientes.actualizarEstado', ['idExpediente' => $expediente->ID_Expediente]) }}" method="POST">
            @csrf
           <div class="flex flex-col md:flex-row md:items-center md:gap-2">
               <label for="estado">Cambiar Estado:</label>
               <select name="Estado" id="estado" onchange="this.form.submit()" class="w-full md:w-fit outline-none cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-fit  p-2.5">
                   <option value="Pendiente" {{ $expediente->Estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                   <option value="En Tramite" {{ $expediente->Estado == 'En Tramite' ? 'selected' : '' }}>En Tramite</option>
                   <option value="Atendido" {{ $expediente->Estado == 'Atendido' ? 'selected' : '' }}>Atendido</option>
               </select>
           </div>
        </form>

    </div>

@if($personaNatural)
        <div class="flex flex-col gap-3 mb-6">
            <!-- Información del expediente -->
            <div class="bg-white shadow rounded-[10px]  ">
                <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                    <h2 class=" text-[14px] md:text-[18px] font-semibold">Información de Expediente</h2>
                </div>
                <div class="p-4 flex flex-col md:flex-row gap-3 md:gap-0 items-start md:justify-between text-[12px] md:text-[14px]">
                    <div>
                        <strong>Asunto:</strong>
                        <p class="pl-6"> {{ $expediente->Asunto }}</p>
                        <strong>Descripción:</strong>
                        <p class="pl-6"> {{ $expediente->Descripcion }}</p>
                    </div>
                    @if($documentos->isNotEmpty())
                        <div class="flex gap-3">
                            @foreach($documentos as $documento)

                                @if($documento->Nombre_Documento == 'Link de descarga')
                                    <a href="{{ $documento->Link_Documento }}" target="_blank" class="hover:scale-105 text-[10px] flex flex-col items-center justify-center">
                                        <img src="{{asset('link_Doc.png')}}" class="w-[30px] md:w-[50px]">
                                        Link
                                    </a>
                                @else
                                    @php
                                        // Obtenemos la extensión del archivo en minúsculas
                                           $extension = strtolower(pathinfo($documento->Nombre_Documento, PATHINFO_EXTENSION));

                                           // Se determina el ícono a mostrar según la extensión
                                           switch ($extension) {
                                               case 'pdf':
                                                   $icono = 'pdf.svg';
                                                   break;
                                               case 'xls':
                                               case 'xlsx':
                                               case 'csv':
                                                   $icono = 'excel.svg';
                                                   break;
                                               case 'jpg':
                                               case 'jpeg':
                                                   $icono = 'jpg.svg';
                                                   break;
                                               case 'png':
                                                   $icono = 'png.svg';
                                                   break;
                                               case 'doc':
                                               case 'docx':
                                                   $icono = 'word.svg';
                                                   break;
                                               default:
                                                   $icono = 'doc.png';
                                                   break;
                                           }
                                        @endphp
                                        <a href="{{ route('documento.descargar', ['nombreDocumento' => $documento->Nombre_Documento]) }}" class="hover:scale-105 text-[10px] flex flex-col items-center justify-center">
                                            <img src="{{ asset($icono) }}" class="w-[30px] md:w-[50px]">
                                            Descargar
                                        </a>
                                @endif

                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información de la persona natural -->
            <div class="bg-white shadow rounded-[10px]  w-full mb-6">
                <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                    <h2 class="text-[14px] md:text-[18px] font-semibold">Información de Remitente: Persona Natural</h2>
                </div>
                <div class="p-4 text-[12px] md:text-[14px]">
                    <table class="table-auto w-full">
                        <tbody>
                        <tr>
                            <td class="pb-2 font-semibold">Nombre:</td>
                            <td class="pb-2">
                                {{ $personaNatural->Nombre }} {{ $personaNatural->Apellido_Paterno }} {{ $personaNatural->Apellido_Materno }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">{{ $personaNatural->Tipo_Documento }}:</td>
                            <td class="py-2">
                                {{ $personaNatural->Numero_Documento }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">Email:</td>
                            <td class="py-2">
                                {{ $personaNatural->Email }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-2 font-semibold">Teléfono:</td>
                            <td class="pt-2">
                                {{ $personaNatural->Telefono }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endif
    <!-- Información de la persona jurídica -->
    @if($personaJuridica)

        <div class="bg-white shadow rounded-[10px]  flex flex-col mb-6">
            <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                <h2 class="text-[16px] md:text-[18px] font-semibold">Información de Expediente</h2>
            </div>
            <div class="p-4 flex flex-col md:flex-row items-start gap-3 md:gap-0 md:justify-between text-[12px] md:text-[14px]">
                <div>
                    <strong>Asunto:</strong>
                    <p class="pl-6"> {{ $expediente->Asunto }}</p>
                    <strong>Descripción:</strong>
                    <p class="pl-6"> {{ $expediente->Descripcion }}</p>
                </div>
                @if($documentos->isNotEmpty())
                    <div class="flex gap-3">
                        @foreach($documentos as $documento)
                            @if($documento->Nombre_Documento == 'Link de descarga')
                                <a href="{{ $documento->Link_Documento }}" target="_blank" class="hover:scale-105">
                                    <img src="{{asset('link_Doc.png')}}" class="w-[30px] md:w-[50px]">
                                </a>
                            @else
                                @php
                                    // Obtenemos la extensión del archivo en minúsculas
                                       $extension = strtolower(pathinfo($documento->Nombre_Documento, PATHINFO_EXTENSION));

                                       // Se determina el ícono a mostrar según la extensión
                                       switch ($extension) {
                                           case 'pdf':
                                               $icono = 'pdf.svg';
                                               break;
                                           case 'xls':
                                           case 'xlsx':
                                           case 'csv':
                                               $icono = 'excel.svg';
                                               break;
                                           case 'jpg':
                                           case 'jpeg':
                                               $icono = 'jpg.svg';
                                               break;
                                           case 'png':
                                               $icono = 'png.svg';
                                               break;
                                           case 'doc':
                                           case 'docx':
                                               $icono = 'word.svg';
                                               break;
                                           default:
                                               $icono = 'doc.png';
                                               break;
                                       }
                                @endphp
                                <a href="{{ route('documento.descargar', ['nombreDocumento' => $documento->Nombre_Documento]) }}" class="hover:scale-105 text-[10px] flex flex-col items-center justify-center">
                                    <img src="{{ asset($icono) }}" class="w-[30px] md:w-[50px]">
                                    Descargar
                                </a>
                            @endif

                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1  md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow rounded-[10px]  flex flex-col">
                <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                    <h2 class="text-[16px] md:text-[18px] font-semibold">Información de Empresa</h2>
                </div>
               <div class="p-4 text-[12px] md:text-[14px]">
                   <table class="table-auto w-full">
                       <tbody>
                       <tr>
                           <td class="pb-2 font-semibold">Entidad:</td>
                           <td class="pb-2">
                               {{ $personaJuridica->Nombre_Entidad }}
                           </td>
                       </tr>
                       <tr>
                           <td class="py-2 font-semibold">RUC:</td>
                           <td class="py-2">
                               {{ $personaJuridica->RUC }}
                           </td>
                       </tr>
                       <tr>
                           <td class="py-2 font-semibold">Dirección:</td>
                           <td class="py-2">
                               {{ $personaJuridica->Direccion }}
                           </td>
                       </tr>
                       <tr>
                           <td class="py-2 font-semibold">Distrito:</td>
                           <td class="py-2">
                               {{ $personaJuridica->Distrito }}
                           </td>
                       </tr>
                       <tr>
                           <td class="py-2 font-semibold">Provincia:</td>
                           <td class="py-2">
                               {{ $personaJuridica->Provincia }}
                           </td>
                       </tr>
                       <tr>
                           <td class="pt-2 font-semibold">Departamento:</td>
                           <td class="pt-2">
                               {{ $personaJuridica->Departamento }}
                           </td>
                       </tr>
                       </tbody>
                   </table>
               </div>
            </div>

            <!-- Información del representante legal -->
            @if($representanteLegal)
                <div class="bg-white shadow rounded-[10px]  flex flex-col">
                    <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
                        <h2 class="text-[16px] md:text-[18px] font-semibold">Representante Legal</h2>
                    </div>
                   <div class="p-4 text-[12px] md:text-[14px] truncate">
                       <table class="table-auto w-full truncate">
                           <tbody>
                           <tr>
                               <td class="pb-2 font-semibold">Nombre:</td>
                               <td class="pb-2">
                                   {{ $representanteLegal->Nombre }} {{ $representanteLegal->Apellido_Paterno }} {{ $representanteLegal->Apellido_Materno }}
                               </td>
                           </tr>
                           <tr>
                               <td class="py-2 font-semibold">{{ $representanteLegal->Tipo_Documento }}:</td>
                               <td class="py-2">
                                   {{ $representanteLegal->Numero_Documento }}
                               </td>
                           </tr>
                           <tr class="truncate">
                               <td class="py-2 font-semibold">Email:</td>
                               <td class="py-2 truncate">
                                   {{ $representanteLegal->Email }}
                               </td>
                           </tr>
                           <tr>
                               <td class="py-2 font-semibold">Teléfono:</td>
                               <td class="py-2">
                                   {{ $representanteLegal->Telefono }}
                               </td>
                           </tr>
                           </tbody>
                       </table>
                   </div>
                </div>
            @endif
        </div>
    @endif

   <div class="bg-white shadow rounded-[10px]">
       <div class="bg-blue-200 py-2 px-4 rounded-tr-[10px] rounded-tl-[10px]">
           <h2 class=" text-[14px] md:text-[18px] font-semibold">Seguimiento</h2>
       </div>
      <div class="p-4">
          <div class="relative overflow-x-auto">
              <!-- Tabla con id para actualizar el tbody dinámicamente -->
              <table class="table-auto w-full border-collapse border border-gray-300">
                  <thead>
                  <tr class="bg-gray-200">
                      <th class="border border-gray-300 px-4 py-2">ID</th>
                      <th class="border border-gray-300 px-4 py-2">Fecha/Hora</th>
                      <th class="border border-gray-300 px-4 py-2">Descripción</th>
                      <th class="border border-gray-300 px-4 py-2">Adjunto</th>
                      <th class="border border-gray-300 px-4 py-2">Usuario</th>
                      <th class="border border-gray-300 px-4 py-2 text-center">Área</th>
                  </tr>
                  </thead>
                  <!-- Cuerpo de la tabla que modificaremos vía JS -->
                  <tbody>
                  @foreach($seguimientos as $seguimiento)
                      <tr>
                          <td class="border border-gray-300 px-4 py-2">{{ $seguimiento->NumeroSecuencia  }}</td>
                          <td class="border border-gray-300 px-4 py-2">{{ $seguimiento->created_at }}</td>
                          <td class="border border-gray-300 px-4 py-2">{{ $seguimiento->Mensaje }}</td>
                          <td class="border border-gray-300 px-4 py-2">
                              @if($seguimiento->Documento_Adjunto)
                                  <a href="{{ route('seguimientos.verPDF', ['nombreDocumento' => $seguimiento->Documento_Adjunto]) }}" target="_blank" class="">
                                      Ver Documento
                                  </a>
                              @else
                                  No disponible
                              @endif
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              {{ $seguimiento->usuario->Nombre ?? 'Desconocido' }}
                          </td>
                          <td class="border border-gray-300 px-4 py-2 text-center">
                              {{ $seguimiento->areaOrigen->Nombre_Area ?? 'N/A' }}
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
   </div>

    @include('components.expedientes.atencion-dialog')

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

    </script>

@endsection
