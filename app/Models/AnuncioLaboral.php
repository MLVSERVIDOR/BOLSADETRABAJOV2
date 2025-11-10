<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnuncioLaboral extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users',
        'categoria_id',
        'id_categoria_ocupacionals',
        'id_modalidads',
        'puesto',
        'vacantes',
        'sueldo',
        'fecha_limite',
        'descripcion',
        'condiciones',
        'id_etapa',
        'motivo_rechazo',
        'estado',
    ];

}
