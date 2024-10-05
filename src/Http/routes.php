<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


$router->group(['prefix'=>$adminpanel->getPrefix(),
    'middleware'=>['web', 'adminpanel.backend']],
    function($router)
{
    // Dashboard
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/', [
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\DashboardController@index',
        'as' => 'adminpanel.dashboard.index'
    ]);

    // Auth
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/login',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\AuthController@getLogin',
        'as'   => 'adminpanel.auth.getLogin'
    ]);

    $router->post('/login',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\AuthController@postLogin',
        'as'   => 'adminpanel.auth.postLogin'
    ]);

    $router->get('/logout',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\AuthController@getLogout',
        'as'   => 'adminpanel.auth.getLogout'
    ]);


    // User
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/users/create',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getCreate',
        'as'   => 'adminpanel.user.getCreate'
    ]);

    $router->post('/users',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@postStore',
        'as'   => 'adminpanel.user.postStore'
    ]);

    $router->get('/users/{id}/delete-confirm',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getDeleteConfirm',
        'as'   => 'adminpanel.user.getDeleteConfirm'
    ]);

    $router->get('/users/{id}/delete',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getDelete',
        'as'   => 'adminpanel.user.getDelete'
    ]);

    $router->get('/users/{id}/ban',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getBan',
        'as'   => 'adminpanel.user.getBan'
    ]);

    $router->get('/users/{id}/un-ban',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getUnBan',
        'as'   => 'adminpanel.user.getUnBan'
    ]);

    $router->get('/users/{id}',[
        'uses' => 'Digitlimit\Adminpanel\Http\Controllers\UserController@getShow',
        'as'   => 'adminpanel.user.getShow'
    ]);

    //Plugin
    // ------------------------------------------------------------------------------------------------------------------
        $router->get('/plugins',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getIndex',
            'as'   => 'adminpanel.plugin.getIndex'
        ]);

        $router->post('/plugins',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@postStore',
            'as'   => 'adminpanel.plugin.postStore'
        ]);

        $router->get('/plugins/create',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getCreate',
            'as'   => 'adminpanel.plugin.getCreate'
        ]);

        $router->get('/plugins/{id}/activate',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getActivate',
            'as'   => 'adminpanel.plugin.getActivate'
        ]);

        $router->get('/plugins/{id}/deactivate',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getDeactivate',
            'as'   => 'adminpanel.plugin.getDeactivate'
        ]);

        $router->get('/plugins/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getDeleteConfirm',
            'as'   => 'adminpanel.plugin.getDeleteConfirm'
        ]);

        $router->get('/plugins/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getDelete',
            'as'   => 'adminpanel.plugin.getDelete'
        ]);

        $router->get('/plugins/others',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getOther',
            'as'   => 'adminpanel.plugin.getOther'
        ]);

        $router->get('/plugins/others/{name}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getOtherDeleteConfirm',
            'as'   => 'adminpanel.plugin.getOtherDeleteConfirm'
        ]);

        $router->get('/plugins/others/{name}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getOtherDelete',
            'as'   => 'adminpanel.plugin.getOtherDelete'
        ]);

        $router->get('/plugins/others/{name}/install',[
            'uses' => 'Digitlimit\Adminpanel\Http\Controllers\PluginController@getOtherInstall',
            'as'   => 'adminpanel.plugin.getOtherInstall'
        ]);
});