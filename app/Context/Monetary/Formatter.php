<?php 

namespace App\Context\Monetary;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Datetime;

/**
 * summary
 */
class Formatter
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public static function realmonetary( $value ) {
		
    	$value = new Money($value, new Currency('BRL'));
		$numformatter = new \NumberFormatter(
			'pt_BR', 
			\NumberFormatter::CURRENCY
		);
		$formatter = new IntlMoneyFormatter(
			$numformatter, 
			new ISOCurrencies()
		);

		return $formatter->format($value);
    }

    public static function stringToMoney( $value ) {
        //corrigindo vígula/ponto
        $valor = preg_replace('/\,/','', $value);
        $valor = preg_replace('/\./','', $valor);
        return $valor;
    }



    public static function dataformat( $value ) {
    	$data = new Datetime($value);
    	return $data->format('d/M/Y');
    }
}


