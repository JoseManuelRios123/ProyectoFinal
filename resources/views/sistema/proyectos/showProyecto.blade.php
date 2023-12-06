@extends('home')
@extends('adminlte::page')

@section('content')
@can('Ver Evidencias')
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>

    <section class="intro">
        <div class="bg-image h-100" style="background-color: #f5f7fa;">
            <div class="mask d-flex align-items-center h-100">

                <div class="container">
                    @can('Subir Evidencias')
                    <form action="{{ route('proyectos.evidencia.uploadFiles', $proyectos->idProyecto) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary hh">Subir</button>
                            <select name="IDPDT" id="IDPDT" class="form-control" required>
                                <option value="">Seleccione una actividad</option>
                                @foreach ($plandework as $pdt)
                                    <option value="{{ $pdt->id_pdt }}">{{ $pdt->nombre_actividad }}</option>
                                @endforeach
                            </select>

                            <select id="carpeta" name="carpeta" class="form-control w-fit">
                                <option value="">Seleccione una Carpeta</option>
                                <option value="planear">Planear</option>
                                <option value="hacer">Hacer</option>
                                <option value="verificar">Verificar</option>
                                <option value="actuar">Actuar</option>
                            </select>
                            <div class="custom-file">
                                <input type="file" name="archivos[]" multiple class="custom-file-input" id="customFile">
                                <label class="custom-file-label" id="customFileLabel" for="customFile">Seleccionar archivos</label>
                            </div>
                        </div>
                        
                        <script>
                            document.getElementById("customFile").addEventListener("change", function() {
                                var fileName = this.files.length > 1 ? this.files.length + " archivos seleccionados" : this.files[0].name;
                                document.getElementById("customFileLabel").innerHTML = fileName;
                            });
                        </script>

                        <script>
                            document.getElementById('carpeta').addEventListener('change', function() {
                                const selectedCarpeta = this.value;
                                const archivoInput = document.querySelector('input[name="archivos[]"]');

                                archivoInput.setAttribute('name', selectedCarpeta + '[]');
                                archivoInput.setAttribute('id', selectedCarpeta);
                                archivoInput.setAttribute('multiple', 'multiple');
                            });
                        </script>
                    </form>
                    @endcan
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 200px">
                                        <table class="table table-striped mb-0">
                                            <thead style="background-color: #3F96FF; ">
                                                <tr>
                                                    <th scope="col">Planear</th>
                                                    <th scope="col">Hacer</th>
                                                    <th scope="col">Verificar</th>
                                                    <th scope="col">Actuar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @foreach ($proyectos->planearArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#show{{ $archivo->id_archivo }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </a>
                                                        <div class="modal fade" id="show{{$archivo->id_archivo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detalles del archivo</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ $archivo->nombre }} </p>

                                                                        <!-- Check if $archivo has associated activity information -->
                                                                        @if($archivo->plandetrabajo)
                                                                            <p>Asesor: {{ $archivo->plandetrabajo->asesore->nombre_asesor }}</p>
                                                                            <p>Actividad: {{ $archivo->plandetrabajo->nombre_actividad }}</p>
                                                                        @else
                                                                            <p>No se encontró información de la actividad asociada</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @can('Descargar Evidencias')
                                                                            <a class="btn btn-outline-primary" href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Descargar
                                                                            </a>
                                                                        @endcan
                                                                        @can('Eliminar Evidencias')
                                                                            <a class="btn btn-outline-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Eliminar
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @endcan
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($proyectos->hacerArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#show{{ $archivo->id_archivo }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </a>
                                                        <div class="modal fade" id="show{{$archivo->id_archivo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detalles del archivo</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ $archivo->nombre }} </p>

                                                                        <!-- Check if $archivo has associated activity information -->
                                                                        @if($archivo->plandetrabajo)
                                                                            <p>Asesor: {{ $archivo->plandetrabajo->asesore->nombre_asesor }}</p>
                                                                            <p>Actividad: {{ $archivo->plandetrabajo->nombre_actividad }}</p>
                                                                        @else
                                                                            <p>No se encontró información de la actividad asociada</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @can('Descargar Evidencias')
                                                                            <a class="btn btn-outline-primary" href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Descargar
                                                                            </a>
                                                                        @endcan
                                                                        @can('Eliminar Evidencias')
                                                                            <a class="btn btn-outline-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Eliminar
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endcan
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($proyectos->verificarArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#show{{ $archivo->id_archivo }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </a>
                                                        <div class="modal fade" id="show{{$archivo->id_archivo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detalles del archivo</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ $archivo->nombre }} </p>

                                                                        <!-- Check if $archivo has associated activity information -->
                                                                        @if($archivo->plandetrabajo)
                                                                            <p>Asesor: {{ $archivo->plandetrabajo->asesore->nombre_asesor }}</p>
                                                                            <p>Actividad: {{ $archivo->plandetrabajo->nombre_actividad }}</p>
                                                                        @else
                                                                            <p>No se encontró información de la actividad asociada</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @can('Descargar Evidencias')
                                                                            <a class="btn btn-outline-primary" href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Descargar
                                                                            </a>
                                                                        @endcan
                                                                        @can('Eliminar Evidencias')
                                                                            <a class="btn btn-outline-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Eliminar
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endcan
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($proyectos->actuarArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#show{{ $archivo->id_archivo }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                        </a>
                                                        <div class="modal fade" id="show{{$archivo->id_archivo}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detalles del archivo</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ $archivo->nombre }} </p>

                                                                        <!-- Check if $archivo has associated activity information -->
                                                                        @if($archivo->plandetrabajo)
                                                                            <p>Asesor: {{ $archivo->plandetrabajo->asesore->nombre_asesor }}</p>
                                                                            <p>Actividad: {{ $archivo->plandetrabajo->nombre_actividad }}</p>
                                                                        @else
                                                                            <p>No se encontró información de la actividad asociada</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @can('Descargar Evidencias')
                                                                            <a class="btn btn-outline-primary" href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Descargar
                                                                            </a>
                                                                        @endcan
                                                                        @can('Eliminar Evidencias')
                                                                            <a class="btn btn-outline-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                                                Eliminar
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endcan
                                                        @endforeach

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</body>

</html>
@endcan
@endsection