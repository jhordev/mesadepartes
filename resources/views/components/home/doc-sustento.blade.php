<!-- Documentos de sustento-->
<h2 class="font-bold text-[20px] mb-4">Descripción de la solicitud o trámite</h2>
<div class="ml-5">
    <label class="font-bold ">6. Adjunta los documentos que sustenten tu solicitud</label>
    <p class="my-2">
        Solo se aceptan formatos jpg, jpeg, png, tif, bmp, pdf, doc, docx, txt, xls, xlsx, xlsm, csv, rar, zip, mp3, wma, mp4 y wmv.
        <strong class="block"> Peso total máximo: 10 MB.</strong>
    </p>
    <div class="flex items-center justify-center w-full col-span-6">
        <label
            for="dropzone-file"
            id="dropzone-label"
            class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100"
        >
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg
                    class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 16"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5
                    5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5
                    a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                    />
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-semibold">Click to upload</span> or drag and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    PDF, DOC, XLS, ZIP, JPG, MP3, MP4, etc.
                </p>
            </div>
            <!--
                NOTA:
                - Usa 'multiple' para permitir varios archivos.
                - Ajusta el 'accept' con las extensiones que requieras.
            -->
            <input
                id="dropzone-file"
                name="archivos[]"
                type="file"
                multiple
                class="hidden"
                accept=".jpg,.jpeg,.png,.tif,.bmp,.pdf,.doc,.docx,.txt,.xls,.xlsx,.xlsm,.csv,.rar,.zip,.mp3,.wma,.mp4,.wmv"
            />
        </label>
    </div>

    <!-- Contenedor donde se irán mostrando las tarjetas de los archivos -->
    <div id="filesContainer" class="mt-4 space-y-2"></div>


    <!-- URL input -->
    <div class="mt-[32px] mb-[32px] col-span-6 grid grid-cols-6 gap-2">
        <label class="font-bold col-span-6">7. Si tus archivos pesan más de 10 MB, puedes dejarnos un link de descarga</label>
        <input
            type="text"
            name="link"
            class="col-span-6 md:col-span-3 h-[48px] border-2 border-colorBlack rounded-[5px] px-4 focus:focus:outline-none focus:border-yellow-300 focus:rounded-none"
            value="{{ old('link') }}"
        />
    </div>
</div>

<script>
    // Array para almacenar los archivos seleccionados
    let selectedFiles = [];

    const fileInput = document.getElementById('dropzone-file');
    const filesContainer = document.getElementById('filesContainer');
    const labelZone = document.getElementById('dropzone-label');

    // Evento: selección de archivos al hacer click
    fileInput.addEventListener('change', () => {
        const files = Array.from(fileInput.files);
        selectedFiles = selectedFiles.concat(files);
        renderFilesList();
    });

    // Eventos de drag & drop para permitir arrastrar archivos al label
    labelZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        labelZone.classList.add('bg-gray-100'); // Estilo al arrastrar
    });

    labelZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        labelZone.classList.remove('bg-gray-100');
    });

    labelZone.addEventListener('drop', (e) => {
        e.preventDefault();
        labelZone.classList.remove('bg-gray-100');

        // Obtener archivos arrastrados
        const droppedFiles = Array.from(e.dataTransfer.files);
        selectedFiles = selectedFiles.concat(droppedFiles);

        renderFilesList();
    });

    /**
     * Pintar la lista de tarjetas debajo del input.
     * Muestra el nombre del archivo, su tamaño y el botón de eliminar.
     */
    function renderFilesList() {
        filesContainer.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            // Calculamos el tamaño del archivo en KB con 2 decimales
            const fileSizeKB = (file.size / 1024).toFixed(2);

            // Crear la card
            const card = document.createElement('div');
            card.className = 'flex items-center justify-between bg-white px-3 py-4 rounded-md shadow';

            // Insertar el contenido (nombre y peso)
            card.innerHTML = `
                <div class="flex items-center w-5/6 space-x-2">
                    <span class="text-sm font-medium truncate">${file.name}</span>
                    <span class="text-xs text-gray-500">(${fileSizeKB} KB)</span>
                </div>
                <button
                    type="button"
                    class="text-red-500 hover:text-red-700 remove-file"
                    data-index="${index}"
                    title="Eliminar archivo"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0 1
                                16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5
                                4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0
                                0-1 1v3m-4 0h14"
                        />
                    </svg>
                </button>
            `;

            filesContainer.appendChild(card);
        });

        // Listeners de eliminar
        filesContainer.querySelectorAll('.remove-file').forEach(btn => {
            btn.addEventListener('click', removeFile);
        });
    }

    /**
     * Eliminar un archivo del array (selectedFiles) y volver a pintar.
     */
    function removeFile(event) {
        const index = parseInt(event.currentTarget.getAttribute('data-index'));
        selectedFiles.splice(index, 1);
        renderFilesList();
    }
</script>
