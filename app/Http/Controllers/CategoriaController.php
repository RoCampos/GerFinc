<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

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

    		$etiqueta->despesas()->attach($despesa_id);

    		return redirect()->route('despesas.show', ['despesa'=>$despesa_id]);

    	}
    	return back();
    }

    public function add (Request $request) {

    	$tag = $request->post('tag_id');
    	$despesa_id = $request->post('despesa_id');
    	$categoria = Categoria::find($tag);
    	$categoria->despesas()->attach($despesa_id);
    	return redirect()->route('despesas.show', ['despesa'=>$despesa_id]);

    }

}
