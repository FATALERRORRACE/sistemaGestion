<?php

namespace App\Http\Controllers;

use App\Models\Biblousuarios;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Consecutivos;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view(
            'index.main',
            [

            ]
        );
    }

}
