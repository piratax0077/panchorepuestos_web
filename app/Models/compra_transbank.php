<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra_transbank extends Model
{
    protected $table='compra_transbank';
    protected $fillable=[
        'session_id',
        'total',
        'status'
    ];
}