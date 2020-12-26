<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReceitaController;

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
	$listagem = App\Models\Receita::all();
    return view('receita.home2', ['receitas'=>$listagem]);
});

Route::resource ('receitas', ReceitaController::class);

//Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas.index');
