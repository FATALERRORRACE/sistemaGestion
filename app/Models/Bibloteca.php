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
        'id_biblioteca',
        'nombre_biblioteca',
    ];

}
