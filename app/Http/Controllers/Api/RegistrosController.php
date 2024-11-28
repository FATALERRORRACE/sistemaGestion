<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Localidad;
use App\Models\Barrios;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\Nivelescolaridad;
use App\Models\Ocupaciones;
use Illuminate\Support\Facades\DB;

class RegistrosController extends Controller
{
    /**
     * Display the form to create or edit a user.
     *
     * Este método retorna la vista 'usuariosView', que se utiliza para mostrar
     * la página donde se visualizarán los usuarios en la biblioteca.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getForm(int $id, Request $request){
        $registro = Usuarios::where(['consecutivo_id' => $id])->first();
        return view('seguimientoForm', [
            'departamentos' => Departamentos::get()->toArray(),
            'localidades' => Localidad::select('id', 'nombre')->get()->toArray(),
            'registro' => $registro, 
            'ocupaciones' => Ocupaciones::select('id', 'nomb_ocup')->get()->toArray(),
            'generos' => Ocupaciones::select('id', 'nomb_ocup')->get()->toArray(),
            'barrios' => $registro->localidad_numero ? Barrios::where('localidad', '=', $registro->localidad_numero )->get()->toArray() : [],
        ]);
    }

    /**
     * Display the form to create a new user.
     *
     * Este método retorna la vista 'newusuario', la cual se utilizará para crear un nuevo usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBarrioRegistro($registro){
        $barrios = [];
        if($registro->localidad_numero)
            $barrios = Barrios::where('localidad', '=', $registro->localidad_numero )->get()->toArray();
        // Retorna la vista 'newusuario' para mostrar el formulario de creación de un nuevo usuario
        return [
            'barrios' => $barrios,
        ];
    }

    /**
     * Get a list of users for a specific library.
     *
     * Este método obtiene todos los usuarios asociados a una biblioteca especificada por su ID.
     * Realiza una unión con la tabla 'consecutivos' para obtener el nombre de la biblioteca.
     *
     * @param int $library ID de la biblioteca
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get(int $library, Request $request)
    {
        $values = Usuarios::select(
            DB::raw("CONCAT(usuarios.prim_nomb_usua, ' ',usuarios.prim_apel_usua) AS nombre"), 
            'usuarios.consecutivo_id', 'consecutivos.Biblioteca', 'usuarios.fech_naci_usua', 'usuarios.docu_pais_usua', 'usuarios.prim_nomb_usua'
        )
        ->leftjoin('consecutivos', 'consecutivos.Id_Biblioteca', '=', 'usuarios.consecutivo_id')
        ->where(['usuarios.consecutivo_id' => $library])
        ->get()->toArray();
        return [
            'total' => count($values),
            'data' => $values
        ];
    }

    /**
     * @param int $localidad ID de la biblioteca
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBarrio(int $localidad, Request $request){
        return Barrios::select('id', 'nomb_barr as text')
            ->where('id', '=', $localidad)->get()->toArray();
    }

}