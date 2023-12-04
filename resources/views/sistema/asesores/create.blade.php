<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- SweetAlert CDN -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Asesor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('asesores.store') }}" method="post" enctype="multipart/form-data" id="registroAsesorForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="NombreAsesor" class="form-label">Nombre del Asesor</label>
                        <input type="text" class="form-control" name="NombreAsesor" id="NombreAsesor" placeholder="" required oninput="validarNombreAsesor()">
                        <small class="text-danger" id="errorNombreAsesor"></small>
                    </div>
                    <div class="mb-3">
                        <label for="ProfesionAsesor" class="form-label">Profesion del Asesor</label> <br>
                        <select class="form-select" name="ProfesionAsesor" id="ProfesionAsesor" required oninput="validarProfesionAsesor()">
                            <option value="">Selecciona una Profesión</option>
                            <option value="Profesional SST">Profesional SST</option>
                            <option value="Tecnologo SST">Tecnologo SST</option>
                            <option value="Tecnico SST">Tecnico SST</option>
                        </select>
                        <small class="text-danger" id="errorProfesionAsesor"></small>
                    </div>
                    <div class="mb-3">
                        <label for="licenciaAsesor" class="form-label">Licencia del Asesor</label>
                        <input type="number" class="form-control" name="licenciaAsesor" id="licenciaAsesor" placeholder="" required oninput="validarLicenciaAsesor()">
                        <small class="text-danger" id="errorLicenciaAsesor"></small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Cambia el tipo de botón para activar la validación del formulario -->
                    <button type="button" class="btn btn-outline-primary" id="Guardar" onclick="validarFormularioAsesor()">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function mostrarSweetAlert(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text
        });
    }
 
    function validarNombreAsesor() {
        var nombreAsesor = document.getElementById('NombreAsesor').value;
        var nombreValido = /^[a-zA-Z\s]+$/.test(nombreAsesor);
        document.getElementById('errorNombreAsesor').innerText = nombreAsesor ? (nombreValido ? '' : 'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';
        return nombreValido;

    }

    
    function validarProfesionAsesor() {
        var profesionAsesor = document.getElementById('ProfesionAsesor').value;
        var profesionValida = /^[a-zA-Z\s]+$/.test(profesionAsesor);
        document.getElementById('errorProfesionAsesor').innerText = profesionAsesor ? (profesionValida ? '' : 'asdf') : 'Selecciona una Profesión';
        return profesionValida;
    }

    
    function validarLicenciaAsesor() {
        var licenciaAsesor = document.getElementById('licenciaAsesor').value;
        var licenciaValida = /^\d+$/.test(licenciaAsesor);
        document.getElementById('errorLicenciaAsesor').innerText = licenciaAsesor ? (licenciaValida ? '' : 'La licencia no es válido, solo numeros y espacios') : 'Campo obligatorio';
        return licenciaValida;
    }
    
    document.getElementById('NombreAsesor').addEventListener('input', validarNombreAsesor);
    document.getElementById('ProfesionAsesor').addEventListener('input', validarProfesionAsesor);
    document.getElementById('licenciaAsesor').addEventListener('input', validarLicenciaAsesor);

    function validarFormularioAsesor() {
        var formularioValido = true;
        formularioValido = formularioValido && validarNombreAsesor();
        formularioValido = formularioValido && validarProfesionAsesor();
        formularioValido = formularioValido && validarLicenciaAsesor();

        if (formularioValido) {
        var form = document.getElementById('registroAsesorForm');
        form.submit();
    } else {
        mostrarSweetAlert('error', 'Error', 'Por favor, complete todos los campos obligatorios.');
    }
    }
</script>