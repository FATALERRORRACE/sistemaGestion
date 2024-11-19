<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;

class UsuariosController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(int $library, Request $request)
    {
        //$request->validate([
        //    'biblioteca' => ['required'],
        //]);
        return Biblousuarios::
            select('biblousuarios.id','biblousuarios.nombre_usuario', 'biblousuarios.email', 'biblousuarios.password', 'consecutivos.biblioteca', 'biblousuarios.alias', 'biblousuarios.privilegios', 'biblousuarios.estado',)
            ->where([ 'biblousuarios.biblioteca' => $library ])
            ->leftjoin('consecutivos', 'consecutivos.id_biblioteca', '=', 'biblousuarios.biblioteca')
            ->orderBy('estado', 'asc')
            ->get()->toArray();
    }

}
