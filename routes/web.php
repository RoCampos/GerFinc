<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::resource('/receitas', ReceitaController::class)
	->except(['show', 'create', 'edit']);
Route::resource('/despesas', DespesaController::class)
	->except(['edit']);


Route::resource('/parcelas', ParcelaController::class)
	->only(['store','update']);

Route::resource('/categorias', CategoriaController::class)
	->only(['store']);

Route::post('/categorias/vincular/{categoria}/{despesa}', 
	[CategoriaController::class, 'attach'
])->name('categorias.attach');

Route::post('/categorias/desvincular/{categoria}/{despesa}', [
	CategoriaController::class, 'detach'
])->name('categorias.detach');

require __DIR__.'/auth.php';






