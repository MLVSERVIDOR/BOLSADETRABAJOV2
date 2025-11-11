<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    // Agrega el código existente aquí
    protected $fillable = ['name', 'module']; // Asegúrate de que 'module' esté en el fillable


    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}