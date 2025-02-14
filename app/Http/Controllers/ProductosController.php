<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProductosController extends Controller
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
        $categorias = Categorias::orderBy('nombre', 'asc')->get();

        $productos = Productos::join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                    ->select('productos.*', 'categorias.nombre as categoria_nombre')
                    ->orderBy('productos.descripcion', 'asc')
                    ->get();

        return view('modules.productos.productos', compact('categorias', 'productos'));
    }

    public function GenerarCodigo($id_categoria)
    {
        $producto = Productos::where('id_categoria', $id_categoria)
                        ->orderBy('id', 'desc')
                        ->first();

        return response()->json($producto ? $producto->codigo : 0);
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

        if(request('imagen'))
        {
            $rutaImg = $datos['imagen']->store('products', 'public');
        }
        else
        {
            $rutaImg = "";
        }

        Productos::create([
            'codigo' => $datos['codigo'],
            'descripcion' => $datos['descripcion'],
            'precio_compra' => $datos['precio_compra'],
            'precio_venta' => $datos['precio_venta'],
            'stock' => $datos['stock'],
            'id_categoria' => $datos['id_categoria'],
            'imagen' => $rutaImg,
            'ventas' => 0,        
            'agregado' => date('Y-m-d H:i:s')
        ]);

        return redirect('Productos')->with('success', 'Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_producto)
    {
        $producto = Productos::find($id_producto);
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $datos = request();

        $producto = Productos::find($datos['id']);

        if(request('imagen'))
        {
            $path = storage_path('app/public/' . $producto->imagen);
            unlink($path);

            $rutaImg = $datos['imagen']->store('products', 'public');
        }
        else
        {
            $rutaImg = $producto->imagen;
        }

        Productos::where('id', $datos['id'])->update([
            'codigo' => $datos['codigo'],
            'descripcion' => $datos['descripcion'],
            'precio_compra' => $datos['precio_compra'],
            'precio_venta' => $datos['precio_venta'],
            'stock' => $datos['stock'],
            'id_categoria' => $datos['id_categoria'],
            'imagen' => $rutaImg
        ]);

        return redirect('Productos')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_producto)
    {
        $producto = Productos::find($id_producto);

        if($producto->imagen != "")
        {
            $path = storage_path('app/public/' . $producto->imagen);
            unlink($path);
        }

        Productos::destroy($id_producto);

        return redirect('Productos');
    }
}
