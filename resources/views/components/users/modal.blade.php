<div id="{{ $id ?? 'modal' }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fondo semi-transparente -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Contenido del modal -->
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full relative z-10">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Nuevo Usuario</h3>
                <button
                    type="button"
                    onclick="closeModal()"
                    class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <!-- FORMULARIO -->
                <form id="modal-form" action="" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_method" id="form-method" value="POST">

                    <!-- Nombre -->
                    <div class="mb-5 col-span-4">
                        <label for="Nombre" class="block mb-2 text-sm font-medium text-gray-900">
                            Nombres y Apellidos
                        </label>
                        <input
                            type="text"
                            id="Nombre"
                            name="Nombre"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="Escribe el nombre del usuario"
                        >
                        <!-- Mensaje de error para Nombre -->
                        <div id="errorNombre" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Correo -->
                    <div class="mb-5 col-span-4">
                        <label for="Correo" class="block mb-2 text-sm font-medium text-gray-900">
                            Correo Electrónico
                        </label>
                        <input
                            type="email"
                            id="Correo"
                            name="Correo"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="name@gmail.com"
                        >
                        <!-- Mensaje de error para Correo -->
                        <div id="errorCorreo" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-5 col-span-4">
                        <label for="Contraseña" class="block mb-2 text-sm font-medium text-gray-900">
                            Contraseña
                        </label>
                        <input
                            type="password"
                            id="Contraseña"
                            name="Contraseña"
                            minlength="6"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="Ingrese una contraseña"
                        >
                        <!-- Mensaje de error para Contraseña -->
                        <div id="errorContraseña" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Rol -->
                    <div class="mb-5 col-span-4">
                        <label for="ID_Rol" class="block mb-2 text-sm font-medium text-gray-900">
                            Rol
                        </label>
                        <select
                            id="ID_Rol"
                            name="ID_Rol"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        >
                            <option value="" disabled selected>Seleccione un rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                        <!-- Mensaje de error para Rol -->
                        <div id="errorID_Rol" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Vincular Área -->
                    @include('components.users.select-areas')


                    <!-- Botón de enviar -->
                    <div class="w-full col-span-4">
                        <button
                            id="modal-submit-button"
                            type="submit"
                            class="mt-6 gap-3 px-5 py-3 text-base font-medium text-center text-white bg-[#007423] hover:bg-green-900 rounded-lg"
                        >
                            Agregar
                        </button>
                    </div>
                </form>
                <!-- FIN FORMULARIO -->
            </div>
        </div>
    </div>
</div>
