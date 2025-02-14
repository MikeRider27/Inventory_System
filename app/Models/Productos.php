<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'id_categoria',
        'descripcion',
        'codigo',
        'precio_compra',
        'precio_venta',
        'stock',
        'imagen',
        'agregado',
        'ventas'
    ];
    public $timestamps = false;
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id', 'id_categoria');
    }
}
