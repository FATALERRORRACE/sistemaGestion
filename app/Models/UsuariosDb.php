<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosDb extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'usuarios_bd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    static public function scopeDocumento($query, $documento)
    {
        if ($documento) {
           return $query->where('docu_pais_usua' , $documento);
        }
        return $query;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    static public function scopeEmail($query, $email)
    {
        if ($email)
           return $query->where('emai_usua' , $email);

        return $query;
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    static public function scopeNombres($query, $nombres)
    {
        if ($nombres)
           return $query->where('prim_nomb_usua' , $nombres);

        return $query;
    }

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    static public function scopeApellido($query, $primApelUsua)
    {
        if ($primApelUsua)
           return $query->where('prim_apel_usua' , $primApelUsua);

        return $query;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    static public function scopeConsecutivo($query, $consecutivo){
        if ($consecutivo)
           return $query->where('consecutivo_id' , $consecutivo);

        return $query;
    }

    
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
        'segu_nomb_usua ',
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
    ];
}
