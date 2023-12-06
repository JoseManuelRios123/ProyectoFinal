<!-- Agrega el enlace a SweetAlert en tu HTML (puedes descargarlo o usar la CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal de Registro de Actividad -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Actividad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('proyectos.plandework.store', ['id' => $proyectos->idProyecto]) }}" method="post" enctype="multipart/form-data" onsubmit="return validarFormularioActividad()">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="idProyectos" class="form-label">Proyecto Asociado</label>
                            <select name="idProyectos" id="idProyectos" class="form-control">
                                <option value="{{ $proyectos->idProyecto }}"> {{ $proyectos->Nombre }} </option>
                            </select>
                            <small class="text-danger" id="errorIdProyectos"></small>
                        </div>
                        <div class="mb-3">
                            <label for="idAsesores" class="form-label">Asesor a Cargo</label>
                            <select name="idAsesores" id="idAsesores" class="form-control">
                                @foreach ($asesores as $asesor)
                                <option value="{{ $asesor->id_asesor }}"> {{ $asesor->nombre_asesor }} </option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="errorIdAsesores"></small>
                        </div>
                        <div class="mb-3">
                            <label for="NombreActividad" class="form-label">Nombre de la Actividad</label>
                            <input type="text" class="form-control" name="NombreActividad" id="NombreActividad" placeholder="">
                            <small class="text-danger" id="errorNombreActividad"></small>
                        </div>
                        <div class="mb-3">
                            <label for="FechaInicio" class="form-label">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" class="form-control" name="FechaInicio" id="FechaInicio" placeholder="">
                            <small class="text-danger" id="errorFechaInicio"></small>
                        </div>
                        <div class="mb-3">
                            <label for="FechaFin" class="form-label">Fecha y Hora de Fin</label>
                            <input type="datetime-local" class="form-control" name="FechaFin" id="FechaFin" placeholder="">
                            <small class="text-danger" id="errorFechaFin"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para validar el formulario de edición de proyecto en tiempo real -->
<script>
    function mostrarSweetAlert(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text
        });
    }

    function validarNombreActividad() {
        var nombreActividad = document.getElementById('NombreActividad').value;
        var nombreActividadValido = /^[a-zA-Z\s]+$/.test(nombreActividad);

        document.getElementById('errorNombreActividad').innerText = nombreActividad ? (nombreActividadValido ? '' : 'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';

        return nombreActividadValido;
    }

    function validarFormularioActividad() {
        var idProyectos = document.getElementById('idProyectos').value;
        var idAsesores = document.getElementById('idAsesores').value;
        var fechaInicio = document.getElementById('FechaInicio').value;
        var fechaFin = document.getElementById('FechaFin').value;

        var proyectosValido = idProyectos !== "";
        var asesoresValido = idAsesores !== "";
        var fechaInicioValida = fechaInicio !== "";
        var fechaFinValida = fechaFin !== "";

        var fechaInicioObj = new Date(fechaInicio);
        var fechaFinObj = new Date(fechaFin);
        var fechasValidas = fechaInicioObj < fechaFinObj;

        document.getElementById('errorIdProyectos').innerText = proyectosValido ? '' : 'Selecciona un Proyecto';
        document.getElementById('errorIdAsesores').innerText = asesoresValido ? '' : 'Selecciona un Asesor';
        document.getElementById('errorFechaInicio').innerText = fechaInicioValida ? (fechasValidas ? '' : 'La fecha de inicio debe ser anterior a la fecha de fin') : 'Selecciona una fecha y hora de inicio';
        document.getElementById('errorFechaFin').innerText = fechaFinValida ? '' : 'Selecciona una fecha y hora de fin';

        var nombreActividadValido = validarNombreActividad();

        if (!proyectosValido || !asesoresValido || !fechaInicioValida || !fechaFinValida || !fechasValidas || !nombreActividadValido) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, corrige los errores en el formulario',
            });
            return false;
        }

        return true;
    }

    document.getElementById('NombreActividad').addEventListener('input', validarNombreActividad);
</script>