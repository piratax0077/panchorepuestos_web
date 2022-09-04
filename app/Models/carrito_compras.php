<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrito_compras extends Model
{
    protected $table='carrito_compras';
    protected $fillable=[
        'usuarios_id',
        'item',
        'repuestos_id',
        'cantidad',
        'precio_neto'
    ];
}
