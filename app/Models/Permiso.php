<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    public $timestamps = false;

    protected $fillable = 
    [
        'permiso',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany
        (
            Role::class,
            'roles_permisos',
            'permisos_id',
            'roles_id'
        );
    }
}
