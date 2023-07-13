<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route::post('login', [AuthenticatedSessionController::class, 'create'])                ->name('login');
                
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->prefix('/admin')->group(function() {
Route::get('/assuntos', [App\Http\Controllers\AssuntoController::class, 'index'])->name('assuntos.index');
Route::get('/autores', [App\Http\Controllers\AutorController::class, 'index'])->name('autores.index');
Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes.index');
Route::get('/contatos', [App\Http\Controllers\ContatoController::class, 'index'])->name('contatos.index');
Route::get('/editoras', [App\Http\Controllers\EditoraController::class, 'index'])->name('editoras.index');
Route::get('/emprestimos', [App\Http\Controllers\EmprestimoController::class, 'index'])->name('emprestimos.index');
Route::get('/espiritos', [App\Http\Controllers\EspiritoController::class, 'index'])->name('espiritos.index');
Route::get('/livros', [App\Http\Controllers\LivroController::class, 'index'])->name('livros.index');
Route::get('/locais', [App\Http\Controllers\LocalController::class, 'index'])->name('locais.index');
Route::get('/tipos', [App\Http\Controllers\TipoController::class, 'index'])->name('tipos.index');

Route::post('/cadastrar-livros', [App\Http\Controllers\LivroController::class, 'create'])->name('livros.create');
Route::post('/salvar-livros', [App\Http\Controllers\LivroController::class, 'store'])->name('livros.store');
Route::get('/livros/{id}', [App\Http\Controllers\LivroController::class, 'show'])->name('livros.show');
Route::get('/editar-livros/{id}', [App\Http\Controllers\LivroController::class, 'edit'])->name('livros.edit');
Route::get('/atualizar-livros/{id}', [App\Http\Controllers\LivroController::class, 'update'])->name('livros.update');
Route::get('/excluir-livros{id}', [App\Http\Controllers\LivroController::class, 'destroy'])->name('livros.destroy');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
                
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
