@extends('adminlte::page')

@section('title', 'Usuarios y Roles')

@section('content_header')
    <h1>Usuarios y Roles</h1>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                <h5>Lista de Roles</h5>
                {!! Form::model($user, ['route' => ['asignar.update', $user->id], 'method' => 'put']) !!}
                @foreach($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->name) ? : false, ['class'=>'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('Asignar Roles',['class'=>'btn btn-outline-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
@stop

@section('css')
@stop

@section('js')
@stop