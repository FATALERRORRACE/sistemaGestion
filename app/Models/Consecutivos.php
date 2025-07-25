<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consecutivos extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'consecutivos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Id_Biblioteca',
        'Biblioteca',
        'Tipo',
        'Aleph',
        'Localidad',
        'Proceso',
        'Cod_Qr',
        'B_Correo',
    ];
}
