<?php 

namespace App\Context\Despesa;

use App\Models\Despesa;
use App\Models\Parcela;
use Carbon\Carbon;
use Auth;
use Formatter;


/**
 * summary
 */
class DespesaFixa implements PagamentoDespesaStrategy
{
    /**
     * summary
     */
    public function __construct()
    {
    	    
    }

    public function make (array $data) {

    	$despesa = new Despesa;
    	$despesa->descricao = $data['descricao'];
        $despesa->data = Carbon::create($data['data']);
        $despesa->fixa = 1;
        $despesa->user_id = Auth::user()->id;

        $despesa->save();
        
        $valor = Formatter::stringToMoney($data['valor']);
        $parcela = new Parcela;
        $parcela->despesa_id = $despesa->id;
        $parcela->valor = $valor;
        $parcela->save();

        //processar as parcelas
        //realizar intervalor aqui
        if (isset($data['repetir'])) {
            $dt_inicial = $despesa->data->copy();
            $dt_inicial->addMonth(1); 
            $dt_final = Carbon::create($data['data3']);
            $counter = $dt_inicial->diffInMonths($dt_final);
            for ($i = 0; $i <= $counter; $i++) {
                $nova_despesa = $despesa->replicate();
                $nova_despesa->data = $dt_inicial;

                if ($nova_despesa->data->lessThan($dt_final)) {
                    $nova_parc = $parcela->replicate();
                    $nova_parc->despesa_id = $nova_despesa->id;
                    $nova_parc->save();
                } 
                
                $dt_inicial->addMonth(1); 
            }
        }
    }
}