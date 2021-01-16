<?php 

namespace App\Context\Despesa;

/**
 * summary
 */
class PagamentoDespesaContext
{

	private $strategy;
    /**
     * summary
     */
    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param type $strategy
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function make ($data) {
		$this->strategy->make($data);
    }
}