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
        //$clientes = Clientes::where('estado', 1)->get();

        $clientes = Clientes::leftJoin('ventas', 'clientes.id', '=', 'ventas.id_cliente')
        ->select('clientes.id', 'clientes.nombre', 'clientes.documento', 'clientes.email', 'clientes.direccion', 'clientes.telefono', 'clientes.fecha_nacimiento', 'clientes.estado', \DB::raw('MAX(ventas.fecha) as ultima_compra'),  \DB::raw('COUNT(ventas.id) as cantidad_compras'))
        ->where('clientes.estado', 1)
        ->groupBy('clientes.id', 'clientes.nombre', 'clientes.documento', 'clientes.email', 'clientes.direccion', 'clientes.telefono', 'clientes.fecha_nacimiento', 'clientes.estado')
        ->get();
    


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
        if($request->id == 0){

            $cliente = Clientes::where('documento', $request->documento)->exists();
            
            if($cliente == null){
                $respuesta = true;
            }else{
                $respuesta = false;
            }
        }else{

            $cliente = Clientes::find($request->id);

            if($cliente->documento != $request->documento){

                $documentoExiste = Clientes::where('documento', $request->documento)->exists();
                
                if($documentoExiste == null){
                    $respuesta = true;
                }else{
                    $respuesta = false;
                }
            }else{
                $respuesta = false;
            }
        }
        

        return response()->json($respuesta);



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_cliente)
    {
        $cliente = Clientes::find($id_cliente);

        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $datos = request();

        $cliente = Clientes::find($datos["id"]);

        $cliente->update([
            'nombre' => $datos["nombre"],
            'email' => $datos["email"],
            'direccion' => $datos["direccion"],
            'fecha_nacimiento' => $datos["fecha_nacimiento"],
            'telefono' => $datos["telefono"],
            'documento' => $datos["documento"]
        ]);

        return redirect('Clientes')->with('success', 'Cliente actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_cliente)
    {
        $cliente = Clientes::find($id_cliente);

        $cliente->update([
            'estado' => 0
        ]);

        return redirect('Clientes');
    }
}
