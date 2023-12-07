@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Roles y Permisos</h1>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                {{ $roles->name }}
            </div>
            <div class="card-body">
                <h5>Lista de Permisos</h5>
                {!! Form::model($roles, ['route' => ['roles.update', $roles],'method'=>'put']) !!}
                @foreach($permisos as $permiso)
                    <div>
                        <label>
                            {!! Form::checkbox('permisos[]', $permiso->id, $roles->hasPermissionTo($permiso->id) ? : false, ['class'=>'mr-1']) !!}
                            {{ $permiso->name }}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('Asignar Permisos',['class'=>'btn btn-outline-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
