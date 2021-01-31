<?php 

namespace App\Context\Despesa;

/**
 * summary
 */
class PagamentoDespesaBuilder
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public static function builder ($data) {

    	if (isset($data['parcelado'])) {
    		return new DespesaParcelada;
    	}
    	if (isset($data['fixa'])) {
    		return new DespesaFixa;
    	}
        return null;
    }
}

