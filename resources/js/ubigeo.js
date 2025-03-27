document.addEventListener('DOMContentLoaded', function() {
    // Rutas a tus archivos JSON (ajusta según tu servidor)
    const urlDepartamentos = 'c:/Apache/htdocs/mesaPartes/resources/js/ubigeo/ubigeo_peru_2016_departamentos.json';
    const urlProvincias   = 'c:/Apache/htdocs/mesaPartes/resources/js/ubigeo/ubigeo_peru_2016_provincias.json';
    const urlDistritos    = 'c:/Apache/htdocs/mesaPartes/resources/js/ubigeo/ubigeo_peru_2016_distritos.json';

    // Referencias a los elementos <select>
    const departamentoSelect = document.getElementById('natural_departamento');
    const provinciaSelect    = document.getElementById('natural_provincia');
    const distritoSelect     = document.getElementById('natural_distrito');

    // 1. Carga los departamentos
    fetch(urlDepartamentos)
        .then(response => response.json())
        .then(departamentos => {
            departamentos.forEach(departamento => {
                const option = document.createElement('option');
                option.value = departamento.id;
                option.textContent = departamento.name;
                departamentoSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar departamentos:', error);
        });

    // 2. Cuando cambie el departamento, actualizar la lista de provincias
    departamentoSelect.addEventListener('change', function() {
        const selectedDepartamento = this.value;

        // Limpia las opciones actuales de provincia y distrito
        provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
        distritoSelect.innerHTML = '<option value="">Selecciona un distrito</option>';

        if (selectedDepartamento) {
            fetch(urlProvincias)
                .then(response => response.json())
                .then(provincias => {
                    const filteredProvincias = provincias.filter(provincia => provincia.departamento_id === selectedDepartamento);
                    filteredProvincias.forEach(provincia => {
                        const option = document.createElement('option');
                        option.value = provincia.id;
                        option.textContent = provincia.name;
                        provinciaSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar provincias:', error);
                });
        }
    });

    // 3. Cuando cambie la provincia, actualizar la lista de distritos
    provinciaSelect.addEventListener('change', function() {
        const selectedProvincia = this.value;

        // Limpia las opciones actuales de distrito
        distritoSelect.innerHTML = '<option value="">Selecciona un distrito</option>';

        if (selectedProvincia) {
            fetch(urlDistritos)
                .then(response => response.json())
                .then(distritos => {
                    const filteredDistritos = distritos.filter(distrito => distrito.provincia_id === selectedProvincia);
                    filteredDistritos.forEach(distrito => {
                        const option = document.createElement('option');
                        option.value = distrito.id;
                        option.textContent = distrito.name;
                        distritoSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar distritos:', error);
                });
        }
    });
});
