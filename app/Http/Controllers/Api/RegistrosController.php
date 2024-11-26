<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Barrio;
use App\Models\Localidad;
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
        $localidades = [
            1 => "1 - Usaquén",
            2 => "2 - Chapinero",
            3 => "3 - Santa Fe",
            4 => "4 - San Cristóbal",
            5 => "5 - Usme",
            6 => "6 - Tunjuelito",
            7 => "7 - Bosa",
            8 => "8 - Kennedy",
            9 => "9 - Fontibón",
            10 =>  "10 - Engativá",
            11 =>  "11 - Suba",
            12 =>  "12 - Barrios Unidos",
            13 =>  "13 - Teusaquillo",
            14 =>  "14 - Los Mártires",
            15 =>  "15 - Antonio Nariño",
            16 =>  "16 - Puente Aranda",
            17 =>  "17 - Candelaria",
            18 =>  "18 - Rafael Uribe Uribe",
            19 =>  "19 - Ciudad Bolívar",
            20 =>  "20 - Sumapaz",
            21 =>  "20 - Otros"
        ];
        
        $registro = Registro::where(['consecutivo' => $id])->first();
        $registro->barrio = ucwords(strtolower($registro->barrio));
        
        //BARRIO
        $barrio = $this->getBarrioRegistro($registro);

        return view('seguimientoForm', ['localidades' => $localidades,'registro' => $registro, 'barrio' => $barrio['barrio'], 'barrios' => $barrio['barrios'], ]);
    }

    /**
     * Display the form to create a new user.
     *
     * Este método retorna la vista 'newusuario', la cual se utilizará para crear un nuevo usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBarrioRegistro($registro){
        $barrio = Barrio::where('nombre', '=', $registro->barrio )->first();
        $barrios = [];
        if($barrio)
            $barrios = Barrio::where('localidad', '=', $barrio->localidad )->get()->toArray();
        // Retorna la vista 'newusuario' para mostrar el formulario de creación de un nuevo usuario
        return [
            'barrio' => $barrio,
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
        $values = Registro::select(
            DB::raw("CONCAT(registro.nombres, '', registro.apellidos) AS nombre"), 'registro.consecutivo',
            'consecutivos.biblioteca', 'registro.fecha_solicitud', 'registro.n_documento'
        )
        ->leftjoin('consecutivos', 'consecutivos.id', '=', 'registro.biblioteca')
        ->where('registro.estado', '=', '0')
        ->where(['registro.biblioteca' => $library])
        ->where('registro.t_afiliado', '=', '1')
        ->whereNull('registro.fecha_activacion')
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
        return Barrio::where('localidad', '=', $localidad)->get()->toArray();   
    }
}
