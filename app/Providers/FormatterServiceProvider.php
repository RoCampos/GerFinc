<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Context\Monetary\Formatter;

class FormatterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('formatter', function(){
            return new Formatter;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
