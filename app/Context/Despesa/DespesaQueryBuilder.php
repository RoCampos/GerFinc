<?php 

namespace App\Context\Despesa;
use App\Models\Despesa;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;

/**
 * summary
 */
class DespesaQueryBuilder
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public static function despesa_total ($ano, $mes, $pago = false) {

		$months = [
            '01'=>'Jan', '02'=>'Feb', '03'=>'Mar','04'=>'Apr', 
            '05'=>'May', '06'=>'Jun','07'=>'Jul','08'=>'Aug', 
            '09'=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec',
        ];

        $despesas = Despesa::whereYear('data','=',date($ano))
        	->get()
        	->groupBy(function($val) {
        		return Carbon::parse($val->data)->format('m/Y');
        	}
        );

        $array = array();
        //somando todas as parcelas de cada $mes, por ano $ano
        foreach($despesas as $k) {
            $array[] = $k->map(function($val) use ($pago){
            	if ($pago) {
            		return $val->parcelas()
            			->where('pago', '=', true)
	                    ->get()
	                    ->sum('valor');
            	} else {
            		return $val->parcelas()
	                    ->get()
	                    ->sum('valor');	
            	}
            })->sum();
        }

        //processar saida por mes
        $keys = array_keys($despesas->toArray()); //obter os mes/ano
        $keys = array_map( function($val){return explode('/',$val)[0];} , $keys); //seperar o valor do mes
        $array = array_combine(array_values($keys), array_values($array)); //combinar mes => valor
       	$diff = array_diff(array_keys($months), array_values($keys)); //ver os meses ausentes
       	$fill = array_fill_keys(array_values($diff), 0); //preencher meses ausentes com 0

       	$resultado = $fill + $array; 
        ksort($resultado);
        return ['meses'=> $resultado, 'total' => array_sum($resultado)];


    }

    public static function despesa_categoria($ano, $categoria) {
        $months = [
            '01'=>'Jan', '02'=>'Feb', '03'=>'Mar','04'=>'Apr', 
            '05'=>'May', '06'=>'Jun','07'=>'Jul','08'=>'Aug', 
            '09'=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec',
        ];


        $desp = Despesa::whereHas('categorias', function(Builder $q) use ($categoria){
                $q->where('etiqueta','=',$categoria);
            })
            ->whereYear('data', '=', date($ano))
            ->get()
            ->groupBy(function($val){
                return Carbon::parse($val->data)->format('m/Y');
            }
        );

        $listagem = array();
        foreach($desp as $key => $item) {
            $listagem[explode('/',$key)[0]] = $item->sum(function($val){
                return $val->parcelas()->sum('valor');
            });
        }

        //completing the missed months - when there is no data for Categoria/Mes
        $diff = array_diff(array_keys($months), array_keys($listagem));
        $fill = array_fill_keys(array_values($diff), 0);
        $resultado = $fill + $listagem; 
        ksort($resultado);

        return $resultado;

    }

}
