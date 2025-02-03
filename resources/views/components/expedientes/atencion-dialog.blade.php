<div id="{{ $id ?? 'modal' }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fondo semi-transparente -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Contenido del modal -->
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full relative z-10">
            <!-- Encabezado del Modal -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Nuevo Seguimiento</h3>
                <button
                    type="button"
                    onclick="closeModal('modal')"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="px-4 py-5 sm:p-6">
                <!-- FORMULARIO -->
                <form id="modal-form" action="{{ route('seguimiento.agregarBasico', ['idExpediente' => $expediente->ID_Expediente]) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-4">
                    @csrf

                    <!-- Descripción -->
                    <div class="mb-5 col-span-4">
                        <label for="Descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                            Descripción
                        </label>
                        <textarea
                            id="Descripcion"
                            name="Descripcion"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="Escribe la descripción del seguimiento"
                        ></textarea>
                        <!-- Mensaje de error para Descripción -->
                        <div id="errorDescripcion" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Archivo -->
                    <div class="mb-5 col-span-4">
                        <label for="Documento_Adjunto" class="block mb-2 text-sm font-medium text-gray-900">
                            Subir Archivo
                        </label>
                        <input
                            type="file"
                            id="Documento_Adjunto"
                            name="Documento_Adjunto"
                            accept=".pdf,.doc,.docx,.jpg,.png"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        >
                        <!-- Mensaje de error para Archivo -->
                        <div id="errorDocumento_Adjunto" class="text-red-500 text-sm mt-1"></div>
                    </div>

                    <!-- Botón de enviar -->
                    <div class="w-full col-span-4">
                        <button
                            id="modal-submit-button"
                            type="submit"
                            class="mt-6 gap-3 px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
                        >
                            Agregar Seguimiento
                        </button>
                    </div>
                </form>
                <!-- FIN FORMULARIO -->
            </div>
        </div>
    </div>
</div>
