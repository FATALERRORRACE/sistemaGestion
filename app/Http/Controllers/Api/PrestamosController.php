<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domic;
use Illuminate\Support\Facades\DB;

class PrestamosController extends Controller{
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
        $remot = mysqli_connect("162.144.216.160:3306", "biblored_aficion", "r~Y3gu(Y@#M+", "biblored_usuariosdb") or die("Error de conexi&oacute;n " . mysqli_error($remot));
        var_dump($remot);die;
        $domic = Domic::
        where('Est', '=', 0)
        ->where('Bib', '=', $library)
        ->get()->toArray();
        dump($domic);die;
    }
}