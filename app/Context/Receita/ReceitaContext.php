<?php 

namespace App\Context\Receita;


class ReceitaContext {

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
