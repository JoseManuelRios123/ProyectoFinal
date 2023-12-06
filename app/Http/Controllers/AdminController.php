<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Asesore;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // ...
        $Usuarios = User::all();
        $cantidadUsuarios = $Usuarios->count();
        $usuariosDes = User::where('status', 0)->get();
        $usuariosDesabilitados = $usuariosDes->count();

        $proyectos = Proyecto::all();
        $cantidadProyectos = Proyecto::count(); // Obtén la cantidad de proyectos
        $clientes = Cliente::all();
        $cantidadClientes = $clientes->count(); // Obtén la cantidad de clientes
        $asesores = Asesore::all();
        $cantidadAsesores = $asesores->count(); // Obtén la cantidad de asesores
        $proyectosTerminados = Proyecto::where('Progreso', 100)->get();
        $cantidadProyectosTerminados = $proyectosTerminados->count();

        // Crea un gráfico de barras
        $chart = [
            'chart' => [
                'type' => 'bar'
            ],
            'title' => [
                'text' => 'Cantidad de Clientes, Asesores, Proyectos y Usuarios'
            ],
            'xAxis' => [
                'categories' => ['Usuarios', 'Clientes', 'Asesores', 'Proyectos', 'Proyectos terminados']
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Cantidad'
                ]
            ],
            'series' => [
                [
                    'name' => 'Cantidad',
                    'data' => [$cantidadUsuarios, $cantidadClientes, $cantidadAsesores, $cantidadProyectos, $cantidadProyectosTerminados]
                ]
            ]
        ];


        // Devuelve la vista con los datos de proyectos y otras variables necesarias
        return view('admin.index', [
            'clientes' => $clientes,
            'asesores' => $asesores,
            'cantidadUsuarios' => $cantidadUsuarios,
            'usuariosDesabilitados' => $usuariosDesabilitados,
            'cantidadProyectos' => $cantidadProyectos, // Pasa la cantidad de proyectos a la vista
            'cantidadClientes' => $cantidadClientes, // Pasa la cantidad de clientes a la vista
            'cantidadAsesores' => $cantidadAsesores, // Pasa la cantidad de asesores a la vista
            'cantidadProyectosTerminados' => $cantidadProyectosTerminados, // Pasa la cantidad de asesores a la vista
            'chart' => $chart, // Pasa el gráfico a la vista
        ]);
    }
}
