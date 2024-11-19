<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consecutivos;
use Illuminate\Http\Request;

class ConsecutivoController extends Controller{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dump('$request->test');die;
        dump($request->test);die;
        return view(
            'index.main'
        );
    }

    public function getLibraries(Request $request){
        $consecutivos = 
            Consecutivos::
            select(['id_biblioteca AS id', 'biblioteca AS text'])
            ->where('tipo', $request->get("type"))
            ->get()->toArray();
        return $consecutivos;
    }

}
