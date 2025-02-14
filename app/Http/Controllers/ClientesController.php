<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::where('estado', 1)->get();
        
        return view('modules.ventas.clientes', compact('clientes'));
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
        $validarDocumento = request()->validate([
            'documento'=> ['unique:clientes']
        ]);

        $datos = request();

        Clientes::create([
            'nombre' => $datos["nombre"],
            'email' => $datos["email"],
            'direccion' => $datos["direccion"],
            'fecha_nacimiento' => $datos["fecha_nacimiento"],
            'telefono' => $datos["telefono"],
            'documento' => $validarDocumento["documento"],
            'estado' => 1
        ]);

        return redirect('Clientes')->with('success', 'Cliente creada con éxito');
    }

   
    /**
     * Display the specified resource.
     */
    public function ValidarDocumento(Request $request)
    {
        $cliente = Clientes::where('documento', $request->documento)->exists();

        if($cliente == null){
            $respuesta = true;            
        }else{
            $respuesta = false; 
        }

        return response()->json($respuesta);



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
