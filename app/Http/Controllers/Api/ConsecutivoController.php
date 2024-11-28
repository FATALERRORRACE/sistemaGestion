<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consecutivos;
use Illuminate\Http\Request;

class ConsecutivoController extends Controller
{
    /**
     * Display the main view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // vista principal 'index.main'
        return view('index.main');
    }

    /**
     * Get a list of libraries based on a specified type.
     *
     * Este método devuelve una lista de bibliotecas que coinciden con un tipo específico 
     * proporcionado en la solicitud. Utiliza el modelo 'Consecutivos' para obtener los datos 
     * de las bibliotecas filtrados por el tipo.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */ 
    public function getLibraries(Request $request){
        $consecutivos = Consecutivos::select(['Id_Biblioteca AS id', 'Biblioteca AS text'])
            ->where('tipo', $request->get("type"))  // Filtra por el valor de 'type' en la solicitud
            ->get()->toArray();  // Obtiene los resultados como un arreglo

        // Retorna el arreglo con los datos de las bibliotecas
        return $consecutivos;
    }
}
