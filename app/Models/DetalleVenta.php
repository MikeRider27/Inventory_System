<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio',
    ];

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'id_venta');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }
}
