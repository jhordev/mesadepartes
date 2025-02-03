<div id="dialog-confirmation" class="fixed inset-0 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Fondo semi-transparente -->
        <div class="fixed inset-0 bg-gray-800 opacity-50"></div>

        <!-- Contenido del diálogo -->
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full z-10">
            <div class="p-4 border-b">
                <h3 class="text-[14px] md:text-lg font-semibold text-gray-800 uppercase">
                    ¡Expediente creado con éxito!
                </h3>
                <p class="text-[12px] md:text-[14px] text-left mt-2">
                    “Por favor, guarde cuidadosamente su Número de Expediente y su Clave, ya que los necesitará para realizar el seguimiento de su trámite. Si los pierde, no podrá consultar el estado de su solicitud ni hacer modificaciones. Anótelos o guárdelos en un lugar seguro."
                </p>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-4 gap-3 items-center">
                    <span class="col-span-4 md:col-span-2 font-semibold">Número de expediente:</span>
                    <div class="col-span-4 md:col-span-2 flex justify-center items-center w-full">
                        <span id="expediente-numero" class="font-semibold text-[18px] w-full h-fit text-center bg-green-300 p-2"></span>
                    </div>
                    <span class="col-span-4 md:col-span-2 font-semibold">Clave de expediente:</span>
                    <div class="col-span-4 md:col-span-2 flex justify-center items-center w-full">
                        <span id="expediente-clave" class="font-semibold text-[18px] w-full h-fit text-center bg-green-300 p-2"></span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-4 p-4 border-t">
                <button
                    type="button"
                    class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700"
                    onclick="closeDialog()"
                >
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
