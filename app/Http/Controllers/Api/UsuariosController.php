<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm(Request $request)
    {
        return view(
            'usuariosView'
        );
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setUser(Request $request)
    {
        return view(
            'newusuario'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateForm(int $user, Request $request)
    {
        return view(
            'updateusuario', 
            [
                'user' => Biblousuarios::select('biblousuarios.*', 'consecutivos.biblioteca', )
                    ->leftjoin('consecutivos', 'consecutivos.id_biblioteca', '=', 'biblousuarios.biblioteca')
                    ->where(['biblousuarios.id' => $user])->get()->toArray()[0]
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(int $user, Request $request)
    {
        $newData = [
            'nombre_usuario' => $request->nombre,
            'alias' => $request->alias,
            'privilegios' => $request->type,
            'estado' => $request->estado == 'on' ? 1 : 0
        ];

        if(!empty($request->email))
            $newData['email'] = $request->email;

        if(!empty($request->password))
            $newData['password'] = Hash::make($request->password);

        return Biblousuarios::where('id', $user)->update($newData) ? 
            ['status' => 'ok','message' => "¡Usuario actualizado!"]: 
            ['status' => 'error','message' => "¡Ocurrió un error!"];
    }
    
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
        return Biblousuarios::select('biblousuarios.id', 'biblousuarios.nombre_usuario', 'biblousuarios.email', 'biblousuarios.password', 'consecutivos.biblioteca', 'biblousuarios.alias', 'biblousuarios.privilegios', 'biblousuarios.estado',)
            ->where(['biblousuarios.biblioteca' => $library])
            ->leftjoin('consecutivos', 'consecutivos.id_biblioteca', '=', 'biblousuarios.biblioteca')
            ->orderBy('estado', 'asc')
            ->get()->toArray();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'alias' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'biblioteca' => ['required'],
            'type' => ['required'],
        ]);
        $user = Biblousuarios::create([
            'nombre_usuario' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'biblioteca' => $request->biblioteca,
            'alias' => $request->alias,
            'privilegios' => $request->type,
            'estado' => 1
        ]);

        return $user ?
            [
                'message' => "Usuario {$request->nombre} creado exitosamente",
                'status' => 'ok'
            ] :
            [
                'message' => 'Error en la consulta',
                'status' => 'error'
            ];
    }
}
