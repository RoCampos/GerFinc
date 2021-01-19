<?php 

namespace App\Context\Receita;

class ReceitaBuilder {

	public static function builder ($data) {

		if (isset($data['fixa'])) {
			return new ReceitaFixa;
		} else {
			return new ReceitaIrregular;
		}

        return null;
    }


}