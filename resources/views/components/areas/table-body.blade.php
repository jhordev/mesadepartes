@forelse($areas as $area)
    <tr class="bg-white border-b hover:bg-gray-50">
        <td class="px-6 py-4">{{ $area->ID_Area }}</td>
        <td class="px-6 py-4">{{ $area->Nombre_Area }}</td>
        <td class="px-6 py-4">{{ $area->Descripcion }}</td>
        <td class="px-6 py-4 text-center">
            <div class="flex justify-center space-x-2">
                <!-- Botón de editar -->
                <button type="button" onclick="openModal('{{ route('areas.update', $area->ID_Area) }}', 'PUT', 'Editar Área', { Nombre_Area: '{{ $area->Nombre_Area }}', Descripcion: '{{ $area->Descripcion }}', ID_Creador: '{{ $area->ID_Creador }}' })" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white font-medium rounded-lg text-sm p-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                </button>
                <!-- Botón de eliminar -->
                <button type="button" onclick="openDialog('{{ route('areas.destroy', $area->ID_Area) }}', 'Eliminar Área', '¿Estás seguro de eliminar esta área?')" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-trash">
                        <path stroke="none" d="M0 0h24V24H0z" fill="none"/>
                        <path d="M4 7h16"/>
                        <path d="M10 11v6"/>
                        <path d="M14 11v6"/>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                    </svg>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center text-gray-500 py-4">No se encontraron áreas.</td>
    </tr>
@endforelse
