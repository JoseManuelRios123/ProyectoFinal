<!-- Modal de Edición -->
<div class="modal fade" id="edit{{ $asesor->id_asesor }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Asesor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('asesores.update', $asesor->id_asesor) }}" method="post" enctype="multipart/form-data" id="editarAsesorForm{{$asesor->id_asesor}}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="NombreAsesorE" class="form-label">Nombre del Asesor</label>
            <input type="text" class="form-control" name="NombreAsesorE" id="NombreAsesorE" value="{{ $asesor->nombre_asesor }}" required>
            <small class="text-danger" id="errorNombreAsesorE"></small>
          </div>
          <div class="mb-3">
            <label for="ProfesionAsesorE" class="form-label">Profesion del Asesor</label>
            <select class="form-select" name="ProfesionAsesorE" id="ProfesionAsesorE" required oninput="validarProfesionAsesor()">
                <option value="">Selecciona una Profesión</option>
                <option value="Profesional SST">Profesional SST</option>
                <option value="Tecnologo SST">Tecnologo SST</option>
                <option value="Tecnico SST">Tecnico SST</option>
            </select>
            <small class="text-danger" id="errorProfesionAsesorE"></small>
        </div>
          <div class="mb-3">
            <label for="licenciaAsesorE" class="form-label">Licencia del Asesor</label>
            <input type="number" class="form-control" name="licenciaAsesorE" id="licenciaAsesorE" value="{{ $asesor->licencia_asesor }}" required>
            <small class="text-danger" id="errorLicenciaAsesorE"></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-outline-primary" onclick="validarFormularioEdicion(event)">Guardar</button>
        </div>
      </form>
    </div>
  </div>
 </div>
 
 <script>
  document.getElementById('NombreAsesorE').addEventListener('input', validarNombreAsesor);
  document.getElementById('ProfesionAsesorE').addEventListener('input', validarProfesionAsesor);
  document.getElementById('licenciaAsesorE').addEventListener('input', validarLicenciaAsesor);
 
  function validarNombreAsesor() {
    var nombreAsesorE = document.getElementById('NombreAsesorE').value;
    var nombreValido = /^[a-zA-Z\s]+$/.test(nombreAsesorE);
    document.getElementById('errorNombreAsesorE').innerText = nombreAsesorE ? (nombreValido ? '' : 'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';
  }
 
  function validarProfesionAsesor() {
    var profesionAsesorE = document.getElementById('ProfesionAsesorE').value;
    var profesionValida = /^[a-zA-Z\s]+$/.test(profesionAsesorE);
    document.getElementById('errorProfesionAsesorE').innerText = profesionAsesorE ? (profesionValida ? '' : 'Profesión no válida (solo letras y espacios)') : 'Campo obligatorio';
  }
 
  function validarLicenciaAsesor() {
    var licenciaAsesorE = document.getElementById('licenciaAsesorE').value;
    document.getElementById('errorLicenciaAsesorE').innerText = licenciaAsesorE ? '' : 'Campo obligatorio';
  }
 
  function validarFormularioEdicion(event) {
    var nombreAsesorE = document.getElementById('NombreAsesorE').value;
    var profesionAsesorE = document.getElementById('ProfesionAsesorE').value;
    var licenciaAsesorE = document.getElementById('licenciaAsesorE').value;
 
    var nombreValido = /^[a-zA-Z\s]+$/.test(nombreAsesorE);
    var profesionValida = /^[a-zA-Z\s]+$/.test(profesionAsesorE);
 
    document.getElementById('errorNombreAsesorE').innerText = nombreAsesorE ? (nombreValido ? '' : 'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';
    document.getElementById('errorProfesionAsesorE').innerText = profesionAsesorE ? (profesionValida ? '' : 'Profesión no válida (solo letras y espacios)') : 'Campo obligatorio';
    document.getElementById('errorLicenciaAsesorE').innerText = licenciaAsesorE ? '' : 'Campo obligatorio';

    // Mostrar SweetAlert si hay errores
    if (!nombreAsesorE || !profesionAsesorE || !licenciaAsesorE || !nombreValido || !profesionValida) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, completa los campos correctamente.',
      });
      event.preventDefault();
    } 
  }
</script>


<form action="{{ route('asesores.destroy', $asesor->id_asesor) }}" method="post" enctype="multipart/form-data" id="eliminarAsesorForm{{ $asesor->id_asesor }}">
        @csrf
        @method('DELETE')
        <script>
          function confirmarEliminacion(idAsesor) {
            Swal.fire({
              title: 'Eliminar Asesor',
              text: '¿Estás seguro de eliminar este asesor?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Sí, eliminar',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                document.getElementById('eliminarAsesorForm' + idAsesor).submit();
              }
            });
          }
        </script>
</form>
