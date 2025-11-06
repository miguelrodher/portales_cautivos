<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortalCautivo extends Model
{
    use HasFactory;

    protected $table = 'portales_cautivos';
    public $timestamps = false;

    protected $fillable = 
    [
        'nombre',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'portales_cautivos_id');
    }
}
