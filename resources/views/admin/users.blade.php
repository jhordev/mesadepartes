@extends('layouts.dasboard')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-[22px] md:text-[28px] font-semibold">Usuarios</h1>
        <button
            type="button"
            onclick="openModal('{{ route('usuarios.store') }}', 'POST', 'Nuevo Usuario')"
            class="gap-3 px-5 py-3 text-base font-medium text-center inline-flex items-center text-white bg-[#007423] hover:bg-green-900 rounded-lg hover:bg-blue-800"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="currentColor"
                 class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4.929 4.929a10 10 0
                         1 1 14.141 14.141a10 10 0
                         0 1 -14.14 -14.14zm8.071 4.071
                         a1 1 0 1 0 -2 0v2h-2a1 1 0
                         1 0 0 2h2v2a1 1 0 1 0 2
                         0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
            <span class="hidden md:flex">Nuevo usuario</span>
        </button>
    </div>

    <section class="bg-white w-full rounded-lg p-6 mt-5">
        <div class="relative mb-4 w-full">
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
            <input
                type="text"
                id="table-search"
                class="w-full md:w-80 block p-2 ps-10 text-sm text-gray-900
                       border border-gray-300 rounded-lg bg-gray-50 outline-none"
                placeholder="Buscar por nombre o correo"
            >
        </div>
        <div class="relative overflow-x-auto">
            <!-- Tabla con id para actualizar el tbody dinámicamente -->
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Correo</th>
                    <th class="border border-gray-300 px-4 py-2">Rol</th>
                    <th class="border border-gray-300 px-4 py-2">Área</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                </tr>
                </thead>
                <!-- Cuerpo de la tabla que modificaremos vía JS -->
                <tbody id="table-body">
                @include('components.users.table-body', ['usuarios' => $usuarios])
                </tbody>
            </table>
        </div>
        <!-- Si antes usabas paginación, la puedes omitir o dejar:
             <div class="mt-4">
                 {{ $usuarios->links() }}
        </div>
-->
    </section>

    <!-- Modales y diálogo de confirmación -->
    @include('components.users.modal')
    @include('components.dialog-confirmation')

    <script>
        /**
         * Abre el modal y configura los campos según si es POST (crear) o PUT (editar).
         */
        function openModal(actionUrl, method = 'POST', title = 'Nuevo Usuario', values = {}) {
            const modal       = document.getElementById('modal');
            const form        = document.getElementById('modal-form');
            const titleElement= document.getElementById('modal-title');
            const methodInput = document.getElementById('form-method');
            const submitButton= document.getElementById('modal-submit-button');

            // Título del modal
            titleElement.textContent = title;

            // Action del form
            form.action = actionUrl;

            // Método del form (POST o PUT)
            methodInput.value = method;

            // Asignar valores a los inputs
            document.getElementById('Nombre').value     = values.Nombre || '';
            document.getElementById('Correo').value     = values.Correo || '';
            document.getElementById('Contraseña').value = '';
            document.getElementById('ID_Rol').value     = values.ID_Rol || '';
            document.getElementById('ID_Area').value    = values.ID_Area || '';

            // Texto del botón
            submitButton.textContent = (method === 'POST') ? 'Agregar' : 'Actualizar';

            // Mostrar modal
            modal.classList.remove('hidden');
        }

        /**
         * Cierra el modal y limpia el formulario.
         */
        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            document.getElementById('modal-form').reset();
            clearErrors();
        }

        /**
         * Limpia los mensajes de error en el modal.
         */
        function clearErrors() {
            document.getElementById('errorNombre').innerText     = '';
            document.getElementById('errorCorreo').innerText     = '';
            document.getElementById('errorContraseña').innerText = '';
            document.getElementById('errorID_Rol').innerText     = '';
            document.getElementById('errorID_Area').innerText    = '';
        }

        /**
         * Manejo de envío AJAX (crear/editar).
         */
        const modalForm = document.getElementById('modal-form');
        modalForm.addEventListener('submit', async function (e) {
            e.preventDefault(); // Evitar envío normal

            clearErrors();

            const actionUrl = modalForm.action;
            const formData  = new FormData(modalForm);
            const method    = document.getElementById('form-method').value; // 'POST' o 'PUT'

            // Emulación de PUT
            if (method === 'PUT') {
                formData.set('_method', 'PUT');
            }

            try {
                const response = await fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        alert(data.message || 'Operación exitosa.');
                        closeModal();
                        window.location.reload();
                    } else {
                        alert(data.message || 'Ocurrió algo inesperado.');
                    }
                } else if (response.status === 422) {
                    // Error de validación
                    const errorData = await response.json();
                    const errors    = errorData.errors || {};

                    if (errors.Nombre) {
                        document.getElementById('errorNombre').innerText = errors.Nombre.join(' ');
                    }
                    if (errors.Correo) {
                        document.getElementById('errorCorreo').innerText = errors.Correo.join(' ');
                    }
                    if (errors.Contraseña) {
                        document.getElementById('errorContraseña').innerText = errors.Contraseña.join(' ');
                    }
                    if (errors.ID_Rol) {
                        document.getElementById('errorID_Rol').innerText = errors.ID_Rol.join(' ');
                    }
                    if (errors.ID_Area) {
                        document.getElementById('errorID_Area').innerText = errors.ID_Area.join(' ');
                    }
                } else {
                    // Otros errores (500, 403, etc.)
                    const genericError = await response.text();
                    alert('Ha ocurrido un error:\n' + genericError);
                }
            } catch (error) {
                console.error('Error de conexión:', error);
                alert('No se pudo completar la solicitud. Ver consola para más detalles.');
            }
        });

        /**
         * Muestra el diálogo de confirmación antes de eliminar.
         */
        function openDeleteDialog(actionUrl) {
            const dialog     = document.getElementById('dialog-confirmation');
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action= actionUrl;
            dialog.classList.remove('hidden'); // Mostrar
        }

        /**
         * Cierra el diálogo de confirmación.
         */
        function closeDialog() {
            const dialog = document.getElementById('dialog-confirmation');
            dialog.classList.add('hidden');
        }

        /**
         * Al iniciar, agregamos un listener para búsqueda "reactiva".
         */
        // Similar a tu ejemplo de "areas"
        document.getElementById('table-search').addEventListener('input', function () {
            const query = this.value;

            fetch(`{{ route('usuarios.search') }}?search=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Reemplazar el contenido del tbody
                    document.getElementById('table-body').innerHTML = data.html;
                })
                .catch(error => console.error('Error en la búsqueda:', error));
        });
    </script>
@endsection
