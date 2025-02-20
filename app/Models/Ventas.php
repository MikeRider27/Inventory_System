<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $fillable = [
        'id_sucursal',
        'codigo',
        'id_cliente',
        'id_vendedor',
        'impuesto',
        'neto',
        'total',
        'metodo_pago',
        'fecha',
        'estado'
    ];
    public $timestamps = false;

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'id_vendedor');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'id_sucursal');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
}
