<?php 

namespace App\Context\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * summary
 */
class FormatterFacade extends Facade
{
    protected static function getFacadeAccessor() {
    	return 'formatter';
    }
}

