<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupaciones extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'ocupaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nomb_ocup',
        'acti_ocup',
        'orde_ocup',
        'meno_edad_ocup',
        'desc_ocup',
    ];
}
