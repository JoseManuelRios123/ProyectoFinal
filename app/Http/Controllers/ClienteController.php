<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Filters\ClienteFilter;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->middleware('can: Ver Clientes')->only('index');
        $filter = new ClienteFilter();
        
        $queryItems = $filter->transform($request);
        $includeProyectos = $request->query('includeProyectos');
        $clientes = Cliente::where($queryItems);
        
        if ($includeProyectos) {
            $clientes = $clientes->with('proyectos');
        }
        $clientes = Cliente::all();
        
        // Devuelve la vista con los datos de clientes
        return view('sistema.clientes.index', [
            'clientes' => $clientes,
        ]);
    }

        
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreClienteRequest $request)
    {
        $request->validate([
            'Nombre' => 'required',
            'NIT' => 'required',
            'Direccion' => 'required',
            'Telefono' => 'required',
            'ActividadComercial' => 'required',
            'Codigo_CIUU' => 'required',
        ]);

        $clientes=new Cliente;
        $clientes->nombre_cliente=$request->input('Nombre');
        $clientes->nit=$request->input('NIT');
        $clientes->direccion=$request->input('Direccion');
        $clientes->telefono=$request->input('Telefono');
        $clientes->actividad_comercial=$request->input('ActividadComercial');
        $clientes->codigo_ciuu=$request->input('Codigo_CIUU');
        $clientes->save();

        return redirect()->back();
    }  

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $includeProyectos = request()->query('includeProyectos');
        if ($includeProyectos) {
            return new ClienteResource($cliente->loadMissing('proyectos'));
        }
        return new ClienteResource($cliente);
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
    public function update(UpdateClienteRequest $request, Cliente $clientes, $id)
    {
        $request->validate([
            'NombreE' => 'required',
            'NITE' => 'required',
            'DireccionE' => 'required',
            'TelefonoE' => 'required',
            'ActividadComercialE' => 'required',
            'Codigo_CIUU' => 'required',
        ]);
        $clientes=Cliente::find($id);
        $clientes->nombre_cliente=$request->input('NombreE');
        $clientes->nit=$request->input('NITE');
        $clientes->direccion=$request->input('DireccionE');
        $clientes->telefono=$request->input('TelefonoE');
        $clientes->actividad_comercial=$request->input('ActividadComercialE');
        $clientes->codigo_ciuu=$request->input('Codigo_CIUU');
        $clientes->update($request->all());
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clientes = Cliente::find($id);

        if ($clientes->proyectos()->count() > 0) {
            return response()->json(['message' => 'No puedes eliminar este cliente porque está asociado a un proyecto.'], 400);
        }

        $clientes->delete();

        return response()->json(['message' => 'Cliente eliminado exitosamente.']);
    }

}
