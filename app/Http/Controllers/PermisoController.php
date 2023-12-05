<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permission::all();
        return view('sistema.user.permisos', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createAllPermisos() {
        $permisos = ['Ver Clientes', 'Crear Cliente', 'Editar Cliente', 'Eliminar Cliente', 'Ver Asesores', 'Crear Asesores', 'Editar Asesores', 'Eliminar Asesores', 'Ver Proyectos' , 'Ver Carpetas', 'Crear Proyectos', 'Editar Proyectos', 'Eliminar Proyectos', 'Ver Actividades', 'Crear Actividades', 'Editar Actividades', 'Eliminar Actividades', 'Ver Evidencias', 'Subir Evidencias', 'Eliminar Evidencias', 'Descargar Evidencias', 'Aprobar Actividades', 'Admin Configuracion'];
    
        foreach($permisos as $permiso) {
            if (!Permission::where('name', $permiso)->exists()) {
                Permission::create(['name' => $permiso]);

                
            }
        }
    
        return redirect()->back()->with('status', 'Permisos creados exitosamente');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permisos = Permission::create(['name' => $request->input('Nombre')]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
