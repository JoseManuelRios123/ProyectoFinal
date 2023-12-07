<!-- Añade el enlace a SweetAlert en tu HTML (puedes descargarlo o usar la CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@foreach($plandework as $pdt)
  <div class="modal fade" id="edit{{$pdt->id_pdt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Actividad</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('plandework.update',$pdt->id_pdt)}}" method="post" enctype="multipart/form-data" onsubmit="return validarFormularioEdicion('{{ $pdt->id_pdt }}')">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <label for="" class="form-label">Proyecto Asociado</label>
              <select name="idProyectosE" id="idProyectosE" class="form-control">
                <option value="{{ $proyectos->idProyecto }}"> {{$proyectos->Nombre}} </option>
              </select>
              <small class="text-danger" id="errorIdProyectosE_{{ $pdt->id_pdt }}"></small>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Asesor a Cargo</label>
              <select name="idAsesoresE" id="idAsesoresE" class="form-control">
                @foreach ($asesores as $asesor)
                <option value="{{ $asesor->id_asesor }}"> {{$asesor->nombre_asesor}} </option>
                @endforeach
              </select>
              <small class="text-danger" id="errorIdAsesoresE_{{ $pdt->id_pdt }}"></small>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Nombre de la Actividad</label>
              <input type="text" class="form-control" name="NombreActividadE" id="NombreActividadE_{{ $pdt->id_pdt }}" value="{{$pdt->nombre_actividad}}" oninput="validarCampo('{{ $pdt->id_pdt }}', 'NombreActividadE')">
              <small class="text-danger" id="errorNombreActividadE_{{ $pdt->id_pdt }}"></small>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Fecha y Hora de Inicio</label>
              <input type="datetime-local" class="form-control" name="FechaInicioE" id="FechaInicioE" value="{{$pdt->fecha_inicio}}">
              <small class="text-danger" id="errorFechaInicioE_{{ $pdt->id_pdt }}"></small>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Fecha y Hora de Fin</label>
              <input type="datetime-local" class="form-control" name="FechaFinE" id="FechaFinE" value="{{$pdt->fecha_fin}}">
              <small class="text-danger" id="errorFechaFinE_{{ $pdt->id_pdt }}"></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-outline-primary" onclick="guardarActividadEdicion('{{ $pdt->id_pdt }}')">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach

<script>
  // Función de validación en tiempo real
  function validarCampo(id, campo) {
    var valor = document.getElementById(campo + '_' + id).value;
    var mensajeError = document.getElementById('error' + campo + '_' + id);
 
    if (!/^[a-zA-Z0-9\s]+$/.test(valor)) {
      mensajeError.innerText = 'El campo es obligatorio ';
    } else {
      mensajeError.innerText = 'Este campo solo puede contener letras y números';
    }
  }

  // Función de validación y SweetAlert para la Edición de Actividad
  function validarFormularioEdicion(id) {
    var idProyectosE = document.getElementById('idProyectosE').value;
    var idAsesoresE = document.getElementById('idAsesoresE').value;
    var nombreActividadE = document.getElementById('NombreActividadE_' + id).value;
    var fechaInicioE = document.getElementById('FechaInicioE').value;
    var fechaFinE = document.getElementById('FechaFinE').value;
 
    var proyectosValidoE = idProyectosE !== "";
    var asesoresValidoE = idAsesoresE !== "";
    var nombreActividadValidoE = /^[a-zA-Z0-9\s]+$/.test(nombreActividadE);
    var fechaInicioValidaE = fechaInicioE !== "";
    var fechaFinValidaE = fechaFinE !== "";
 
    // Validar que la fecha de inicio sea anterior a la fecha de fin
    var fechaInicioObjE = new Date(fechaInicioE);
    var fechaFinObjE = new Date(fechaFinE);
    var fechasValidasE = fechaInicioObjE < fechaFinObjE;
 
    document.getElementById('errorIdProyectosE_' + id).innerText = proyectosValidoE ? '' : 'Selecciona un Proyecto';
    document.getElementById('errorIdAsesoresE_' + id).innerText = asesoresValidoE ? '' : 'Selecciona un Asesor';
    document.getElementById('errorNombreActividadE_' + id).innerText = nombreActividadValidoE ? '' : 'El campo es obligatorio';
    document.getElementById('errorFechaInicioE_' + id).innerText = fechaInicioValidaE ? (fechasValidasE ? '' : 'La fecha de inicio debe ser anterior a la fecha de fin') : 'Selecciona una fecha y hora de inicio';
    document.getElementById('errorFechaFinE_' + id).innerText = fechaFinValidaE ? '' : 'Selecciona una fecha y hora de fin';
 
    // Evitar el envío del formulario si hay errores
    if (!proyectosValidoE || !asesoresValidoE || !nombreActividadValidoE || !fechaInicioValidaE || !fechaFinValidaE || !fechasValidasE) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Por favor, corrige los errores en el formulario',
      });
      return false; // No envía el formulario
    }
 
    // Si todo es válido, puedes mostrar una alerta de éxito

  }

  // Puedes agregar esta función si deseas realizar alguna acción adicional al guardar la actividad editada
  function guardarActividadEdicion(id) {
    // Puedes agregar lógica adicional aquí si es necesario
    console.log('Actividad editada con éxito. ID:', id);
  }
</script>




<form action="{{ route('plandework.destroy', $pdt->id_pdt) }}" method="post" enctype="multipart/form-data" id="eliminarPDTForm{{$pdt->id_pdt}}">
    @csrf
    @method('DELETE')
      <script>
        function confirmarEliminacion(idPDT) {
          Swal.fire({
            title: 'Eliminar Actividad',
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
              document.getElementById('eliminarPDTForm' + idPDT).submit();
            }
          });
        }
      </script>
</form>
