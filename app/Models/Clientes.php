<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'direccion',
        'email',
        'fecha_nacimiento',
        'estado'
    ];

    public $timestamps = false;
}
