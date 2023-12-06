<?php

namespace App\Http\Controllers;

use App\Filters\AsesorFilter;
use App\Http\Requests\StoreAsesoreRequest;
use App\Http\Requests\UpdateAsesoreRequest;
use App\Http\Resources\AsesorCollection;
use App\Http\Resources\AsesoreResource;
use App\Models\Asesore;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index(Request $request)
    {
        $filter = new AsesorFilter();
        $queryItems = $filter->transform($request);
        $includeProyectos = $request->query('includeProyectos');
        $asesores = Asesore::where($queryItems);

        if ($includeProyectos) {
            $asesores = $asesores->with('proyectos');
        }

        $asesores = Asesore::all();

        // Devuelve la vista con los datos de asesores
        return view('sistema.asesores.index', [
            'asesores' => $asesores,
        ]);
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
    public function store(StoreAsesoreRequest $request)
    {
        
        
        $asesores=new Asesore;
        $asesores->nombre_asesor=$request->input('NombreAsesor');
        $asesores->profesion_asesor=$request->input('ProfesionAsesor');
        $asesores->licencia_asesor=$request->input('licenciaAsesor');
        $asesores->save();
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asesore $asesores, $id)
    {
        $asesores = Asesore::find($id);

        if (!$asesores) {
            return response()->json(['message' => 'Asesor no encontrado'], 404);
        }


        $includeProyectos = request()->query('includeProyectos');
        if ($includeProyectos) {
            return new AsesoreResource($asesores->loadMissing('proyectos'));
        }
        return new AsesoreResource($asesores);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsesoreRequest $request, Asesore $asesores, $id)
    {
        $asesores=Asesore::find($id);
        $asesores->nombre_asesor=$request->input('NombreAsesorE');
        $asesores->profesion_asesor=$request->input('ProfesionAsesorE');
        $asesores->licencia_asesor=$request->input('licenciaAsesorE');
        $asesores->update($request->all());
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asesores = Asesore::find($id);

        if ($asesores->proyectos()->count() > 0) {
            return response()->json(['message' => 'No puedes eliminar este asesor porque está asociado a un proyecto.'], 400);
        }

        $asesores->delete();

        return response()->json(['message' => 'Asesor eliminado exitosamente.']);
    }
}

