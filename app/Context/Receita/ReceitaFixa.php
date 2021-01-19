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

		$receita->data = Carbon::create($data['dtinicial']);
		$receita->save();

		$dtfinal = Carbon::create($data['dtfinal']);
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
