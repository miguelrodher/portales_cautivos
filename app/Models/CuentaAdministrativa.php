<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class CuentaAdministrativa extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'cuentas_administrativas';

    public $timestamps = false;

    protected $fillable = 
    [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',
        'estatus',
        'roles_id',
    ];

    protected $hidden = 
    [
        'contraseña', 
    ];

    protected $casts = 
    [
        'estatus' => 'boolean',
    ];


    public function getAuthPassword()
    {
        return $this->attributes['contraseña'] ?? null;
    }

    public function setPassword(string $plainPassword)
    {
        $this->attributes['contraseña'] = Hash::make($plainPassword);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }



    public static function crearDesdeArray(array $data): self
    {
        $administrador = new self();
        $administrador->nombre = $data['nombre'];
        $administrador->apellido_paterno = $data['apellido_paterno'];
        $administrador->apellido_materno = $data['apellido_materno'];
        $administrador->correo_electronico = mb_strtolower($data['correo_electronico']);
        $administrador->estatus = $data['estatus'] ?? true;
        $administrador->roles_id = $data['roles_id'] ?? null;
        $administrador->setPassword($data['contraseña']);
        $administrador->save();

        return $administrador;
    }
}
