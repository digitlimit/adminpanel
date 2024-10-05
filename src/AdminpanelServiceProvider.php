<?php namespace Digitlimit\Adminpanel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

use Digitlimit\Adminpanel\Http\Middleware\AdminMiddleware;
use Digitlimit\Adminpanel\Http\Middleware\PublicMiddleware;
use Digitlimit\Adminpanel\Http\Middleware\AuthenticatedMiddleware;
use Digitlimit\Adminpanel\Http\Middleware\FrontendMiddleware;
use Digitlimit\Adminpanel\Http\Middleware\BackendMiddleware;

use Digitlimit\Adminpanel\Auth\AdminpanelAuthServiceProvider;
use Digitlimit\Adminpanel\Http\Composers\AdminpanelDashboardComposer;
use Digitlimit\Adminpanel\Utils\Setting;

use Digitlimit\Adminpanel\Plugins\Plugin;
use Digitlimit\Adminpanel\Plugins\PluginContract;



class AdminpanelServiceProvider extends ServiceProvider
{

    /**
     * Collections of sidebars.
     *
     * @var array
     */
    protected $sidebars  = [];


    /**
     * Collection of dashboards.
     *
     * @var bool
     */
    protected $dashboards  = [];


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //register adminpanel
        $this->app['adminpanel'] = $this->app->share(function($app)
        {
            return new Adminpanel();
        });

        //bindings
        $this->app->bind(PluginContract::class,Plugin::class);
    }


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router, Setting $adminpanel, PluginContract $plugin)
    {
        //these blocks runs only if we are in adminpanel URL
        if($adminpanel->isBackend())
        {
            //view share
            view()->composer(
                '*', AdminpanelDashboardComposer::class
            );
        }

//        $composer = require base_path('vendor/autoload.php');
//        $composer->add("Digitlimit\\Adminpanel\\Plugin\\", base_path('plugins/digitlimit/adminpanel/plugin/'));
//dd($composer);
//dd(base_path('plugins/digitlimit/adminpanel/plugin/'));


//        $hello = new \Digitlimit\Adminpanel\Plugin\Hello\Hello();
//        dd($hello->sayHello());
        //register routes

        include_once __DIR__ . '/Http/routes.php';
        include_once __DIR__ . '/Http/helpers.php';

        $this->registerProviders($plugin);

        //use adminpanel authenticator in to adminpanel
        if(head(\Request::segments()) == config('adminpanel.base_url', 'adminpanel')){
            $this->app->register(AdminpanelAuthServiceProvider::class);
        }

        //register middleware
        $this->registerMiddlewares($router);

        //paths
        $this->setViewPath();
        $this->setPublications();
    }

    protected function registerMiddlewares($router){
        $router->middleware('adminpanel.admin', AdminMiddleware::class);
        $router->middleware('adminpanel.public', PublicMiddleware::class);
        $router->middleware('adminpanel.backend', BackendMiddleware::class);
        $router->middleware('adminpanel.frontend', FrontendMiddleware::class);
    }

    protected function registerProviders($plugin_model){

        //register only active plugins
        if(\Schema::hasTable('adminpanel_plugins'))
        {
            $plugins = $plugin_model->active();

            foreach($plugins as $active){

                //checks if service provider exists
                $plugin_provider = "Digitlimit\Adminpanel\Plugins\\{$active->name}\Adminpanel{$active->name}ServiceProvider";
                if(!class_exists($plugin_provider)) continue;

                //register plugin service provider
                $this->app->register($plugin_provider);

                //include plugin routes
                $plugin_route = adminpanel_plugin_path("$active->name/Http/routes.php");
                if(!file_exists($plugin_route)) continue;

                //include routes
                include_once $plugin_route;

                //register menus, dashboards, widgets
                $class = "Digitlimit\Adminpanel\Plugins\\{$active->name}\\{$active->name}";
                if(!class_exists($class)) continue;

                //make plugin
                $plugin = app($class);

                //call register plugin sidebars
                if(method_exists($plugin, 'registerSidebar')){
                    $sidebar = $plugin->registerSidebar();
                    $this->registerSidebar($sidebar);
                }

                //call register plugin dashboard
                if(method_exists($plugin, 'registerDashboard') && adminpanel_routeIs('adminpanel.dashboard.index')){
                    $dashboard = $plugin->registerDashboard();
                    $this->registerDashboard($dashboard);
                }

                //call_user_func_array([$plugin, "registerDashboard"], []);
            }
        }
    }

    /**
     * Sets view path
     */
    protected function setViewPath()
    {
        $theme = config('adminpanel.theme');

        if(file_exists($vendor_views = resource_path("views/vendor/adminpanel/themes/$theme/5454545455555"))){
            $this->loadViewsFrom($vendor_views, 'adminpanel');
        }else{
            $this->loadViewsFrom(__DIR__ . "/Themes/$theme", 'adminpanel');
        }
    }

    /**
     * Sets publications
     */
    protected function setPublications()
    {
        //create plugins if not exists
        $plugin_dir = config('adminpanel.plugins_dir', realpath(base_path('plugins')));
        if(!is_dir($plugin_dir)) \File::makeDirectory($plugin_dir, 0775, true, true);

        //publishes assets
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=assets
        $this->publishes([
            __DIR__.'/plugins' => $plugin_dir,
        ], 'plugins');

        //publish config
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=config
        $this->publishes([
            __DIR__ . '/config' => config_path(),
        ], 'config');

        //publishes views
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=views
        $this->publishes([
            __DIR__ . '/themes' => base_path('resources/views/vendor/adminpanel')
        ], 'views');

        //publishes migrations
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=migrations
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('/migrations')
        ], 'migrations');


        //publishes seeder
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=seeds
        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('/seeds')
        ], 'seeds');

        //publishes assets
        //php artisan vendor:publish --provider="Digitlimit\Adminpanel\AdminpanelServiceProvider"  --tag=assets
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/adminpanel'),
        ], 'assets');
    }



    /**
     * Registers an admin sidebar menu
     * @param array $sidebar
     */
    protected function registerSidebar(array $sidebar=[]){

        $sidebar['has_menus'] = (bool) isset($sidebar['sub_menu']);

        $this->sidebars[] = (object) $sidebar;

        view()->share('sidebars', $this->sidebars);
    }


    protected function registerDashboard(array $dashboard=[]){

        if(!adminpanel_routeIs('adminpanel.dashboard.index')) return;

        $this->dashboards[] = (object) $dashboard;

        view()->share('dashboards', $this->dashboards);
    }
}