@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $cantidadUsuarios }}</h3>
                <p>Usuarios creados</p>
            </div>
            <!-- icon -->
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="users" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small card -->

        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $cantidadProyectos }}</h3>


                <p>Proyectos creados</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <a href="proyectos" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $cantidadClientes }}</h3>
                <p>Clientes creados</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="clientes" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $cantidadAsesores }}</h3>
                <p>Asesores creados</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <a href="asesores" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div id="container" style="height: 500px; min-width: 600px"></div>
<script>
    Highcharts.chart('container', @json($chart));
</script>
@stop