<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'Estatus',
        'docu_pais_usua',
        'pais_expe_docu',
        'pais_nacionalidad',
        'prim_nomb_usua',
        'segu_nomb_usua',
        'prim_apel_usua',
        'segu_apel_usua',
        'nomb_ident_usua',
        'fech_naci_usua',
        'emai_usua',
        'cont_usua',
        'reci_info_usua',
        'reci_info_bibdi',
        'dire_usua',
        'estr_usua',
        'celu_usar',
        'tele_fijo_usua',
        'tele_ofic',
        'ocupacion_id',
        'nivelescolaridad_id',
        'poblacion_id',
        'consecutivo_id',
        'tipodocumento_id',
        'genero_id',
        'pais_reci_usua',
        'departamento_codigo',
        'municipio_codigo',
        'localidad_numero',
        'barrio_id',
        'vivienda_id',
        'afil_fisi_usua',
        'created_at',
        'updated_at',
        'dir_ip',
        'confirmado'
    ];
}
