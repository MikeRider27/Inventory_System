<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
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
        return view('modules.productos.categorias', compact('categorias'));
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
        Categorias::create([
            'nombre' => $request->nombre
        ]);

        return redirect('Categorias')->with('success', 'Categoría creada con éxito');
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
    public function edit($id_categoria)
    {
        $categoria = Categorias::where('id', $id_categoria)->first();

        return response()->json($categoria);
    }    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Categorias::where('id', $request->id)->update([
            'nombre' => $request->nombre
        ]);

        return redirect('Categorias')->with('success', 'Categoría actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_categoria)
    {
        Categorias::find($id_categoria);
        Categorias::destroy($id_categoria);

        return redirect('Categorias');
    }
}
