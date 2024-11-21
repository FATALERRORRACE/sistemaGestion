<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biblousuarios;
use Illuminate\Support\Facades\Hash;

class BibliotecaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm(Request $request)
    {
        return view(
            'biblioteca'
        );
    }
    
}