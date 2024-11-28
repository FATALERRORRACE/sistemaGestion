<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConsecutivoController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\BibliotecaController;
use App\Http\Controllers\Api\RegistrosController;
use App\Http\Controllers\Api\PrestamosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PRESTAMOS
Route::get('prestamos/{id}/get',   [PrestamosController::class, 'get']);

// SEGUIMIENTO MODULE
Route::get('/registro/{library}/get',   [RegistrosController::class, 'get']);
Route::get('/registro/form/{id}',       [RegistrosController::class, 'getForm']);
Route::get('/localidad/{id}/barrio',    [RegistrosController::class, 'getBarrio']);

// USERS->BIBLIOTECA MODULE
Route::get('/biblioteca/form',      [BibliotecaController::class, 'getForm']);
Route::post('/biblioteca',          [BibliotecaController::class, 'set']);
Route::get('/biblioteca/{id}',      [BibliotecaController::class, 'get']);
Route::post('/biblioteca/{id}',     [BibliotecaController::class, 'update']);

// USERS MODULE
Route::get('/users/view',               [UsuariosController::class, 'getForm']);
Route::get('/users/view/new',           [UsuariosController::class, 'setUser']);
Route::get('/users/view/{idUser}/edit', [UsuariosController::class, 'updateForm']);
Route::post('/users/{idUser}/edit',     [UsuariosController::class, 'updateUser']);
Route::get('/users/{library}/get',      [UsuariosController::class, 'get']);
Route::post('/users',                   [UsuariosController::class, 'post']);

Route::get('/libraries/get',            [ConsecutivoController::class, 'getLibraries']);