<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
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
    public function getForm(Request $request)
    {
        // Retorna la vista 'usuariosView' para visualizar los usuarios
        return view('usuariosView');
    }

    /**
     * Display the form to create a new user.
     *
     * Este método retorna la vista 'newusuario', la cual se utilizará para crear un nuevo usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setUser(Request $request)
    {
        $request->user();
        // Retorna la vista 'newusuario' para mostrar el formulario de creación de un nuevo usuario
        return view('newusuario');
    }

    /**
     * Display the form to update an existing user.
     *
     * Este método retorna la vista 'updateusuario' con los datos del usuario especificado por su ID.
     *
     * @param int $user ID del usuario a actualizar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateForm(int $user, Request $request)
    {
        // Obtiene los datos del usuario desde la base de datos y los pasa a la vista 'updateusuario'
        return view(
            'updateusuario', 
            [
                'user' => Biblousuarios::select('biblousuarios.*', 'consecutivos.biblioteca')
                    ->leftjoin('consecutivos', 'consecutivos.id', '=', 'biblousuarios.biblioteca')
                    ->where(['biblousuarios.id' => $user])
                    ->get()
                    ->first()
            ]
        );
    }

    /**
     * Update the specified user in the database.
     *
     * Este método actualiza los datos del usuario especificado por su ID con los datos proporcionados
     * en la solicitud (nombre, alias, email, privilegios, etc.).
     *
     * @param int $user ID del usuario a actualizar
     * @param \Illuminate\Http\Request $request
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

        // Si se ha proporcionado un email, se agrega al arreglo de datos
        if(!empty($request->email))
            $newData['email'] = $request->email;

        // Si se ha proporcionado una nueva contraseña, se hashea y se agrega al arreglo de datos
        if(!empty($request->password))
            $newData['password'] = Hash::make($request->password);

        // Realiza la actualización en la base de datos y devuelve un mensaje de éxito o error
        return Biblousuarios::where('id', $user)->update($newData) ? 
            ['status' => 'ok','message' => "¡Usuario actualizado!"]: 
            ['status' => 'error','message' => "¡Ocurrió un error!"];
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
        // Realiza la consulta para obtener los usuarios de una biblioteca
        return Biblousuarios::select('biblousuarios.id', 'biblousuarios.nombre_usuario', 'biblousuarios.email', 
                                    'biblousuarios.password', 'consecutivos.biblioteca', 
                                    'biblousuarios.alias', 'biblousuarios.privilegios', 
                                    'biblousuarios.estado')
            ->where(['biblousuarios.biblioteca' => $library])
            ->leftjoin('consecutivos', 'consecutivos.id', '=', 'biblousuarios.biblioteca')
            ->orderBy('estado', 'asc') // Ordena los usuarios por estado
            ->get()->toArray();
    }

    /**
     * Create a new user.
     *
     * Este método valida los datos proporcionados y crea un nuevo usuario en la base de datos.
     * Los datos requeridos son: nombre, alias, email, contraseña, biblioteca y tipo de usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        // Valida los datos requeridos en la solicitud
        $request->validate([
            'nombre' => ['required'],
            'alias' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'nubiblioteca' => ['required'],
            'type' => ['required'],
        ]);

        // Crea un nuevo usuario en la base de datos con los datos proporcionados
        $user = Biblousuarios::create([
            'nombre_usuario' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'biblioteca' => $request->nubiblioteca,
            'alias' => $request->alias,
            'privilegios' => $request->type,
            'estado' => 1
        ]);

        // Retorna una respuesta de éxito o error según el resultado de la creación
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
