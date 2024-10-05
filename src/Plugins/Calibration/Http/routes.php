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


Route::group(['prefix' => 'adminpanel/calibration', 'middleware'=>'web'], function($router)
{

    //Calibration
    // ------------------------------------------------------------------------------------------------------------------
    //Calibration
// ------------------------------------------------------------------------------------------------------------------
    $router->get('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@getIndex',
        'as'   => 'adminpanel.calibration.getIndex'
    ]);

    $router->post('/',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@postStore',
        'as'   => 'adminpanel.calibration.postStore'
    ]);

    $router->get('/create',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@getCreate',
        'as'   => 'adminpanel.calibration.getCreate'
    ]);

    $router->get('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@getUpdate',
        'as'   => 'adminpanel.calibration.getUpdate'
    ]);

    $router->post('/{id}/update',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@postUpdate',
        'as'   => 'adminpanel.calibration.postUpdate'
    ]);

    $router->get('/{id}/delete',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@getDelete',
        'as'   => 'adminpanel.calibration.getDelete'
    ]);

    $router->get('/{id}/delete-confirm',[
        'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\CalibrationController@getDeleteConfirm',
        'as'   => 'adminpanel.calibration.getDeleteConfirm'
    ]);


    //Clients
    // -----------------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'clients'], function($router)
    {
        $router->get('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@getIndex',
            'as'   => 'adminpanel.calibration.client.getIndex'
        ]);

        $router->post('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@postStore',
            'as'   => 'adminpanel.calibration.client.postStore'
        ]);

        $router->get('/create',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@getCreate',
            'as'   => 'adminpanel.calibration.client.getCreate'
        ]);

        $router->get('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@getUpdate',
            'as'   => 'adminpanel.calibration.client.getUpdate'
        ]);

        $router->post('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@postUpdate',
            'as'   => 'adminpanel.calibration.client.postUpdate'
        ]);

        $router->get('/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@getDelete',
            'as'   => 'adminpanel.calibration.client.getDelete'
        ]);

        $router->get('/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ClientController@getDeleteConfirm',
            'as'   => 'adminpanel.calibration.client.getDeleteConfirm'
        ]);
    });




    //Trucks
    // -----------------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'trucks'], function($router)
    {
        $router->get('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@getIndex',
            'as'   => 'adminpanel.calibration.truck.getIndex'
        ]);

        $router->post('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@postStore',
            'as'   => 'adminpanel.calibration.truck.postStore'
        ]);

        $router->get('/create',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@getCreate',
            'as'   => 'adminpanel.calibration.truck.getCreate'
        ]);

        $router->get('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@getUpdate',
            'as'   => 'adminpanel.calibration.truck.getUpdate'
        ]);

        $router->post('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@postUpdate',
            'as'   => 'adminpanel.calibration.truck.postUpdate'
        ]);

        $router->get('/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@getDelete',
            'as'   => 'adminpanel.calibration.truck.getDelete'
        ]);

        $router->get('/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TruckController@getDeleteConfirm',
            'as'   => 'adminpanel.calibration.truck.getDeleteConfirm'
        ]);
    });




    //Transporters
    // -----------------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'transporters'], function($router)
    {
        $router->get('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@getIndex',
            'as'   => 'adminpanel.calibration.transporter.getIndex'
        ]);

        $router->post('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@postStore',
            'as'   => 'adminpanel.calibration.transporter.postStore'
        ]);

        $router->get('/create',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@getCreate',
            'as'   => 'adminpanel.calibration.transporter.getCreate'
        ]);

        $router->get('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@getUpdate',
            'as'   => 'adminpanel.calibration.transporter.getUpdate'
        ]);

        $router->post('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@postUpdate',
            'as'   => 'adminpanel.calibration.transporter.postUpdate'
        ]);

        $router->get('/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@getDelete',
            'as'   => 'adminpanel.calibration.transporter.getDelete'
        ]);

        $router->get('/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\TransporterController@getDeleteConfirm',
            'as'   => 'adminpanel.calibration.transporter.getDeleteConfirm'
        ]);
    });



    //Charts
    // -----------------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'charts'], function($router)
    {
        $router->get('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@getIndex',
            'as'   => 'adminpanel.calibration.chart.getIndex'
        ]);

        $router->post('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@postStore',
            'as'   => 'adminpanel.calibration.chart.postStore'
        ]);

        $router->get('/create',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@getCreate',
            'as'   => 'adminpanel.calibration.chart.getCreate'
        ]);

        $router->get('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@getUpdate',
            'as'   => 'adminpanel.calibration.chart.getUpdate'
        ]);

        $router->post('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@postUpdate',
            'as'   => 'adminpanel.calibration.chart.postUpdate'
        ]);

        $router->get('/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@getDelete',
            'as'   => 'adminpanel.calibration.chart.getDelete'
        ]);

        $router->get('/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\ChartController@getDeleteConfirm',
            'as'   => 'adminpanel.calibration.chart.getDeleteConfirm'
        ]);
    });




    //Users
    // -----------------------------------------------------------------------------------------------------------------
    Route::group(['prefix' => 'users'], function($router)
    {
        $router->get('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@getIndex',
            'as'   => 'adminpanel.calibration.user.getIndex'
        ]);

        $router->post('/',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@postStore',
            'as'   => 'adminpanel.calibration.user.postStore'
        ]);

        $router->get('/create',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@getCreate',
            'as'   => 'adminpanel.calibration.user.getCreate'
        ]);

        $router->get('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@getUpdate',
            'as'   => 'adminpanel.calibration.user.getUpdate'
        ]);

        $router->post('/{id}/update',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@postUpdate',
            'as'   => 'adminpanel.calibration.user.postUpdate'
        ]);

        $router->get('/{id}/delete',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@getDelete',
            'as'   => 'adminpanel.calibration.user.getDelete'
        ]);

        $router->get('/{id}/delete-confirm',[
            'uses' => 'Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers\UserController@getDeleteConfirm',
            'as'   => 'adminpanel.calibration.user.getDeleteConfirm'
        ]);
    });

});