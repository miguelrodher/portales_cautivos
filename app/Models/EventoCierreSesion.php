<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventoCierreSesion extends Model
{
    use HasFactory;

    protected $table = 'eventos_cierres_sesiones';
    public $timestamps = false;

    protected $fillable = 
    [
        'evento_cierre_sesion',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'eventos_cierres_sesiones_id');
    }
}
