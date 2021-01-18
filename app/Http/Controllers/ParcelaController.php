<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;

class ParcelaController extends Controller
{
    
    public function __construct() {


    }

    public function store (Request $request) {

    	$id = $request->post('parcela');

    	if (isset($id)) {

    		$parcela = Parcela::find($id);
    		$parcela->pago = 1;
    		$parcela->save();

    		return redirect()->to(route('despesas.show', [
    			'despesa'=> $parcela->despesa_id
    		]));

    	}
    	return back();


    }
}
