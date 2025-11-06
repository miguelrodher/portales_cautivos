<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = 
    [
        'nombre',
        'correo_electronico',
        'telefono',
        'fecha_creacion',
    ];

    protected $casts = 
    [
        'fecha_creacion' => 'date',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'usuarios_id');
    }
}
