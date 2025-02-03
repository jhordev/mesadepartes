<div id="{{ $id ?? 'dialog-confirmation' }}" class="fixed inset-0 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fondo semi-transparente -->
        <div class="fixed inset-0 bg-gray-800 opacity-50" onclick="closeDialog()"></div>

        <!-- Contenido del diálogo -->
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full z-10">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $title ?? 'Confirmación' }}
                </h3>
            </div>
            <div class="p-4">
                <p class="text-sm text-gray-600">
                    {{ $message ?? '¿Estás seguro de que deseas realizar esta acción?' }}
                </p>
            </div>
            <div class="flex justify-end gap-4 p-4 border-t">
                <button onclick="closeDialog()" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300">
                    Cancelar
                </button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
