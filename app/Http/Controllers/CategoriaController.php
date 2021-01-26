<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Despesa;

class CategoriaController extends Controller
{
    
    public function store (Request $request) {

    	$tag = $request->post('tag');
    	$despesa_id = $request->post('despesa');


    	if (isset($tag)) {
    		
    		$result = Categoria::where ('etiqueta', 'like', '%'.$tag.'%');

    		if ($result && $result->count()>0) {
    			return back();
    		}

    		$etiqueta = new Categoria;
    		$etiqueta->etiqueta = $tag;
    		$etiqueta->save();

            $desc = Despesa::find($despesa_id)->descricao;
            $keys = Despesa::where('descricao', $desc)->get()->pluck('id');
    		$etiqueta->despesas()->attach($keys->toArray());

    		return redirect()->route('despesas.show', ['despesa'=>$despesa_id]);

    	}
    	return back();
    }

    public function attach (Request $request, Categoria $categoria, Despesa $despesa) {
        
        $desc = Despesa::find($despesa->id)->descricao;
        $keys = Despesa::where('descricao', $desc)->get()->pluck('id');
    	$categoria->despesas()->attach($keys->toArray());

    	return redirect()->route('despesas.show', ['despesa'=>$despesa->id]);

    }

    public function detach (Request $request, Categoria $categoria, Despesa $despesa) {
        $categoria->despesas()->detach($despesa->id);
        return redirect()->route('despesas.show', ['despesa'=>$despesa->id]);

    }

}









