<?php 

namespace App\Context\Receita;

use Carbon\Carbon;
use App\Models\Receita;
use Formatter;


class ReceitaIrregular implements ReceitaStrategy
{

	public function make(array $data) {

		$receita = new Receita;
		$receita->descricao = $data['descricao'];
		$receita->fixa = false;

		if (isset($data['recebido'])) {
			$receita->recebido = true;
		}

		$receita->valor = Formatter::stringToMoney(
			$data['valor']
		);

		$receita->data = Carbon::create($data['dtinicial']);
		$receita->save();

		return true;

	}



}
