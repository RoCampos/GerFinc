<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\CategoriaController;

use App\Models\Categoria;

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

use App\Context\Despesa\DespesaQueryBuilder as DQB;
use Carbon\Carbon;

Route::get('/home', function () {
	
	$categorias = Categoria::where('principal','=', 1)->get();
	$listagem = array();
	foreach($categorias as $cat) {
		$listagem[$cat->etiqueta] = DQB::despesa_categoria(Carbon::now()->parse('Y'), $cat->etiqueta);
	}
	$despesa_total = DQB::despesa_total(2021, 01);

    return view('home', ['categorias'=>$listagem, 'total'=>$despesa_total]);
})->middleware(['auth'])->name('home');

Route::get('/config', function(){
	$categorias = Categoria::where('principal', true)
		->get();
	return view('config', ['categorias'=>$categorias]);
})->name('config');

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

Route::post('/categorias/agrupar/', [
	CategoriaController::class, 'attach_categoria'
])->name('categorias.attachcategoria');

Route::post('/categorias/json/available', [
	CategoriaController::class, 'available_json'
])->name('categorias.available');

require __DIR__.'/auth.php';






