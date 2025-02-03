@extends('layouts.dasboard')
@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-[22px] md:text-[28px] font-semibold">Perfil</h1>
    </div>

    <section class="bg-white w-full rounded-lg py-6 px-[200px] mt-5">
        <div class="flex justify-center">
            <div class="bg-[#ECECEE] rounded-full w-fit p-3">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle w-[80px] h-[80px]"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-6 mt-6 gap-10">
            <!-- Nombre -->
            <div class="mb-5 col-span-3">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">
                    Nombre
                </label>
                <input
                    type="text"
                    id="nombre"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base outline-none"
                    value="{{ auth()->user()->Nombre ?? '' }}"
                    readonly
                >
            </div>

            <!-- Correo -->
            <div class="mb-5 col-span-3">
                <label for="correo" class="block mb-2 text-sm font-medium text-gray-900">
                    Correo
                </label>
                <input
                    type="text"
                    id="correo"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base outline-none"
                    value="{{ auth()->user()->Correo ?? '' }}"
                    readonly
                >
            </div>

            <!-- Rol -->
            <div class="mb-5 col-span-3">
                <label for="rol" class="block mb-2 text-sm font-medium text-gray-900">
                    Rol
                </label>
                <input
                    type="text"
                    id="rol"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base outline-none"
                    value="{{ (auth()->user()->ID_Rol == 1) ? 'Administrador' : 'Usuario' }}"
                    readonly
                >
            </div>

            <!-- Área -->
            <div class="mb-5 col-span-3">
                <label for="area" class="block mb-2 text-sm font-medium text-gray-900">
                    Área
                </label>
                <input
                    type="text"
                    id="area"
                    class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base outline-none"
                    value="{{ auth()->user()->areas->pluck('Nombre_Area')->join(', ') }}"
                    readonly
                >
            </div>
        </div>
    </section>
@endsection
