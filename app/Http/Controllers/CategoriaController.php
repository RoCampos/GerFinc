<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Despesa;

use DB;

class CategoriaController extends Controller
{
    
    public function store (Request $request) {

    	$tag = $request->post('tag');
    	$despesa_id = $request->post('despesa');
        $tipo = $request->post('principal');


    	if (isset($tag)) {
    		
    		$result = Categoria::where ('etiqueta', 'like', '%'.$tag.'%');

    		if ($result && $result->count()>0) {
    			return back();
    		}

    		$etiqueta = new Categoria;
    		$etiqueta->etiqueta = $tag;
            $etiqueta->principal = isset($tipo) ? true : false;
    		$etiqueta->save();

    		return back();
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

    public function attach_categoria(Request $request) {

        $tag = $request->post('grupo');
        $subtag = $request->post('subgrupo');

        if($request->post('select'))
            return back()->withInput();

        DB::table('categoria_categoria')->insert([
            'grupo' => $tag,
            'subgrupo'=> $subtag
        ]);

        return back()->withInput();
    }

    public function available_json(Request $request) {

        $list = Categoria::find($request->id)->available();

        $response = array(
          'status' => 'success',
          'msg' => $list->get()->toJson(),
        );
        return response()->json($response);
    }

}









