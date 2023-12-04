@extends('home')
@extends('adminlte::page')

@section('content')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="">
@endsection
@can('Ver Asesores')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br><br>
        @if(session('errorA'))
        <div class="alert alert-danger">
            {{ session('errorA') }}
        </div>
        @endif
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <br>
        @can('Crear Asesores')
        <button type="button" class="btn btn-outline-primary p-2" style="--bs-bg-opacity: .5;" data-bs-toggle="modal" data-bs-target="#create">
            Registrar Asesor
        </button>
        @endcan
        <div class="table-responsive">
            <br>
            <table class="table" id="Asesores">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Asesor</th>
                        <th scope="col">Profesión Asesor</th>
                        <th scope="col">Licencia Asesor</th>
                        <th scope="col">Acciones</th>


                    </tr>
                </thead>

                <tbody>
                    @foreach($asesores as $asesor)
                    <tr class="">
                        <td scope="row"> {{$asesor->id_asesor}} </td>
                        <td> {{$asesor->nombre_asesor}} </td>
                        <td> {{$asesor->profesion_asesor}} </td>
                        <td> {{$asesor->licencia_asesor}} </td>
                        <td>
                            @can('Editar Asesores')
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$asesor->id_asesor}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            @endcan
                            @can('Eliminar Asesores')
                            <button type="button" class="btn btn-outline-danger" onclick="confirmarEliminacion('{{ $asesor->id_asesor }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg>
                            </button>
                            @endcan
                        </td>

                    </tr>
                    @include('sistema.asesores.info')
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('sistema.asesores.create')
    </div>
    <div class="col-md-1"></div>
</div>
@endcan
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
<script>
    $(document).ready(function() {
        $('#Asesores').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
            }
        });
    });
</script>
@endsection