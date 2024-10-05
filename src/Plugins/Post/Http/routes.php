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

Route::group(['prefix' => 'adminpanel/posts', 'middleware'=>'web'], function($router)
{
    //Posts
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@getIndex',
        'as'   => 'adminpanel.post.getIndex'
    ]);

    $router->post('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@postStore',
        'as'   => 'adminpanel.post.postStore'
    ]);

    $router->get('/create',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@getCreate',
        'as'   => 'adminpanel.post.getCreate'
    ]);

    $router->get('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@getUpdate',
        'as'   => 'adminpanel.post.getUpdate'
    ]);

    $router->post('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@postUpdate',
        'as'   => 'adminpanel.post.postUpdate'
    ]);

    $router->get('/{id}/delete',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@getDelete',
        'as'   => 'adminpanel.post.getDelete'
    ]);

    $router->get('/{id}/delete-confirm',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Post\Http\Controllers\PostController@getDeleteConfirm',
        'as'   => 'adminpanel.post.getDeleteConfirm'
    ]);
});