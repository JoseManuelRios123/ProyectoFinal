<!-- Agrega el enlace a SweetAlert en la sección head -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal de Edición de Proyecto -->
<div class="modal fade" id="edit{{$proyecto->idProyecto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Proyecto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('proyectos.update', $proyecto->idProyecto)}}" method="post" enctype="multipart/form-data" onsubmit="return validarFormularioEdicionProyecto()">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="" class="form-label">Cliente Asociado</label>
            <select name="idClientes" class="form-control">
              @foreach ($clientes as $cliente)
              <option value="{{ $cliente->id_cliente }}" {{ $proyecto->idClientes == $cliente->id_cliente ? 'selected' : '' }}>
                {{$cliente->nombre_cliente}}
              </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Asesor a Cargo</label>
            <select name="idAsesores" class="form-control">
              @foreach ($asesores as $asesor)
              <option value="{{ $asesor->id_asesor }}" {{ $proyecto->idAsesores == $asesor->id_asesor ? 'selected' : '' }}>
                {{$asesor->nombre_asesor}}
              </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre del proyecto</label>
            <input type="text" class="form-control" name="Nombre" id="Nombre" value="{{$proyecto->Nombre}}">
            <small class="text-danger" id="errorNombre"></small>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Riesgo</label>
            <select class="form-select" name="Riesgos">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
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
  document.getElementById('Nombre').addEventListener('input', function() { validarFormularioEdicionProyecto(); });
  function validarFormularioEdicionProyecto() {
    var nombreProyecto = document.getElementById('Nombre').value;
    var nombreProyectoValida = /^[a-zA-Z\s]+$/.test(nombreProyecto);

    document.getElementById('errorNombre').innerText = nombreProyecto ? (nombreProyectoValida ? '' : 'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';

    if (!nombreProyectoValida) {
      // Si hay errores, muestra SweetAlert de error
      mostrarSweetAlert('error', 'Error', 'Por favor, corrige los errores en el formulario');
      return false; // Evita que el formulario se envíe si hay errores
    } else {
      // Si no hay errores, muestra SweetAlert de éxito
 
      return true; // Permite que el formulario se envíe
    }
  }

 
</script>

<form action="{{route('proyectos.destroy',$proyecto->idProyecto)}}" method="post" enctype="multipart/form-data" id="eliminarProyectoForm{{$proyecto->idProyecto}}">
        @csrf
        @method('DELETE')<script>
        function confirmarEliminacionProyecto(idProyecto) {
          Swal.fire({
            title: 'Eliminar Proyecto',
            text: '¿Estás seguro de eliminar este proyecto?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              // Envía el formulario de eliminación si el usuario confirma
              document.getElementById('eliminarProyectoForm' + idProyecto).submit();
            }
          });
        }
      </script>
</form>
