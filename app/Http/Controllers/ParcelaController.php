<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use Formatter;

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

    public function update(Request $request, Parcela $parcela) {

        $valor = $request->post('parc-edit-valor');
        $data = $request->post('parc-edit-data');
        $parcela->valor = Formatter::stringToMoney($valor);
        $parcela->data_pagamento = Formatter::dataFromView($data);
        $parcela->save();

        return redirect()->to(route('despesas.show', [
            'despesa'=> $parcela->despesa_id
        ]));
    }
}
