<!-- Añade el enlace a SweetAlert en tu HTML (puedes descargarlo o usar la CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal de Registro de Proyecto -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Proyecto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('proyectos.store') }}" method="post" enctype="multipart/form-data"
                onsubmit="return validarFormularioProyecto()">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <!-- Campo: Cliente Asociado -->
                        <div class="mb-3">
                            <label for="idClientes" class="form-label">Cliente Asociado</label>
                            <select name="idClientes" id="idClientes" class="form-control" required>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id_cliente }}"> {{ $cliente->nombre_cliente }} </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo: Asesor a Cargo -->
                        <div class="mb-3">
                            <label for="idAsesores" class="form-label">Asesor a Cargo</label>
                            <select name="idAsesores" id="idAsesores" class="form-control" required>
                                @foreach ($asesores as $asesor)
                                    <option value="{{ $asesor->id_asesor }}"> {{ $asesor->nombre_asesor }} </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo: Nombre del Proyecto -->
                        <div class="mb-3">
                            <label for="NombreProyecto" class="form-label">Nombre del proyecto</label>
                            <input type="text" class="form-control" name="Nombre" id="NombreProyecto" placeholder=""
                                oninput="validarNombreProyecto()">
                            <small class="text-danger" id="errorNombreProyecto"></small>
                        </div>

                        <!-- Campo: Riesgo del Proyecto -->
                        <div class="mb-3">
                            <label for="RiesgoProyecto" class="form-label">Riesgo</label>
                            <select class="form-select" name="Riesgos" id="RiesgoProyecto">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Botones del pie del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
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

  function validarNombreProyecto() {
      var nombreProyecto = document.getElementById('NombreProyecto').value;
      var nombreProyectoValida = /^[a-zA-Z\s]+$/.test(nombreProyecto);
      document.getElementById('errorNombreProyecto').innerText = nombreProyecto ? (nombreProyectoValida ? '' :'Nombre no válido (solo letras y espacios)') : 'Campo obligatorio';
      return nombreProyectoValida;
  }

  document.getElementById('NombreProyecto').addEventListener('input', validarNombreProyecto);

  function validarFormularioProyecto() {
      var nombreProyectoValido = validarNombreProyecto();
      if (!nombreProyectoValido) {
          mostrarSweetAlert('error', 'Error', 'Por favor, completa el campo del nombre del proyecto.');
          return false;
      }
      return true;
  }
</script>
