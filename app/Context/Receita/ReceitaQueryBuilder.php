<?php 

namespace App\Context\Receita;
use App\Models\Receita;
use Carbon\Carbon;


class ReceitaQueryBuilder
{


	public static function renda_prevista() {
		//Receita Anual prevista
        $c = Receita::whereYear('data', '=', date('2021'))
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

        return ['meses'=> $array, 'total'=> $sum];
	}
}


