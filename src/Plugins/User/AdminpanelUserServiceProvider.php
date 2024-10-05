<?php namespace Digitlimit\Adminpanel\Plugins\User;

use Digitlimit\Adminpanel\Plugins\PluginServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Request;

class AdminpanelUserServiceProvider extends PluginServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['adminpanel.user'] = $this->app->share(function($app)
        {
            return new User($app['session.store']);
        });
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