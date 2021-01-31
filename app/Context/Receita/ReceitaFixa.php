<?php 

namespace App\Context\Receita;

use Carbon\Carbon;

use App\Models\Receita;
use Formatter;

class ReceitaFixa implements ReceitaStrategy 
{

	public function make(array $data) {

		$receita = new Receita;
		$receita->descricao = $data['descricao'];
		$receita->fixa = true;

		if (isset($data['recebido'])) {
			$receita->recebido = true;
		}

		$receita->valor = Formatter::stringToMoney(
			$data['valor']
		);

		$dtinicial = Formatter::dataFromView($data['dtinicial'])->format('y-m-d');
		$receita->data = Carbon::create($dtinicial);
		$receita->save();

		$dtfinal = Formatter::dataFromView($data['dtfinal'])->format('y-m-d');
		$dtfinal = Carbon::create($dtfinal);
		$counter = $receita->data->diffInMonths($dtfinal);

		$dt = $receita->data->copy();

        for ($i = 0; $i < $counter; $i++) {
            $nova = $receita->replicate();
            $nova->data = $dt->addMonth(1);
            $nova->save();
        }

		return true;
	}

}
