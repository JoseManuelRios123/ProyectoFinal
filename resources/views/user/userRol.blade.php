@extends('adminlte::page')

@section('title', 'Usuarios y Roles')

@section('content_header')
    <h1>Usuarios y Roles</h1>
@stop

@section('content')
    {!! Form::model($user, ['route' => ['asignar.update', $user->id], 'method' => 'put']) !!}

    <label>
        {!! Form::checkbox('roles[]', 'Ver Clientes', $user->hasAnyRole('Ver Clientes') ? : false, ['class'=>'mr-1', 'id' => 'verClientes']) !!}
        Ver Clientes
    </label>
    <div id="otrosClientes" style="display: none;">
        <label>
            {!! Form::checkbox('roles[]', 'Crear Cliente', $user->hasAnyRole('Crear Cliente') ? : false, ['class'=>'mr-1']) !!}
            Crear Cliente
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Editar Cliente', $user->hasAnyRole('Editar Cliente') ? : false, ['class'=>'mr-1']) !!}
            Editar Cliente
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Eliminar Cliente', $user->hasAnyRole('Eliminar Cliente') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Cliente
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('roles[]', 'Ver Asesores', $user->hasAnyRole('Ver Asesores') ? : false, ['class'=>'mr-1', 'id' => 'verAsesores']) !!}
    Ver Asesores
    </label>
    <div id="otrosAsesores" style="display: none;">
        <label>
            {!! Form::checkbox('roles[]', 'Crear Asesores', $user->hasAnyRole('Crear Asesores') ? : false, ['class'=>'mr-1']) !!}
            Crear Asesores
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Editar Asesores', $user->hasAnyRole('Editar Asesores') ? : false, ['class'=>'mr-1']) !!}
            Editar Asesores
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Eliminar Asesores', $user->hasAnyRole('Eliminar Asesores') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Asesores
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('roles[]', 'Ver Proyectos', $user->hasAnyRole('Ver Proyectos') ? : false, ['class'=>'mr-1', 'id' => 'verProyectos']) !!}
    Ver Proyectos
    </label>
    <div id="otrosProyectos" style="display: none;">
        <label>
            {!! Form::checkbox('roles[]', 'Crear Proyectos', $user->hasAnyRole('Crear Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Crear Proyectos
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Editar Proyectos', $user->hasAnyRole('Editar Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Editar Proyectos
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Eliminar Proyectos', $user->hasAnyRole('Eliminar Proyectos') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Proyectos
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('roles[]', 'Ver Actividades', $user->hasAnyRole('Ver Actividades') ? : false, ['class'=>'mr-1', 'id' => 'verActividades']) !!}
    Ver Actividades
    </label>
    <div id="otrosActividades" style="display: none;">
        <label>
            {!! Form::checkbox('roles[]', 'Ver Carpetas', $user->hasAnyRole('Ver Carpetas') ? : false, ['class'=>'mr-1']) !!}
            Ver Carpetas
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Crear Actividades', $user->hasAnyRole('Crear Actividades') ? : false, ['class'=>'mr-1']) !!}
            Crear Actividades
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Editar Actividades', $user->hasAnyRole('Editar Actividades') ? : false, ['class'=>'mr-1']) !!}
            Editar Actividades
        </label>
        <label>
            {!! Form::checkbox('roles[]', 'Eliminar Actividades', $user->hasAnyRole('Eliminar Actividades') ? : false, ['class'=>'mr-1']) !!}
            Eliminar Actividades
        </label>
    </div>
    <br>
    <label>
    {!! Form::checkbox('roles[]', 'Ver Evidencias', $user->hasAnyRole('Ver Evidencias') ? : false, ['class'=>'mr-1', 'id' => 'verEvidencias']) !!}
    Ver Evidencias
    </label>
    <div id="otrosEvidencias" style="display: none;">
    <label>
        {!! Form::checkbox('roles[]', 'Subir Evidencias', $user->hasAnyRole('Subir Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Subir Evidencias
    </label>
    <label>
        {!! Form::checkbox('roles[]', 'Eliminar Evidencias', $user->hasAnyRole('Eliminar Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Eliminar Evidencias
    </label>
    <label>
        {!! Form::checkbox('roles[]', 'Descargar Evidencias', $user->hasAnyRole('Descargar Evidencias') ? : false, ['class'=>'mr-1']) !!}
        Descargar Evidencias
    </label>
    </div>
    <br>
    {!! Form::submit('Asignar Permisos',['class'=>'btn btn-outline-primary mt-3']) !!}
    {!! Form::close() !!}
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
        
        // Primero, seleccionamos el checkbox y el contenedor
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
