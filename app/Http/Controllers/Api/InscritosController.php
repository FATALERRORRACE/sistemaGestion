<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use App\Models\Consecutivos;
use App\Models\UsuariosDb;
use Illuminate\Support\Facades\Hash;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;

class InscritosController extends Controller
{

    /**
     * Display the form for the resource.
     *
     * Este método se encarga de devolver la vista correspondiente
     * al formulario de la biblioteca.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getForm(Request $request){
        return view('inscritos');
    }

    /**
     * Display the form for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request){
        //$query = registro::select(DB::raw("'{$request->consecutivonm}' AS bibliotecaNombre", 'registro.Consecutivo', 'registro.Fecha_Solicitud', 'registro.Biblioteca', 'registro.T_Afiliado', 'registro.N_Documento',));
        $query = registro::select();
        //->leftjoin('c_barras', 'c_barras.Documento', '=', 'registro.N_Documento');
        //$query->where('Biblioteca', $request->consecutivo);
        if ($request->documento)
            $query->where('N_Documento', $request->documento);
        if ($request->email)
            $query->where('Email', $request->email);
        if ($request->nombres)
            $query->where('Nombres', $request->nombres);
        if ($request->apellidos)
            $query->where('Apellidos', $request->apellidos);

        $countData = $query->count();
        $data = $query->take(1000)->get()->toArray();

        return [
            'total' => $countData,
            'data' => $data
        ];

        $query->where('emai_usua' , $email);
        $query->where('prim_nomb_usua' , $nombres);
        //$query->where('prim_apel_usua' , $primApelUsua)
        //$query = UsuariosDb::
        //scopeDocumento($query, $request->documento)
        //->scopeNombres($query, $request->nombres)
        //->scopeApellido($query, $request->apellidos)
        //->scopeEmail($query, $request->email)
        //->scopeConsecutivo($query, $request->consecutivo)->first();
            dump($query);die;
        
        //DB::table('usuarios_bd')->where;
        //from institucion where Documento = '".$_POST["n_documento"]."' 
	    //$query = "select Consecutiv   o, Biblioteca, Fecha_Solicitud, Fecha_Activacion, concat(Nombres, ' ', Apellidos) as Nombre, N_Documento, Estado, T_Afiliado 
        //from registro where Nombres like '%$nombre%' and Apellidos like '%$apellido%' order by registro.Fecha_Solicitud desc limit $startRow_biblioteca, $maxRows_biblioteca";

        $query = "SELECT usuarios.id, usuarios.Estatus, usuarios.created_at, usuarios.updated_at, TRIM(UPPER(prim_nomb_usua)) AS Nombre, TRIM(UPPER(prim_apel_usua)) AS Apellido, UPPER(nomb_ident_usua) AS Identitario, 
						expe.nomb_pais AS Expedicion, nomb_gene, nomb_tido, tele_fijo_usua, celu_usar, tele_ofic, LOWER(emai_usua) AS Correo, cont_usua AS Clave, UPPER(nomb_nies) AS Escolaridad, 
						UPPER(nomb_ocup) AS Ocupacion, nacion.nomb_pais AS Nacionalidad, consecutivos.Biblioteca, afil_fisi_usua, dir_ip, confirmado 
						FROM usuarios 
						LEFT JOIN generos ON generos.id=usuarios.genero_id 
						LEFT JOIN ocupaciones ON ocupaciones.id=usuarios.ocupacion_id 
						LEFT JOIN nivelescolaridad ON nivelescolaridad.id=usuarios.nivelescolaridad_id
						LEFT JOIN tipodocumentos ON tipodocumentos.id=usuarios.tipodocumento_id
						LEFT JOIN paises nacion ON nacion.codi_pais_dian = usuarios.pais_nacionalidad  
						LEFT JOIN paises expe ON expe.codi_pais_dian = usuarios.pais_expe_docu 
						LEFT JOIN consecutivos  ON consecutivos.Id_Biblioteca = usuarios.consecutivo_id 
            WHERE docu_pais_usua = '".$_POST["pais"].$_POST["n_documento"]."'";
    }

}
