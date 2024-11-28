<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domic extends Model
{

    protected $connection = 'mysql2';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'domic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Id', 'Cod', 'Item', 'Tit', 'Aut', 'F_Sol', 'Tel', 'Est', 'Loc', 'Dir', 'Bar', 'Bib'
    ];
}
