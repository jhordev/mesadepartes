@extends('layouts.dasboard')
@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-[22px] md:text-[28px] font-semibold">Expedientes</h1>
        <a href="{{ route('expedientes.exportarExcel', request()->only('estado','from_date','to_date')) }}"
           class="bg-green-600 text-white px-3 py-2 rounded">
            Exportar a Excel
        </a>
    </div>

    <section class="bg-white w-full rounded-lg p-6 mt-5">
        <div class="flex flex-col lg:flex-row lg:justify-between mb-4 gap-3 ">
            <div class="flex flex-col lg:flex-row items-center gap-2">
                <div class="relative w-full lg:w-auto">
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                             aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8
                             4 4 0 000-8zM2 8a6 6
                             0 1110.89 3.476l4.817
                             4.817a1 1 0 01-1.414
                             1.414l-4.816-4.816A6
                             6 0 012 8z"
                                  clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <form method="GET" action="{{ route('expedientes.propios') }}" class="flex">
                        <input
                            type="text"
                            name="search"
                            id="table-search"
                            value="{{ request('search') }}"
                            class="w-full lg:w-80 block p-2 ps-10 text-sm text-gray-900
                       border border-gray-300 rounded-lg bg-gray-50 outline-none"
                            placeholder="Buscar por nombre o correo"
                        >

                    </form>
                </div>
                <form action="{{ route('expedientes.propios') }}" method="GET">
                    <select name="estado" class="w-full lg:w-auto block w-fit outline-none p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50" onchange="this.form.submit()">
                        <option value="">Todos los Estados</option>
                        <option value="Pendiente" {{ $estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En Tramite" {{ $estado == 'En Tramite' ? 'selected' : '' }}>En Tramite</option>
                        <option value="Atendido" {{ $estado == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                    </select>
                </form>

            </div>
            <form action="{{ route('expedientes.propios') }}" method="GET" class="flex flex-col lg:flex-row items-center gap-3">
                <div class="flex flex-col lg:flex-row w-full items-center gap-3">
                    <div class="flex w-full lg:w-auto justify-between items-center gap-2">
                        <label class="flex-[0.3]">Desde: </label>
                        <input type="date" name="from_date"
                               id="from_date"
                               value="{{ request('from_date') }}" class="flex-1 block w-full lg:w-fit outline-none p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                    <div class="flex w-full lg:w-auto justify-between items-center gap-2">
                        <label class="flex-[0.3]">A: </label>
                        <input type="date" name="to_date"
                               id="to_date"
                               value="{{ request('to_date') }}" class="flex-1 block w-full lg:w-fit outline-none p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                </div>
                <button type="submit" class="w-full lg:w-auto py-2 px-5  text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
                    Filtrar
                </button>
            </form>
        </div>
        <div class="relative overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Asunto</th>
                    <th class="border border-gray-300 px-4 py-2">Remitente</th>
                    <th class="border border-gray-300 px-4 py-2">Solicitante</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Derivar</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @foreach($expedientes as $expediente)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $expediente->ID }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $expediente->Fecha }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $expediente->Asunto }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            {{ $expediente->Remitente }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            {{ $expediente->Tipo_Solicitante }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">

                            <div class="flex justify-center items-center h-full">
                                @if($expediente->Estado == 'Pendiente')
                                    <span class="flex inline-flex w-full items-center bg-red-100 text-red-800 text-[12px] font-medium px-2.5 py-0.5 rounded-full whitespace-nowrap">
                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                    {{ $expediente->Estado }}
                                </span>
                                @endif
                                @if($expediente->Estado == 'En Tramite')
                                    <span class="flex inline-flex w-full items-center bg-yellow-100 text-yellow-800 text-[12px] font-medium px-2.5 py-0.5 rounded-full whitespace-nowrap">
                                            <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                            {{ $expediente->Estado }}
                                        </span>
                                @endif
                                @if($expediente->Estado == 'Atendido')
                                    <span class="flex inline-flex w-full items-center bg-green-100 text-green-800 text-[12px] font-medium px-2.5 py-0.5 rounded-full whitespace-nowrap">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            {{ $expediente->Estado }}
                                        </span>
                                @endif
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('expedientes.actualizarResponsable', ['idExpediente' => $expediente->ID]) }}" method="POST">
                                @csrf
                                <select name="Responsable" id="responsable" class="form-select outline-none cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-fit  p-2.5" onchange="this.form.submit()">
                                    @foreach ($relaciones as $relacion)
                                        <option class="hidden">Seleccione área</option>
                                        <option value="{{ $relacion->ID_Usuario }}"
                                            {{ $expediente->Responsable == $relacion->ID_Usuario ? 'selected' : '' }}>
                                            {{ $relacion->Nombre_Area }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex gap-2 items-center">
                                <a
                                    href="{{ route('expedientes.detalle', ['id' => $expediente->ID]) }}"
                                    class="flex items-center gap-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm p-2.5"
                                >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-location"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                    Atender
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <!-- Controles de paginación -->
        <div class="mt-4 flex">
            {{ $expedientes->withQueryString()->links() }}
        </div>
    </section>
@endsection
