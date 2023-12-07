@extends('home')
@extends('adminlte::page')

@section('content')

@role('Ver Actividades')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br><br>
        <h3>Planes de Trabajo - {{$proyectos->Nombre}}</h3>
        <br>
        
        @role('Crear Actividades')
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Registrar Actividad
        </button>
        @endrole
        @role('Ver Carpetas')
        <a class="btn btn-success float-right" href="{{ route('proyectos.evidencia.show', $proyectos->idProyecto) }}">Carpetas
        </a>
        @endrole
        
        <div class="table-responsive">
            <br>
            <table class="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Asesor a Cargo</th>
                        <th scope="col">Nombre Actividad</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Finalización</th>
                        @role('Editar Actividades|Eliminar Actividades')
                        <th scope="col">Acciones</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($plandework as $pdt)
                    <tr class="">
                        <td scope="row"> {{$pdt->id_pdt}} </td>
                        <td> {{$pdt->asesore->nombre_asesor}} </td>
                        <td> {{$pdt->nombre_actividad}} </td>
                        <td> {{$pdt->fecha_inicio}} </td>
                        <td> {{$pdt->fecha_fin}} </td>
                        <td>
                        @role('Editar Actividades')
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$pdt->id_pdt}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        </button>
                        @endrole
                        @role('Eliminar Actividades')
                        <button type="button" class="btn btn-outline-danger" onclick="confirmarEliminacion('{{ $pdt->id_pdt }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                        </button>
                        @endrole
                        </td>
                    </tr>
                    @include('plandework.info')
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('plandework.create')
    </div>
    <div class="col-md-1"></div>
</div>
@endrole
@endsection