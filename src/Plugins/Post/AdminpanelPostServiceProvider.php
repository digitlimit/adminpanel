<?php namespace Digitlimit\Adminpanel\Plugins\Post;

use Digitlimit\Adminpanel\Plugins\PluginServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Request;

class AdminpanelPostServiceProvider extends PluginServiceProvider
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
        $this->app['adminpanel.post'] = $this->app->share(function($app)
        {
            return new Post($app['session.store']);
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