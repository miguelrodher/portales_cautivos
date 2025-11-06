<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoDominioRestringido extends Model
{
    use HasFactory;

    protected $table = 'correos_dominios_restringidos';
    public $timestamps = false;

    protected $fillable = 
    [
        'restriccion',
    ];
}
