<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'registro';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'consecutivo',
        'biblioteca',
        'convenio',
        'programa',
        'usr_disc',
        'fecha_solicitud',
        'fecha_activacion',
        'nombres',
        'apellidos',
        'nomb_ident',
        'fecha_nacimiento',
        'genero',
        'tipo_documento',
        'n_documento',
        'tipo_vivienda',
        'direccion',
        'barrio',
        'estrato',
        'localidad',
        'tel_fijo',
        'celular',
        'tel_oficina',
        'email',
        'escolaridad',
        'ocupacion',
        'permite_envios',
        'estado',
        't_afiliado',
        'edad',
        'pais_expe_docu',
        'pais_nacionalidad',
        'contras_usr',
        'departamento',
    ];
}
