<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaOcupacional extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sub_nombre',
        'vacantes',
        'descripcion',
        'icono',
        'estado',
    ];
}
