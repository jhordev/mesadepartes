@forelse ($usuarios as $usuario)
    <tr>
        <td class="border border-gray-300 px-4 py-2">{{ $usuario->ID_Usuario }}</td>
        <td class="border border-gray-300 px-4 py-2">{{ $usuario->Nombre }}</td>
        <td class="border border-gray-300 px-4 py-2">{{ $usuario->Correo }}</td>
        <td class="border border-gray-300 px-4 py-2">
            {{ $usuario->ID_Rol == 1 ? 'Admin' : 'Usuario' }}
        </td>
        <td class="border border-gray-300 px-4 py-2">
            {{ $usuario->areas->pluck('Nombre_Area')->join(', ') }}
        </td>
        <td class="border border-gray-300 px-4 py-2 text-center">
            <button
                type="button"
                onclick="openModal(
                    '{{ route('usuarios.update', $usuario->ID_Usuario) }}',
                    'PUT',
                    'Editar Usuario',
                    {
                        Nombre: '{{ $usuario->Nombre }}',
                        Correo: '{{ $usuario->Correo }}',
                        ID_Rol: '{{ $usuario->ID_Rol }}',
                        ID_Area: '{{ optional($usuario->areas->first())->ID_Area }}'
                    }
                )"
                class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm p-2.5"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
            </button>
            <button
                type="button"
                class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center"
                onclick="openDeleteDialog('{{ route('usuarios.destroy', $usuario->ID_Usuario) }}')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-trash">
                    <path stroke="none" d="M0 0h24V24H0z" fill="none"/>
                    <path d="M4 7h16"/>
                    <path d="M10 11v6"/>
                    <path d="M14 11v6"/>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                </svg>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4">
            No hay usuarios registrados.
        </td>
    </tr>
@endforelse
