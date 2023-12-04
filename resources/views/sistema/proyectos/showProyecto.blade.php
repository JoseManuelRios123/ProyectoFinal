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
                            <select id="carpeta" name="carpeta" class="form-control w-fit">
                                <option value="">Seleccione una Carpeta</option>
                                <option value="hacer">Hacer</option>
                                <option value="verificar">Verificar</option>
                                <option value="planear">Planear</option>
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
                                                    <th scope="col">Hacer</th>
                                                    <th scope="col">Verificar</th>
                                                    <th scope="col">Planear</th>
                                                    <th scope="col">Actuar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @foreach ($proyectos->hacerArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        @endcan
                                                        @can('Descargar Evidencias')
                                                        <a href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />

                                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Eliminar Evidencias')
                                                        <a class="text-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach ($proyectos->verificarArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        @endcan
                                                        @can('Descargar Evidencias')
                                                        <a href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />

                                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Eliminar Evidencias')
                                                        <a class="text-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @endforeach

                                                    </td>

                                                    <td>
                                                        @foreach ($proyectos->planearArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        @endcan
                                                        @can('Descargar Evidencias')
                                                        <a href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />

                                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Eliminar Evidencias')
                                                        <a class="text-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($proyectos->actuarArchivos as $archivo)
                                                        @can('Ver Evidencias')
                                                        <p>{{ $archivo->nombre }} </p>
                                                        @endcan
                                                        @can('Descargar Evidencias')
                                                        <a href="{{ route('proyectos.archivos.downloadFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" />

                                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Eliminar Evidencias')
                                                        <a class="text-danger" href="{{ route('proyectos.archivos.deleteFile', ['id' => $archivo->id_archivo]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                            </svg>
                                                        </a>
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