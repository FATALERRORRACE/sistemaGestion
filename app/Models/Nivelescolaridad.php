<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivelescolaridad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'nivelescolaridad';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nomb_nies',
        'acti_nies',
        'orde_nies',
        'meno_edad_nies',
        'desc_nies',
    ];
}
