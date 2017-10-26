<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // die('view service provider');
        $this->leftBarComposer();
    }
    public function leftBarComposer()
    {
        return view()->composer('layouts.leftbar','App\Http\Composers\LeftBarComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
