<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('sistema.user.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles = Role::create(['name' => $request->input('Nombre')]);
        return redirect()->back()->with('status', 'Rol creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Role $roles)
    {
        $roles = Role::find($id);
        $permisos = Permission::all();
        
        $permisosNecesarios = ['Ver Clientes', 'Crear Cliente', 'Editar Cliente', 'Eliminar Cliente', 'Ver Asesores', 'Crear Asesores', 'Editar Asesores', 'Eliminar Asesores', 'Ver Proyectos' , 'Ver Carpetas', 'Crear Proyectos', 'Editar Proyectos', 'Eliminar Proyectos', 'Ver Actividades', 'Crear Actividades', 'Editar Actividades', 'Eliminar Actividades', 'Ver Evidencias', 'Subir Evidencias', 'Eliminar Evidencias', 'Descargar Evidencias', 'Admin Configuracion'];

        $permisosExistentes = $permisos->pluck('name')->toArray();

        $faltanPermisos = array_diff($permisosNecesarios, $permisosExistentes);

        if (!empty($faltanPermisos)) {
            return redirect()->back()->with('error', 'Debes crear todos los permisos antes de asignarlos a un rol.');
        }
        return view('sistema.user.rolePermiso', compact('roles', 'permisos'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $roles = Role::find($id);
        $permisos = Permission::all();

        $permisosNecesarios = ['Ver Clientes', 'Crear Cliente', 'Editar Cliente', 'Eliminar Cliente', 'Ver Asesores', 'Crear Asesores', 'Editar Asesores', 'Eliminar Asesores', 'Ver Proyectos' , 'Ver Carpetas', 'Crear Proyectos', 'Editar Proyectos', 'Eliminar Proyectos', 'Ver Actividades', 'Crear Actividades', 'Editar Actividades', 'Eliminar Actividades', 'Ver Evidencias', 'Subir Evidencias', 'Eliminar Evidencias', 'Descargar Evidencias', 'Admin Configuracion'];

        $permisosExistentes = $permisos->pluck('name')->toArray();

        $faltanPermisos = array_diff($permisosNecesarios, $permisosExistentes);

        if (!empty($faltanPermisos)) {
            return redirect()->back()->with('error', 'Debes crear todos los permisos antes de asignarlos a un rol.');
        }
        $permisos = $request->permisos;

        $roles->syncPermissions($permisos);

        return redirect()->route('roles.edit', $roles);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
