<?php namespace Digitlimit\Adminpanel\Plugins;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.2
     *
     * @return void
     */
    public function register()
    {

    }


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {

    }

}