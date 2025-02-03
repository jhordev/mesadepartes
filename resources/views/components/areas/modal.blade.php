<div id="{{ $id ?? 'modal' }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full relative z-10">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Nueva Área</h3>
                <button type="button" onclick="closeModal()" class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <form id="modal-form" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="form-method" name="_method" value="POST">

                    <div class="mb-5 col-span-4">
                        <label for="Nombre_Area" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input type="text" id="Nombre_Area" name="Nombre_Area" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                               placeholder="Escribe el nombre del área">
                    </div>
                    <div class="col-span-4">
                        <label for="Descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
                        <textarea id="Descripcion" name="Descripcion" rows="4" required
                                  class="outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                                  placeholder="Escribe la descripción"></textarea>
                    </div>

                    <input type="hidden" id="ID_Creador" name="ID_Creador">
                    <div class="w-full">
                        <button type="submit" id="modal-submit-button" class="mt-6 gap-3 px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


