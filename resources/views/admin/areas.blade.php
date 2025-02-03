@extends('layouts.dasboard')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-[22px] md:text-[28px] font-semibold">Áreas</h1>
        <button onclick="openModal('{{ route('areas.store') }}', 'POST', 'Nueva Área')" class="gap-3 px-5 py-3 text-base font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
            <span class="hidden md:flex">Nueva Área</span>
        </button>
    </div>

    <section class="bg-white w-full rounded-lg p-6 mt-5">
        <div class="relative mb-4 w-full">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="table-search"
                        name="search"
                        value="{{ request('search') }}"
                        class="w-full md:w-80 block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 outline-none"
                        placeholder="Buscar"
                    >
                </div>
        </div>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Área</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                </tr>
                </thead>
                <tbody id="table-body">
                @include('components.areas.table-body', ['areas' => $areas])
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $areas->links() }}
        </div>
    </section>

    @include('components.areas.modal')
    @include('components.dialog-confirmation')

    <script>
        function openModal(actionUrl, method = 'POST', title = 'Nueva Área', values = {}) {
            const modal = document.getElementById('modal');
            const form = document.getElementById('modal-form');
            const titleElement = document.getElementById('modal-title');
            const methodInput = document.getElementById('form-method');
            const submitButton = document.getElementById('modal-submit-button');

            // Configurar el título del modal
            titleElement.textContent = title;

            // Configurar el action del formulario
            form.action = actionUrl;

            // Configurar el método del formulario (POST o PUT)
            methodInput.value = method;

            // Configurar los valores de los campos (para actualización)
            document.getElementById('Nombre_Area').value = values.Nombre_Area || '';
            document.getElementById('Descripcion').value = values.Descripcion || '';
            document.getElementById('ID_Creador').value = values.ID_Creador || '';

            // Configurar el texto del botón
            submitButton.textContent = method === 'POST' ? 'Agregar' : 'Actualizar';

            // Mostrar el modal
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');

            // Reiniciar el formulario
            const form = document.getElementById('modal-form');
            form.reset();

            // Reiniciar el método a POST por defecto
            document.getElementById('form-method').value = 'POST';
        }



        function openDialog(actionUrl, title = 'Confirmación', message = '¿Estás seguro de realizar esta acción?') {
            const dialog = document.getElementById('dialog-confirmation');
            const form = document.getElementById('delete-form');
            form.action = actionUrl;

            // Cambiar dinámicamente el título y mensaje del diálogo
            dialog.querySelector('h3').textContent = title;
            dialog.querySelector('p').textContent = message;

            dialog.classList.remove('hidden');
        }

        function closeDialog() {
            const dialog = document.getElementById('dialog-confirmation');
            dialog.classList.add('hidden');
        }


        document.getElementById('table-search').addEventListener('input', function () {
            const query = this.value;

            fetch(`{{ route('areas.search') }}?search=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Actualiza el contenido del cuerpo de la tabla
                    document.getElementById('table-body').innerHTML = data.html;
                })
                .catch(error => console.error('Error en la búsqueda:', error));
        });


    </script>


@endsection
