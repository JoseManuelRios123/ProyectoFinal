<?php

namespace App\Http\Controllers;

use App\Filters\ProyectoFilter;
use App\Http\Requests\BulkStoreProyectoRequest;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Http\Resources\AsesoreResource;
use App\Http\Resources\ClienteResource;
use App\Http\Resources\ProyectoCollection;
use App\Http\Resources\ProyectoResource;
use App\Models\Archivo;
use App\Models\Proyecto;
use App\Models\Cliente;
use App\Models\Asesore;
use App\Models\Carpeta;
use App\Models\Plandetrabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProyectosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    public function index(Request $request)
    {
        $filter = new ProyectoFilter();
        $clientes = Cliente::paginate();
        $asesores = Asesore::paginate();
        $queryItems = $filter->transform($request);
        $includeClientes = $request->query('includeClientes');
        $includeAsesores = $request->query('includeAsesores');
        $includeCA = $request->query('includeCA');
        $proyectos = Proyecto::where($queryItems);

        if ($includeClientes) {
            $proyectos = $proyectos->with('cliente');
        }

        if ($includeAsesores) {
            $proyectos = $proyectos->with('asesore');
        }

        if ($includeCA) {
            $proyectos = $proyectos->with(['cliente', 'asesore']);
        }

        $proyectos = Proyecto::all();
        $plandework = Plandetrabajo::all();
        $asesores = Asesore::all();



        // Devuelve la vista con los datos de proyectos y otras variables necesarias
        return view('sistema.proyectos.index', [
            'proyectos' => $proyectos,
            'clientes' => $clientes,
            'asesores' => $asesores,
            'plandework' => $plandework,
        ]);
    }



    public function create()
    {

    }

    public function updateProgress($proyectoId, $progreso)
    {
        try {
            $proyecto = Proyecto::findOrFail($proyectoId);
            $proyecto->Progreso = $progreso;
            $proyecto->save();

            return response()->json(['message' => 'Progreso actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el progreso'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'idClientes' => 'required',
            'idAsesores' => 'required',
            'Nombre' => 'required',
            'Riesgos' => 'required',
        ]);

        $proyecto = new Proyecto;
        $proyecto->idClientes = $request->input('idClientes');
        $proyecto->idAsesores = $request->input('idAsesores');
        $proyecto->Nombre = $request->input('Nombre');
        $proyecto->Riesgo = $request->input('Riesgos');
        $proyecto->Progreso = $request->input('Progreso', 0);
        $proyecto->save();

        $carpetas = ['hacer', 'planear', 'verificar', 'actuar'];
        foreach ($carpetas as $carpeta) {
            Storage::makeDirectory('evidencia/' . $proyecto->id_Proyecto . '/' . $carpeta);
            $nuevaCarpeta = new Carpeta();
            $nuevaCarpeta->nombre = $carpeta;
            $nuevaCarpeta->id_Proyecto = $proyecto->idProyecto;
            $nuevaCarpeta->save();
        }

        return redirect()->back();
    }


    public function bulkStore(BulkStoreProyectoRequest $request){
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr, ['Riesgos']);
        });
        Proyecto::insert($bulk->toArray());
    }

    public function destroyP($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        $carpetas = $proyectos->carpetas;

        foreach ($carpetas as $carpeta) {
            $archivos = $carpeta->archivos;
            foreach ($archivos as $archivo) {
                Storage::delete($archivo->ruta);
                $archivo->delete();
            }
        }

        $proyectos->carpetas()->delete();
        $proyectos->delete();

        return redirect()->route('Evidencia.show', $proyectos->idProyecto)->with('success', 'Archivos subidos exitosamente');
    }

    public function showProyecto($id){
        $proyectos = Proyecto::find($id);
        $plandework = Plandetrabajo::all();
        $asesores = Asesore::all();
        $carpetas = $proyectos->carpetas;
        return view('sistema.proyectos.showProyecto', compact('plandework', 'proyectos', 'carpetas', 'asesores'));
    }

    public function show($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        $plandework = Plandetrabajo::all();
        $plandework = $proyectos->plandetrabajos; // Accede a las actividades de Plan de Trabajo a través de la relación
        $carpetas = $proyectos->carpetas;
        $asesores = Asesore::all();
        $clientes = Cliente::all();
        $includeClientes = request()->query('includeClientes');
        $includeAsesores = request()->query('includeAsesores');
        
        if ($includeClientes) {
            return new ProyectoResource($proyectos->loadMissing('cliente'));
        }
        if ($includeAsesores) {
            return new ProyectoResource($proyectos->loadMissing('asesore'));
        }    
        
        // Asegúrate de que $plandework esté siempre definido, incluso si está vacío
        $plandework = $plandework ?: collect(); // Podría usar collect() para crear una colección vacía
        
        return view('sistema.proyectos.show', compact('proyectos', 'plandework', 'asesores', 'clientes', 'carpetas'));
    }

    public function uploadFiles(Request $request, $id)
    {
        $proyectos = Proyecto::find($id);

        if (!$proyectos) {
            return redirect()->back()->with('error', 'No se encontró la evidencia con el ID proporcionado');
        }

        $proyectos = Proyecto::findOrFail($id);

        $carpetas = ['hacer', 'planear', 'verificar', 'actuar'];
        foreach ($carpetas as $carpeta) {
            if ($request->hasFile($carpeta)) {
                $archivos = $request->file($carpeta);
                foreach ($archivos as $archivo) {
                    $rutaArchivo = $archivo->store('proyectos.evidencia/' . $proyectos->idProyecto . '/' . $carpeta);

                    $nuevoArchivo = new Archivo();
                    $nuevoArchivo->nombre = $archivo->getClientOriginalName();
                    $nuevoArchivo->ruta = $rutaArchivo;
                    $nuevoArchivo->carpeta_id = Carpeta::where('id_Proyecto', $proyectos->idProyecto)->where('nombre', $carpeta)->first()->id_carpeta;

                    $activityID = $request->input('IDPDT');
                    $nuevoArchivo->IDPDT = $activityID;

                    $nuevoArchivo->save();
                }
            }
        }

        return redirect()->back();
    }



    public function downloadFile($id)
    {
        $archivo = Archivo::find($id);

        if (!$archivo) {
            return redirect()->back()->with('error', 'No se encontró el archivo con el ID proporcionado');
        }

        $ruta = storage_path('app/' . $archivo->ruta);

        if (file_exists($ruta)) {
            return response()->download($ruta, $archivo->nombre);
        } else {
            return redirect()->back()->with('error', 'El archivo no existe en el sistema de archivos');
        }
    }

    public function deleteFile($id)
    {
        $archivo = Archivo::find($id);

        if (!$archivo) {
            return redirect()->back()->with('error', 'No se encontró el archivo con el ID proporcionado');
        }

        $ruta = storage_path('app/' . $archivo->ruta);

        if (file_exists($ruta)) {
            // Eliminar el archivo físico de la carpeta de almacenamiento
            Storage::delete($archivo->ruta);

            // Eliminar el registro de la base de datos
            $archivo->delete();

            return redirect()->back()->with('success', 'El archivo ha sido eliminado exitosamente');
        } else {
            return redirect()->back()->with('error', 'El archivo no existe en el sistema de archivos');
        }
    }

    public function showFiles($evidenciaId)
    {
        $proyecto = Proyecto::findOrFail($evidenciaId);
        $carpetas = $proyecto->carpetas;

        // Cargar la relación 'carpetas.archivos.usuario' para evitar consultas adicionales
        $proyecto->load('carpetas.archivos.usuario');

        return view('archivos.show', compact('proyecto', 'carpetas'));
    }



    public function edit($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        return view('Evidencia.edit', compact('evidencia'));
    }

    public function update(UpdateProyectoRequest $request, Proyecto $proyectos, $id)
    {
        $request->validate([
            'idClientes' => 'required',
            'idAsesores' => 'required',
            'Nombre' => 'required',
            'Riesgos' => 'required',
        ]);

        $proyectos=Proyecto::find($id);
        $proyectos->idClientes = $request->input('idClientes');
        $proyectos->idAsesores = $request->input('idAsesores');
        $proyectos->Nombre = $request->input('Nombre');
        $proyectos->Riesgo = $request->input('Riesgos');
        $proyectos->Progreso = $request->input('Progreso');
        $proyectos->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $proyectos = Proyecto::find($id);

        $proyectos->delete();

        return response()->json(['message' => 'Proyecto eliminado exitosamente.']);
    }

    
    public function approve($id)
    {
        $plandework = Plandetrabajo::find($id);
        $plandework->status = true;
        $plandework->save();

        $this->calculateProjectProgress($plandework->id_proyecto);

        return response()->json(['success' => true]);
    }

    public function reject($id)
    {
        $plandework = Plandetrabajo::find($id);
        $plandework->status = false;
        $plandework->save();

        $this->calculateProjectProgress($plandework->id_proyecto);

        return response()->json(['success' => true]);
    }

    public function calculateProjectProgress($projectId)
    {
        $aprobadas = Plandetrabajo::where('id_proyecto', $projectId)->where('status', true)->count();
        $totalActividades = Plandetrabajo::where('id_proyecto', $projectId)->count();

        $progreso = $totalActividades > 0 ? ($aprobadas / $totalActividades) * 100 : 0;

        // Actualizar el progreso en la tabla de proyectos
        $proyectos = Proyecto::find($projectId);
        $proyectos->Progreso = $progreso;
        $proyectos->save();
    }

}
