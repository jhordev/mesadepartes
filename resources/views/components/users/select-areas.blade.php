<div class="mb-5 col-span-4">
    <label for="ID_Area" class="block mb-2 text-sm font-medium text-gray-900">
        Vincular Área
    </label>
    <select
        id="ID_Area"
        name="ID_Area"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 outline-none"
    >
        <option selected value="">Seleccione el área</option>
        @foreach($areas as $area)
            <option value="{{ $area->ID_Area }}">
                {{ $area->Nombre_Area }}
            </option>
        @endforeach
    </select>
    <!-- Mensaje de error para Área -->
    <div id="errorID_Area" class="text-red-500 text-sm mt-1"></div>
</div>
