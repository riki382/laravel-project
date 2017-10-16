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
        // die('view service');
        $this->leftBarComposer();  
        $this->sliderComposer();      
    }

    public function leftBarComposer()
    {
        return view()->composer('layouts.leftbar', 'App\Http\Composers\LeftBarComposer@compose');
    }

    public function sliderComposer()
    {
        return view()->composer('layouts.slider', 'App\Http\Composers\SliderComposer@compose');    
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
