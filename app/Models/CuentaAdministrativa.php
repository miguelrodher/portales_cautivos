<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class CuentaAdministrativa extends Model
{
    use HasFactory;

    protected $table = 'cuentas_administrativas';
    public $timestamps = false;

    protected $fillable = 
    [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'contraseña',
        'correo_electronico',
        'estatus',
        'roles_id',
    ];

    protected $hidden = 
    [
        'contraseña', 'remember_token',
    ];

    protected $casts = 
    [
        'estatus' => 'boolean',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }
}
