<?php 


namespace App\Context\Despesa;


interface PagamentoDespesaStrategy
{

	/**
	 * 	this array is the data set of request
	 * 	
	 */
	public function make(array $data);

}
