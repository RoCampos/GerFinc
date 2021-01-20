<?php 

namespace App\Context\Receita;
use App\Models\Receita;
use Carbon\Carbon;


class ReceitaQueryBuilder
{

	public static function renda_prevista($ano) {
		$months = [
            '01'=>'Jan', '02'=>'Feb', '03'=>'Mar','04'=>'Apr', 
            '05'=>'May', '06'=>'Jun','07'=>'Jul','08'=>'Aug', 
            '09'=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec',
        ];
		//Receita Anual prevista
        $c = Receita::whereYear('data', '=', date($ano))
            ->get()
            ->groupBy(function($val){
                return Carbon::parse($val->data)->format('m/Y');
            });

        $renda_prev =  $c->map(function($item, $key) {
            return [$item->sum('valor')];
        });


        $array = array();
        $valor_mes = array();
        $sum = 0;
        foreach ($renda_prev as $key => $value) {
        	$mes = explode('/', $key);
        	$array[$mes[0]] = $value[0];
        	$sum += $value[0];
        }

        //processando saida correta
        $keys = array_keys($array);
        $diff = array_diff(array_keys($months), $keys);
        $fill = array_fill_keys(array_values($diff), 0);
        $resultado = $array + $fill;

        return ['meses'=> array_combine($months, $resultado), 'total'=> $sum];
	}

	public static function renda_consolidado($ano) {
		$months = [
            '01'=>'Jan', '02'=>'Feb', '03'=>'Mar','04'=>'Apr', 
            '05'=>'May', '06'=>'Jun','07'=>'Jul','08'=>'Aug', 
            '09'=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec',
        ];


		$c = Receita::whereYear('data', '=', date($ano))
			->where('recebido', '=', true)
            ->get()
            ->groupBy(function($val){
                return Carbon::parse($val->data)->format('m/Y');
            });

        $renda_prev =  $c->map(function($item, $key) {
            return [$item->sum('valor')];
        });

        $array = array();
        $valor_mes = array();
        $sum = 0;
        foreach ($renda_prev as $key => $value) {
        	$mes = explode('/', $key);
        	$array[$mes[0]] = $value[0];
        	$sum += $value[0];
        }

        //processando saida correta
        $keys = array_keys($array);
        $diff = array_diff(array_keys($months), $keys);
        $fill = array_fill_keys(array_values($diff), 0);
        $resultado = $array + $fill;

        return ['meses'=> array_combine($months, $resultado), 'total'=> $sum];

	}
}


