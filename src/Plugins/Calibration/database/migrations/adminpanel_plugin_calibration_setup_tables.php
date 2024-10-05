<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminpanelPluginCalibrationSetupTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adminpanel_plugin_calibrations', function (Blueprint $table){
            $table->increments('id');
            $table->integer('adminpanel_plugin_calibration_client_id');
            $table->integer('adminpanel_plugin_calibration_truck_id');
            $table->integer('adminpanel_plugin_calibration_transporter_id');
            $table->integer('adminpanel_plugin_calibration_chart_id');
            $table->integer('adminpanel_plugin_calibration_document_id');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_users', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('adminpanel_plugin_calibration_client_id');
            $table->integer('company_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_trucks', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('model');
            $table->string('reg_number');
            $table->string('chassis_number');
            $table->integer('volume');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_clients', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('slug');
            $table->string('name');
            $table->string('detail');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_transporters', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('detail');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_charts', function (Blueprint $table){
            $table->increments('id');
            $table->integer('adminpanel_plugin_calibration_document_id');
            $table->string('chart_no');
            $table->date('issued_date');
            $table->date('expiry_date');
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_calibration_documents', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('adminpanel_plugin_calibrations');
        Schema::drop('adminpanel_plugin_calibration_users');
        Schema::drop('adminpanel_plugin_calibration_trucks');
        Schema::drop('adminpanel_plugin_calibration_clients');
        Schema::drop('adminpanel_plugin_calibration_transporters');
        Schema::drop('adminpanel_plugin_calibration_charts');
        Schema::drop('adminpanel_plugin_calibration_documents');
    }
}