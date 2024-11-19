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
        'id_biblioteca', 'Biblioteca', 'v_consecutivo', 'inicial', 'i_consecutivo', 'impresion', 'carne', 'codigo', 'tipo', 'publico_escolar'
    ];
}
