<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#F5F6FA] text-[#20262E]">

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button
                    data-drawer-toggle="logo-sidebar"
                    aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden
                           hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg
                        class="w-6 h-6"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0
                               010 1.5H2.75A.75.75 0
                               012 4.75zm0 10.5a.75.75 0
                               01.75-.75h7.5a.75.75 0
                               010 1.5h-7.5a.75.75 0
                               01-.75-.75zM2 10a.75.75 0
                               01.75-.75h14.5a.75.75 0
                               010 1.5H2.75A.75.75 0
                               012 10z"
                        ></path>
                    </svg>
                </button>
                <a href="#" class="flex items-center gap-2 ml-2 md:mr-24">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round"
                         class="lucide lucide-circle-user"
                    >
                        <circle cx="12" cy="12" r="10"/>
                        <circle cx="12" cy="10" r="3"/>
                        <path d="M7 20.662V19a2 2 0
                                 0 1 2-2h6a2 2 0
                                 0 1 2 2v1.662"/>
                    </svg>
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">
                        @if(auth()->user()->areas->count())
                            {{ auth()->user()->areas->pluck('Nombre_Area')->join(', ') }}
                        @else
                            Panel Administrador
                        @endif
                    </span>
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex items-center ml-3 relative">
                    <button
                        type="button"
                        class="flex text-sm bg-gray-800 rounded-full
                               focus:ring-4 focus:ring-gray-300"
                        aria-expanded="false"
                        data-dropdown-toggle="dropdown-user"
                    >
                        <span class="sr-only">Open user menu</span>
                        <img
                            class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                            alt="user photo"
                        >
                    </button>
                    <div
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100
                               rounded shadow absolute right-0 top-12"
                        id="dropdown-user"
                    >
                        <div class="px-4 py-3">
                            <p class="text-sm text-gray-900">
                                {{ auth()->user()->Nombre ?? 'Sin nombre' }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ auth()->user()->Correo ?? '' }}
                            </p>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a
                                    href="/dashboard/perfil"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside
    id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full
           bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar"
>
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a
                    href="/"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
                >
                    <svg
                        class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 22 21"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M16.975 11H10V4.025a1 1 0
                                 0 0-1.066-.998 8.5 8.5
                                 0 1 0 9.039 9.039.999.999
                                 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01
                                 -.565.027A1 1 0
                                 0 0 11 1.02V10h8.975a1
                                 1 0 0 0 1-.935c.013-.188.028
                                 -.374.028-.565A8.51 8.51 0
                                 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ml-3">Inicio</span>
                </a>
            </li>
            <li>
                @can('admin-access')
                <a
                    href="/dashboard/expedientes"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                    >
                        <path stroke="none"
                              d="M0 0h24v24H0z" fill="none"/>
                        <path
                            d="M17.997 4.17a3 3 0
                             0 1 2.003 2.83v12a3 3 0
                             0 1 -3 3h-10a3 3 0
                             0 1 -3 -3v-12a3 3 0
                             0 1 2.003 -2.83 4 4 0
                             0 0 3.997 3.83h4a4
                             4 0 0 0 3.98 -3.597zm
                             -2.997 10.83h-6a1 1 0 0 0
                             0 2h6a1 1 0 0 0 0 -2m0
                             -4h-6a1 1 0 0 0 0 2h6a1
                             1 0 0 0 0 -2m-1 -9a2 2 0
                             1 1 0 4h-4a2 2 0 1
                             1 0 -4z"
                        />
                    </svg>
                    <span class="ml-3">Expedientes</span>
                </a>
                @endcan
                    <a
                        href="{{ route('expedientes.propios') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 56 56"><path fill="#6b7280" d="M42.624 45.003h1.3c4.54 0 6.81-2.314 6.81-6.92V16.838h-13.07c-2.291 0-3.592-1.3-3.592-3.593V0H22.634c-4.54 0-6.831 2.314-6.831 6.92V8h2.864c3.108 0 5.598.882 8.067 3.35L39.23 23.89c2.49 2.49 3.394 5.047 3.394 8.044Zm-4.519-30.92h11.57c-.131-.706-.594-1.323-1.365-2.094l-9.39-9.565c-.75-.771-1.41-1.256-2.094-1.366l.022 11.746c0 .904.353 1.279 1.257 1.279M11.505 56h21.29c4.54 0 6.831-2.314 6.831-6.92V31.339H23.67c-2.843 0-4.165-1.344-4.165-4.165V10.997h-8c-4.54 0-6.832 2.314-6.832 6.92V49.08c0 4.628 2.292 6.92 6.832 6.92m12.143-27.68h14.81c-.22-.86-.815-1.653-1.807-2.667l-11.46-11.658c-.97-.992-1.83-1.587-2.667-1.83v15.03q0 1.125 1.124 1.125"/></svg>
                        <span class="ml-3">Expedientes Asignados</span>
                    </a>
            </li>
            @can('admin-access')
                <li>
                    <a
                        href="/dashboard/areas"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
                    >
                        <svg
                            class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 18 18"
                        >
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0
                                 0 0 0 1.857v4.286C0 7.169.831
                                 8 1.857 8h4.286A1.857 1.857 0
                                 0 0 8 6.143V1.857A1.857 1.857
                                 0 0 0 6.143 0Zm10 0h-4.286A1.857
                                 1.857 0 0 0 10 1.857v4.286C10
                                 7.169 10.831 8 11.857 8h4.286A1.857
                                 1.857 0 0 0 18 6.143V1.857A1.857
                                 1.857 0 0 0 16.143 0Zm-10
                                 10H1.857A1.857 1.857 0 0 0 0
                                 11.857v4.286C0 17.169.831
                                 18 1.857 18h4.286A1.857 1.857
                                 0 0 0 8 16.143v-4.286A1.857
                                 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857
                                 1.857 0 0 0 10 11.857v4.286c0
                                 1.026.831 1.857 1.857 1.857h4.286A1.857
                                 1.857 0 0 0 18 16.143v-4.286A1.857
                                 1.857 0 0 0 16.143 10Z"
                            />
                        </svg>
                        <span class="ml-3">Áreas</span>
                    </a>
                </li>
                <li>
                    <a
                        href="/dashboard/usuarios"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
                    >
                        <svg
                            class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 18"
                        >
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267
                                 6.439 6.439 0 0 1-1.331 6.638A4
                                 4 0 1 0 14 2Zm1
                                 9h-1.264A6.957 6.957 0 0 1
                                 15 15v2a2.97 2.97 0 0 1
                                 -.184 1H19a1 1 0 0 0
                                 1-1v-1a5.006 5.006 0 0 0
                                 -5-5ZM6.5
                                 9a4.5 4.5 0 1 0 0-9
                                 4.5 4.5 0 0 0 0
                                 9ZM8 10H5a5.006 5.006 0 0 0
                                 -5 5v2a1 1 0 0 0 1
                                 1h11a1 1 0 0 0
                                 1-1v-2a5.006 5.006 0 0 0
                                 -5-5Z"
                            />
                        </svg>
                        <span class="ml-3">Usuarios</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>

<div class="p-8 sm:ml-64 mt-14">
    @yield('content')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const drawerToggleBtn = document.querySelector('[data-drawer-toggle="logo-sidebar"]');
        const sidebar = document.getElementById('logo-sidebar');

        if (drawerToggleBtn && sidebar) {
            drawerToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        const userDropdownBtn = document.querySelector('[data-dropdown-toggle="dropdown-user"]');
        const userDropdown = document.getElementById('dropdown-user');

        if (userDropdownBtn && userDropdown) {
            userDropdownBtn.addEventListener('click', function() {
                userDropdown.classList.toggle('hidden');
            });
        }
    });
</script>
</body>
</html>
