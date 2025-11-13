<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CuentaAdministrativa extends Authenticatable
{
    use Notifiable;

    protected $table = 'cuentas_administrativas';

    public $timestamps = false;

    protected $fillable = 
    [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'contrasena',
        'correo_electronico',
        'estatus',
        'roles_id',
    ];

    protected $hidden = 
    [
        'contrasena', 
    ];

    protected $casts = 
    [
        'estatus' => 'boolean',
    ];


    public function getAuthPassword()
    {
        return $this->attributes['contrasena'] ?? null;
    }

    public function setPassword(string $plainPassword)
    {
        $this->attributes['contrasena'] = Hash::make($plainPassword);
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'roles_id');
    }
}
