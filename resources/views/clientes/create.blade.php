<!-- Agrega el enlace a SweetAlert en la sección head -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Modal de Registro de Cliente -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('clientes.store') }}" method="post" enctype="multipart/form-data"
                id="registroClienteForm">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Razón Social</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre"
                                aria-describedby="helpId" value="{{ old('Nombre') }}" required maxlength="255"
                                oninput="validarNombre()">
                            <small class="text-danger" id="errorNombre"></small>
                        </div>
                        <div class="mb-3">
                            <label for="NIT" class="form-label">NIT</label>
                            <input type="text" class="form-control" name="NIT" id="NIT"
                                aria-describedby="helpId" value="{{ old('NIT') }}" required
                                oninput="validarNIT()">
                            <small class="text-danger" id="errorNIT"></small>
                        </div>
                        <div class="mb-3">
                            <label for="Direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="Direccion" id="Direccion"
                                aria-describedby="helpId" value="{{ old('Direccion') }}" required
                                oninput="validarDireccion()">
                            <small class="text-danger" id="errorDireccion"></small>
                        </div>
                        <div class="mb-3">
                            <label for="Telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="Telefono" id="Telefono"
                                aria-describedby="helpId" value="{{ old('Telefono') }}" required
                                oninput="validarTelefono()">
                            <small class="text-danger" id="errorTelefono"></small>
                        </div>
                        <div class="mb-3">
                            <label for="ActividadComercial" class="form-label">Actividad Comercial</label>
                            <input type="text" class="form-control" name="ActividadComercial" id="ActividadComercial"
                                aria-describedby="helpId" value="{{ old('ActividadComercial') }}" required
                                oninput="validarActividadComercial()">
                            <small class="text-danger" id="errorActividadComercial"></small>
                        </div>
                        <div class="mb-3">
                            <label for="Codigo_CIUU" class="form-label">Codigo CIUU</label>
                            <input type="text" class="form-control" name="Codigo_CIUU" id="Codigo_CIUU"
                                aria-describedby="helpId" value="{{ old('Codigo_CIUU') }}" required
                                oninput="validarCodigoCIUU()">
                            <small class="text-danger" id="errorCodigo_CIUU"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <!-- Cambia el tipo de botón para activar la validación del formulario -->
                    <button type="button" class="btn btn-outline-primary" id="Guardar" onclick="validarFormularioCliente()">Guardar</button>
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
 
    function validarNombre() {
        var nombre = document.getElementById('Nombre').value;
        var nombreValido = /^[a-zA-Z\s]+$/.test(nombre);
        document.getElementById('errorNombre').innerText = nombre ? (nombreValido ? '' : 'El nombre no válido, solo letras y espacios') : 'Campo obligatorio';
        return nombreValido;
    }
 
    function validarNIT() {
        var nit = document.getElementById('NIT').value;
        var nitValido = /^\d+$/.test(nit);
        document.getElementById('errorNIT').innerText = nit ? (nitValido ? '' : 'El nit no válido, solo numeros y espacios') : 'Campo obligatorio';
        return nitValido;
    }
 
    function validarDireccion() {
        var direccion = document.getElementById('Direccion').value;
        var direccionValida = /^[a-zA-Z0-9\s\-\#\,\.]+$/.test(direccion);
        document.getElementById('errorDireccion').innerText = direccion ? (direccionValida ? '' : 'La dirección no tiene los caracteres adecuados') : 'Campo obligatorio';
        return direccionValida;
    }
 
    function validarTelefono() {
        var telefono = document.getElementById('Telefono').value;
        var telefonoValido = /^\d+$/.test(telefono);
        document.getElementById('errorTelefono').innerText = telefono ? (telefonoValido ? '' : 'El teléfono no válido, solo numeros y espacios') : 'Campo obligatorio';
        return telefonoValido;
    }
 
    function validarActividadComercial() {
        var actividadComercial = document.getElementById('ActividadComercial').value;
        var actividadComercialValida = /^[a-zA-Z\s]+$/.test(actividadComercial);
        document.getElementById('errorActividadComercial').innerText = actividadComercial ? (actividadComercialValida ? '' : 'La actividad comercial solo puede tener letras y espaciós ') : 'Campo obligatorio';
        return actividadComercialValida;
    }
 
    function validarCodigoCIUU() {
        var codigoCIUU = document.getElementById('Codigo_CIUU').value;
        var codigoCIUUValido = /^\d+$/.test(codigoCIUU);
        document.getElementById('errorCodigo_CIUU').innerText = codigoCIUU ? (codigoCIUUValido ? '' : 'El codigo CIUU no válido, solo numeros y espacios') : 'Campo obligatorio';
        return codigoCIUUValido;
    }
 
    document.getElementById('Nombre').addEventListener('input', validarNombre);
    document.getElementById('NIT').addEventListener('input', validarNIT);
    document.getElementById('Direccion').addEventListener('input', validarDireccion);
    document.getElementById('Telefono').addEventListener('input', validarTelefono);
    document.getElementById('ActividadComercial').addEventListener('input', validarActividadComercial);
    document.getElementById('Codigo_CIUU').addEventListener('input', validarCodigoCIUU);
    
    function validarFormularioCliente() {
    var formularioValido = true;
    formularioValido = formularioValido && validarNombre();
    formularioValido = formularioValido && validarNIT();
    formularioValido = formularioValido && validarDireccion();
    formularioValido = formularioValido && validarTelefono();
    formularioValido = formularioValido && validarActividadComercial();
    formularioValido = formularioValido && validarCodigoCIUU();

    if (formularioValido) {
        var form = document.getElementById('registroClienteForm');
        form.submit();
    } else {
        mostrarSweetAlert('error', 'Error', 'Por favor, complete todos los campos obligatorios.');
    }
}

 </script>