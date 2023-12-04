@extends('adminlte::page')

@section('title', 'Usuarios y Roles')

@section('content_header')
    <h1>Usuarios y Roles</h1>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{$roles->name}}
        </div>
        <div class="card-body">
    {!! Form::model($roles, ['route' => ['roles.update', $roles], 'method' => 'put']) !!}

    <label>
        {!! Form::checkbox('permisos[]', 'Ver Clientes', $roles->hasPermissionTo('Ver Clientes') ? : false, ['class'=>'mr-1', 'id' => 'verClientes']) !!}
        Ver Clientes
    </label>
    <div id="otrosClientes" style="display: none;">
        <label>
            {!! Form::checkbox('permisos[]', 'Crear Cliente', $roles->hasPermissionTo('Crear Cliente') ? : false, ['class'=>'mr-1']) !!}
            Crear Cliente
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Editar Cliente', $roles->hasPermissionTo('Editar Cliente') ? : false, ['class'=>'mr-1']) !!}
            Editar Cliente
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Eliminar Cliente', $roles->hasPermissionTo('Eliminar Cliente') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Cliente
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('permisos[]', 'Ver Asesores', $roles->hasPermissionTo('Ver Asesores') ? : false, ['class'=>'mr-1', 'id' => 'verAsesores']) !!}
    Ver Asesores
    </label>
    <div id="otrosAsesores" style="display: none;">
        <label>
            {!! Form::checkbox('permisos[]', 'Crear Asesores', $roles->hasPermissionTo('Crear Asesores') ? : false, ['class'=>'mr-1']) !!}
            Crear Asesores
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Editar Asesores', $roles->hasPermissionTo('Editar Asesores') ? : false, ['class'=>'mr-1']) !!}
            Editar Asesores
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Eliminar Asesores', $roles->hasPermissionTo('Eliminar Asesores') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Asesores
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('permisos[]', 'Ver Proyectos', $roles->hasPermissionTo('Ver Proyectos') ? : false, ['class'=>'mr-1', 'id' => 'verProyectos']) !!}
    Ver Proyectos
    </label>
    <div id="otrosProyectos" style="display: none;">
        <label>
            {!! Form::checkbox('permisos[]', 'Ver Carpetas', $roles->hasPermissionTo('Ver Carpetas') ? : false, ['class'=>'mr-1']) !!}
            Ver Carpetas
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Crear Proyectos', $roles->hasPermissionTo('Crear Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Crear Proyectos
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Editar Proyectos', $roles->hasPermissionTo('Editar Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Editar Proyectos
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Eliminar Proyectos', $roles->hasPermissionTo('Eliminar Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Proyectos
        </label>
    <br>
    <label>
    {!! Form::checkbox('permisos[]', 'Ver Actividades', $roles->hasPermissionTo('Ver Actividades') ? : false, ['class'=>'mr-1', 'id' => 'verActividades']) !!}
    Ver Actividades
    </label>
    <div id="otrosActividades" style="display: none;">
        <label>
            {!! Form::checkbox('permisos[]', 'Crear Actividades', $roles->hasPermissionTo('Crear Actividades') ? : false, ['class'=>'mr-1']) !!}
            Crear Actividades
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Editar Actividades', $roles->hasPermissionTo('Editar Actividades') ? : false, ['class'=>'mr-1']) !!}
            Editar Actividades
        </label>
        <label>
            {!! Form::checkbox('permisos[]', 'Eliminar Actividades', $roles->hasPermissionTo('Eliminar Actividades') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Actividades
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('permisos[]', 'Ver Evidencias', $roles->hasPermissionTo('Ver Evidencias') ? : false, ['class'=>'mr-1', 'id' => 'verEvidencias']) !!}
    Ver Evidencias
    </label>
    <div id="otrosEvidencias" style="display: none;">
    <label>
        {!! Form::checkbox('permisos[]', 'Subir Evidencias', $roles->hasPermissionTo('Subir Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Subir Evidencias
    </label>
    <label>
        {!! Form::checkbox('permisos[]', 'Descargar Evidencias', $roles->hasPermissionTo('Descargar Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Descargar Evidencias
    </label>
    <label>
        {!! Form::checkbox('permisos[]', 'Eliminar Evidencias', $roles->hasPermissionTo('Eliminar Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Eliminar Evidencias
    </label>
    </div>
    <br>
    
    <br>
    </div>
    <br>
    <label>
        {!! Form::checkbox('permisos[]', 'Admin Configuracion', $roles->hasPermissionTo('Admin Configuracion') ? : false, ['class'=>'mr-1']) !!}
        Admin Configuracion
    </label>
    <br>
    {!! Form::submit('Actualizar Rol',['class'=>'btn btn-outline-primary mt-3']) !!}
    {!! Form::close() !!}
    </div>

</div>
@stop

@section('css')
@stop

@section('js')
    <script>
        // Primero, seleccionamos el checkbox y el contenedor
        var verClientes = document.querySelector('#verClientes');
        var otrosClientes = document.querySelector('#otrosClientes');

        // Luego, agregamos un event listener al checkbox "Ver Clientes"
        verClientes.addEventListener('change', function() {
            // Si "Ver Clientes" está seleccionado, mostramos el contenedor
            if (this.checked) {
                otrosClientes.style.display = "block";
            } else {
                // Si no, ocultamos el contenedor y deseleccionamos los otros checkboxes
                otrosClientes.style.display = "none";
                otrosClientes.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Finalmente, verificamos el estado inicial del checkbox "Ver Clientes"
        if (verClientes.checked) {
            otrosClientes.style.display = "block";
        }

        // Primero, seleccionamos el checkbox y el contenedor
        var verAsesores = document.querySelector('#verAsesores');
        var otrosAsesores = document.querySelector('#otrosAsesores');

        // Luego, agregamos un event listener al checkbox "Ver Asesores"
        verAsesores.addEventListener('change', function() {
            // Si "Ver Asesores" está seleccionado, mostramos el contenedor
            if (this.checked) {
                otrosAsesores.style.display = "block";
            } else {
                // Si no, ocultamos el contenedor y deseleccionamos los otros checkboxes
                otrosAsesores.style.display = "none";
                otrosAsesores.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Finalmente, verificamos el estado inicial del checkbox "Ver Asesores"
        if (verAsesores.checked) {
            otrosAsesores.style.display = "block";
        }
        
        // Primero, seleccionamos el checkbox y el contenedor
        var verProyectos = document.querySelector('#verProyectos');
        var otrosProyectos = document.querySelector('#otrosProyectos');

        // Luego, agregamos un event listener al checkbox "Ver Proyectos"
        verProyectos.addEventListener('change', function() {
            // Si "Ver Proyectos" está seleccionado, mostramos el contenedor
            if (this.checked) {
                otrosProyectos.style.display = "block";
            } else {
                // Si no, ocultamos el contenedor y deseleccionamos los otros checkboxes
                otrosProyectos.style.display = "none";
                otrosProyectos.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Finalmente, verificamos el estado inicial del checkbox "Ver Proyectos"
        if (verProyectos.checked) {
            otrosProyectos.style.display = "block";
        }
        // Primero, seleccionamos el checkbox y el contenedor
        var verActividades = document.querySelector('#verActividades');
        var otrosActividades = document.querySelector('#otrosActividades');

        // Luego, agregamos un event listener al checkbox "Ver Actividades"
        verActividades.addEventListener('change', function() {
            // Si "Ver Actividades" está seleccionado, mostramos el contenedor
            if (this.checked) {
                otrosActividades.style.display = "block";
            } else {
                // Si no, ocultamos el contenedor y deseleccionamos los otros checkboxes
                otrosActividades.style.display = "none";
                otrosActividades.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Finalmente, verificamos el estado inicial del checkbox "Ver Actividades"
        if (verActividades.checked) {
            otrosActividades.style.display = "block";
        }
        
        var verEvidencias = document.querySelector('#verEvidencias');
        var otrosEvidencias = document.querySelector('#otrosEvidencias');

        // Luego, agregamos un event listener al checkbox "Ver Evidencias"
        verEvidencias.addEventListener('change', function() {
            // Si "Ver Evidencias" está seleccionado, mostramos el contenedor
            if (this.checked) {
                otrosEvidencias.style.display = "block";
            } else {
                // Si no, ocultamos el contenedor y deseleccionamos los otros checkboxes
                otrosEvidencias.style.display = "none";
                otrosEvidencias.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Finalmente, verificamos el estado inicial del checkbox "Ver Evidencias"
        if (verEvidencias.checked) {
            otrosEvidencias.style.display = "block";
        }

    </script>

@stop
