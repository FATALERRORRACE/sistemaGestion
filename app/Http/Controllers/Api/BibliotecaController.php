<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use App\Models\Consecutivos;
use Illuminate\Support\Facades\Hash;

class BibliotecaController extends Controller
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
    public function getForm(Request $request)
    {
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
        return view('biblioteca', ['localidades' => $localidades]);
    }

    /**
     * Set a new resource.
     *
     * Este método está destinado a recibir datos desde una solicitud
     * y realizar algún tipo de acción, como guardar o procesar
     * información relacionada con la biblioteca.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        // Valida los datos requeridos en la solicitud
        $request->validate([
            'biblioteca' => ['required'],
            'carne' => ['required'],
            'codigo' => ['required'],
            'bbltcacceso' => ['required'],
            'localidad' => ['required'],
        ]);


        $consecutivo = Consecutivos::create([
            'biblioteca' => $request->biblioteca,
            'impresion' => $request->impresion == 'on' ? 1 : 0,
            'localidad' => (int)$request->localidad,
            'carne' => $request->carne,
            'codigo' => $request->codigo,
            'inicial' => 0,
            'v_consecutivo' => 0,
            'i_consecutivo' => 0,
            'tipo' => $request->bbltcacceso,
            'publico_escolar' => $request->publico == 'on' ? 1 : 0
        ]);
        // Retorna una respuesta de éxito o error según el resultado de la creación
        return $consecutivo ?
            [
                'message' => "¡Biblioteca {$request->biblioteca} creada exitosamente!",
                'status' => 'ok',
                'id' => $consecutivo->id,
                'tipo' => $consecutivo->tipo
            ] :
            [
                'message' => 'Error en la consulta',
                'status' => 'error'
            ];
    }

    /**
     * Get a specific resource by its ID.
     *
     * Este método se utiliza para obtener un recurso específico
     * (como un libro o un usuario) de la biblioteca, según su ID.
     *
     * @param int $idBiblioteca ID del recurso a obtener
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function get($idBiblioteca, Request $request)
    {
        return Consecutivos::where('id', $idBiblioteca)->first();
    }

    /**
     * Update the specified resource.
     *
     * Este método se usa para actualizar los detalles de un recurso
     * (como un libro o un usuario) de la biblioteca basado en su ID.
     *
     * @param int $idBiblioteca ID del recurso a actualizar
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($idBiblioteca, Request $request)
    {
        // Prepara los datos que se actualizarán en la base de datos
        $newData = [
            'biblioteca' => $request->biblioteca,
            'impresion' => $request->impresion == 'on' ? 1 : 0,
            'carne' => $request->carne,
            'localidad' => (int)$request->localidad,
            'codigo' => $request->codigo,   
            'tipo' => $request->bbltcacceso,
            'publico_escolar' => $request->publico == 'on' ? 1 : 0
        ];

        // Realiza la actualización en la base de datos y devuelve un mensaje de éxito o error
        return Consecutivos::where('id', $idBiblioteca)->update($newData) ?
            ['status' => 'ok', 'message' => "¡Biblioteca {$request->biblioteca} actualizada!",
                'id' => $idBiblioteca,
                'tipo' => $request->bbltcacceso
                ] :
            ['status' => 'error', 'message' => "Ocurrió un error"];
    }
}
