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
        'id', 'biblioteca', 'v_consecutivo', 'inicial', 'i_consecutivo', 'localidad', 'impresion', 'carne', 'codigo', 'tipo', 'publico_escolar'
    ];
}
