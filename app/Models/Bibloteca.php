<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Bibloteca extends Authenticatable
{

    protected $table = 'bibloteca';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre_biblioteca',
        'localidad'
        //tipo 
        //codigo = blanco
        //consectivo
        //inicial y i_consectivo = 0
        //impresion = seleccion
        //carne si 
        //publioco escolar si/no
    ];

}
