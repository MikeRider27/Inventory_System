<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Sucursales;
use App\Models\Clientes;
use App\Models\Productos;
use Illuminate\Http\Request;

class VentasController extends Controller
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
        $sucursales = Sucursales::where('estado', 1)->get();
        $clientes = Clientes::where('estado', 1)->get();
        $ventas = Ventas::all();

        return view('modules.ventas.ventas', compact('sucursales', 'clientes', 'ventas'));
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
        $datos = request();

        $UtimaVenta = Ventas::orderBy('id', 'desc')->where('id_sucursal', $datos["id_sucursal"])->first();

        if ($UtimaVenta == null) {
            $codigo = $datos["id_sucursal"]*10000;
        } else {
            $codigo = $UtimaVenta->codigo + 1;
        }

        Ventas::create([
            'id_sucursal' => $datos["id_sucursal"],
            'id_cliente' => $datos["id_cliente"],
            'id_vendedor' => $datos["id_vendedor"],
            'codigo' => $codigo,            
            'impuesto' => 0,
            'neto' => 0,
            'total' => 0,
            'metodo_pago' => '',
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 'Creada'
        ]);

        $nuevaVenta = Ventas::orderBy('id', 'desc')->first();

        return redirect('Venta/'.$nuevaVenta["id"]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_venta)
    {
        $venta = Ventas::find($id_venta);
        $productos = Productos::all();

        return view('modules.ventas.venta', compact('venta', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $ventas)
    {
        //
    }
}
