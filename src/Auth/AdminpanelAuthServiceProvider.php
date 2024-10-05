<?php namespace Digitlimit\Adminpanel\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Digitlimit\Adminpanel\Models\AdminpanelUser;
use Auth;

class AdminpanelAuthServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(abs($this->app->version()) >= 5.2){
            Auth::provider('eloquent', function($app, array $config)
            {
                $hasher = app(HasherContract::class);
                $model = app(config('adminpanel.auth_model', AdminpanelUser::class));

                return new AdminpanelUserProvider($hasher, new $model);
            });
        }else{
            Auth::extend('eloquent',function($app)
            {
                $hasher = app(HasherContract::class);
                $model = app(config('adminpanel.auth_model', AdminpanelUser::class));

                return new AdminpanelUserProvider($hasher, new $model);
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}