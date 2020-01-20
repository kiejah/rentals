<?php

namespace App\Providers\v1;

use App\Services\v1\PropertiesService;
use Illuminate\Support\ServiceProvider;

class PropertyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(PropertiesService::class,function($app){
            return new PropertiesService();
        });
    }
}
