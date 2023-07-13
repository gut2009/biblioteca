<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/livro', [App\Http\Controllers\LivroController::class, 'store']);

Route::get('/contato', [App\Http\Controllers\ContatoController::class, 'show']);

Route::apiResource('assunto', 'App\Http\Controllers\AssuntoController');
Route::apiResource('autor', 'App\Http\Controllers\AutorController');
Route::apiResource('categoria', 'App\Http\Controllers\CategoriaController');
Route::apiResource('cliente', 'App\Http\Controllers\ClienteController');
Route::apiResource('contato', 'App\Http\Controllers\ContatoController');
Route::apiResource('editora', 'App\Http\Controllers\EditoraController');
Route::apiResource('emprestimo', 'App\Http\Controllers\EmprestimoController');
Route::apiResource('espirito', 'App\Http\Controllers\EspiritoController');
Route::apiResource('livro', 'App\Http\Controllers\LivroController');
Route::apiResource('local', 'App\Http\Controllers\LocalController');
Route::apiResource('tipo', 'App\Http\Controllers\TipoController');
