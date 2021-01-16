<?php 

namespace App\Context\Monetary;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

/**
 * summary
 */
class RealMoneyFormatter
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public static function format( $value ) {
		
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
}


