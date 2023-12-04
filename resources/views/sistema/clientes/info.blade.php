<!-- Agrega el enlace a SweetAlert en la sección head -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal de Edición de Cliente -->
<div class="modal fade" id="edit{{$cliente->id_cliente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="post"
        enctype="multipart/form-data" id="editarClienteForm{{$cliente->id_cliente}}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="NombreE" class="form-label">Razón Social</label>
            <input type="text" class="form-control" name="NombreE" id="NombreE{{$cliente->id_cliente}}" aria-describedby="helpId"
              value="{{ $cliente->nombre_cliente }}" required>
            <small class="text-danger" id="errorNombreE{{$cliente->id_cliente}}"></small>
          </div>
          <div class="mb-3">
            <label for="NITE" class="form-label">NIT</label>
            <input type="text" class="form-control" name="NITE" id="NITE{{$cliente->id_cliente}}" aria-describedby="helpId"
              value="{{ $cliente->nit }}" required>
            <small class="text-danger" id="errorNITE{{$cliente->id_cliente}}"></small>
          </div>
          <div class="mb-3">
            <label for="DireccionE" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="DireccionE" id="DireccionE{{$cliente->id_cliente}}" aria-describedby="helpId"
              value="{{ $cliente->direccion }}" required>
            <small class="text-danger" id="errorDireccionE{{$cliente->id_cliente}}"></small>
          </div>
          <div class="mb-3">
            <label for="TelefonoE" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="TelefonoE" id="TelefonoE{{$cliente->id_cliente}}" aria-describedby="helpId"
              value="{{ $cliente->telefono }}" required>
            <small class="text-danger" id="errorTelefonoE{{$cliente->id_cliente}}"></small>
          </div>
          <div class="mb-3">
            <label for="ActividadComercialE" class="form-label">Actividad Comercial</label>
            <input type="text" class="form-control" name="ActividadComercialE" id="ActividadComercialE{{$cliente->id_cliente}}"
              aria-describedby="helpId" value="{{ $cliente->actividad_comercial }}" required>
            <small class="text-danger" id="errorActividadComercialE{{$cliente->id_cliente}}"></small>
          </div>
          <div class="mb-3">
            <label for="Codigo_CIUU" class="form-label">Codigo CIUU</label>
            <input type="text" class="form-control" name="Codigo_CIUU" id="Codigo_CIUU{{$cliente->id_cliente}}"
              aria-describedby="helpId" value="{{ $cliente->codigo_ciuu }}" required>
            <small class="text-danger" id="errorCodigo_CIUUE{{$cliente->id_cliente}}"></small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
          <!-- Cambia el tipo de botón para activar la validación del formulario -->
          <button type="button" class="btn btn-outline-primary" onclick="validarFormularioEdicionCliente('{{$cliente->id_cliente}}')">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript para validar el formulario de edición de cliente -->
<script>
  function mostrarSweetAlert(icon, title, text) {
    Swal.fire({
      icon: icon,
      title: title,
      text: text
    });
  }

  function validarNombreE(idCliente) {
    var nombreClienteE = document.getElementById('NombreE' + idCliente).value;
    var nombreValidoE = /^[a-zA-Z\s]+$/.test(nombreClienteE);
    document.getElementById('errorNombreE' + idCliente).innerText = nombreClienteE ? (nombreValidoE ? '' : 'El nombre no válido, solo letras y espacios') : 'Campo obligatorio';
  }

  function validarNITE(idCliente) {
    var NITClienteE = document.getElementById('NITE' + idCliente).value;
    var nitValidoE = /^\d+$/.test(NITClienteE);
    document.getElementById('errorNITE' + idCliente).innerText = NITClienteE ? (nitValidoE ? '' : 'El nit no válido, solo numeros y espacios') : 'Campo obligatorio';
  }

  function validarTelefonoE(idCliente) {
    var telefonoClienteE = document.getElementById('TelefonoE' + idCliente).value;
    var telefonoValidoE = /^\d+$/.test(telefonoClienteE);
    document.getElementById('errorTelefonoE' + idCliente).innerText = telefonoClienteE ? (telefonoValidoE ? '' : 'El teléfono no válido, solo numeros y espacios') : 'Campo obligatorio';
  }

  function validarDireccionE(idCliente) {
    var direccionClienteE = document.getElementById('DireccionE' + idCliente).value;
    document.getElementById('errorDireccionE' + idCliente).innerText = direccionClienteE ? (direccionClienteE ? '' : 'La dirección no tiene los caracteres adecuados') : 'Campo obligatorio';
  }

  function validarActividadComercialE(idCliente) {
    var actividadComercialClienteE = document.getElementById('ActividadComercialE' + idCliente).value;
    document.getElementById('errorActividadComercialE' + idCliente).innerText = actividadComercialClienteE ? (actividadComercialClienteE ? '' : 'La actividad comercial no tiene los caracteres adecuados') : 'Campo obligatorio';
  }

  function validarCodigo_CIUUE(idCliente) {
    var codigoCIUUClienteE = document.getElementById('Codigo_CIUU' + idCliente).value;
    document.getElementById('errorCodigo_CIUUE' + idCliente).innerText = codigoCIUUClienteE ? (codigoCIUUClienteE ? '' : 'El codigo CIUU no válido, solo numeros y espacios') : 'Campo obligatorio';
  }

  function validarFormularioEdicionCliente(idCliente) {
    validarNombreE(idCliente);
    validarNITE(idCliente);
    validarTelefonoE(idCliente);
    validarDireccionE(idCliente);
    validarActividadComercialE(idCliente);
    validarCodigo_CIUUE(idCliente);

    var nombreClienteE = document.getElementById('NombreE' + idCliente).value;
    var NITClienteE = document.getElementById('NITE' + idCliente).value;
    var direccionClienteE = document.getElementById('DireccionE' + idCliente).value;
    var telefonoClienteE = document.getElementById('TelefonoE' + idCliente).value;
    var actividadComercialClienteE = document.getElementById('ActividadComercialE' + idCliente).value;
    var codigoCIUUClienteE = document.getElementById('Codigo_CIUU' + idCliente).value;

    if (!nombreClienteE || !NITClienteE || !direccionClienteE || !telefonoClienteE || !actividadComercialClienteE || !codigoCIUUClienteE) {
      // Si hay algún error de validación, muestra el SweetAlert de error
      mostrarSweetAlert('error', 'Error', 'Por favor, completa los campos correctamente.');
    } else {
      // Si todo es válido, puedes mostrar una alerta de éxito
      

      // Aquí debes enviar el formulario
      document.getElementById('editarClienteForm' + idCliente).submit();
    }
  }

  // Agrega los event listeners para la validación en tiempo real
  document.getElementById('NombreE{{$cliente->id_cliente}}').addEventListener('input', function() { validarNombreE('{{$cliente->id_cliente}}'); });
  document.getElementById('NITE{{$cliente->id_cliente}}').addEventListener('input', function() { validarNITE('{{$cliente->id_cliente}}'); });
  document.getElementById('TelefonoE{{$cliente->id_cliente}}').addEventListener('input', function() { validarTelefonoE('{{$cliente->id_cliente}}'); });
  document.getElementById('DireccionE{{$cliente->id_cliente}}').addEventListener('input', function() { validarDireccionE('{{$cliente->id_cliente}}'); });
  document.getElementById('ActividadComercialE{{$cliente->id_cliente}}').addEventListener('input', function() { validarActividadComercialE('{{$cliente->id_cliente}}'); });
  document.getElementById('Codigo_CIUU{{$cliente->id_cliente}}').addEventListener('input', function() { validarCodigo_CIUUE('{{$cliente->id_cliente}}'); });
</script>



<!-- Agrega el enlace a SweetAlert en la sección head -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="post" enctype="multipart/form-data" id="eliminarClienteForm{{$cliente->id_cliente}}">
        @csrf
        @method('DELETE')
          <script>
            function confirmarEliminacion(idCliente) {
              Swal.fire({
                title: 'Eliminar Cliente',
                text: '¿Estás seguro de eliminar este cliente?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Si el usuario confirma, enviar el formulario de eliminación
                  document.getElementById('eliminarClienteForm' + idCliente).submit();
                }
              });
            }
          </script>
</form>


