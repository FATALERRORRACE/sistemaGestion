<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrios extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'barrios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nomb_barr',
        'codi_barr_dane',
        'acti_barr',
        'orde_barr',
        'localidad_id',
        'municipio_id',
    ];
}
