<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreRestringido extends Model
{
    use HasFactory;

    protected $table = 'nombres_restringidos';
    public $timestamps = false;

    protected $fillable = 
    [
        'restriccion',
    ];

}
