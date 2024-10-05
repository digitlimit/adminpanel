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


Route::group(['prefix' => 'adminpanel/users', 'middleware'=>'web'], function($router)
{

    //Users
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@getIndex',
        'as'   => 'adminpanel.user.getIndex'
    ]);

    $router->post('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@postStore',
        'as'   => 'adminpanel.user.postStore'
    ]);

    $router->get('/create',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@getCreate',
        'as'   => 'adminpanel.user.getCreate'
    ]);

    $router->get('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@getUpdate',
        'as'   => 'adminpanel.user.getUpdate'
    ]);

    $router->post('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@postUpdate',
        'as'   => 'adminpanel.user.postUpdate'
    ]);

    $router->get('/{id}/delete',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@getDelete',
        'as'   => 'adminpanel.user.getDelete'
    ]);

    $router->get('/{id}/delete-confirm',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\User\Http\Controllers\UserController@getDeleteConfirm',
        'as'   => 'adminpanel.user.getDeleteConfirm'
    ]);

});