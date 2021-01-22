<?php 

namespace App\Context\Despesa;

use Money\Money;
use Money\Currency;
use App\Models\Despesa;
use Auth;
use Carbon\Carbon;
use App\Models\Parcela;
use Formatter;

/**
 * summary
 */
class DespesaParcelada implements PagamentoDespesaStrategy
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public function make(array $data) {

    	$despesa = new Despesa;
    	$despesa->descricao = $data['descricao'];
        $despesa->data = Carbon::create($data['data']);
        $despesa->fixa = 0;
        $despesa->user_id = Auth::user()->id;

        $despesa->save();

        //número de parcelas
        $parcelas = $data['parcelas'];

        //corrigindo vígula/ponto
        $valor = Formatter::stringToMoney($data['valor']);
        $valor = new Money($valor, new Currency('BRL'));
        $valor = $valor->divide($parcelas);

        $parcela = new Parcela;
        $parcela->despesa_id = $despesa->id;
        $parcela->valor = $valor->getAmount();

        $dt = $despesa->data;
        
        $parcela->data_pagamento = $dt;
		$parcela->save();
        for ($i = 1; $i < $parcelas; $i++) {
            $parcela->data_pagamento = $dt->addMonth(1);
        	$parcela->replicate()->save();	
        }
       
    }
}



