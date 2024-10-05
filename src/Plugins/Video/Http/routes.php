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

Route::group(['prefix' => 'adminpanel/videos', 'middleware'=>'web'], function($router)
{
    //Videos
    // -----------------------------------------------------------------------------------------------------------------
    $router->get('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getIndex',
        'as'   => 'adminpanel.video.getIndex'
    ]);

    $router->get('/create',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getCreate',
        'as'   => 'adminpanel.video.getCreate'
    ]);

    $router->post('/videos',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@postStore',
        'as'   => 'adminpanel.video.postStore'
    ]);


    $router->get('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getUpdate',
        'as'   => 'adminpanel.video.getUpdate'
    ]);

    $router->post('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@postUpdate',
        'as'   => 'adminpanel.video.postUpdate'
    ]);

    $router->get('/{id}/delete-confirm',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getDeleteConfirm',
        'as'   => 'adminpanel.video.getDeleteConfirm'
    ]);

    $router->get('/{id}/delete',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getDelete',
        'as'   => 'adminpanel.video.getDelete'
    ]);

    $router->get('/{id}',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Video\Http\Controllers\VideoController@getShow',
        'as'   => 'adminpanel.video.getShow'
    ]);

});