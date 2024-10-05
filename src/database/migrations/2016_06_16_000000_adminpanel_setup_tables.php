<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminpanelSetupTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adminpanel_users', function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title')->nullable();
            $table->string('email');
            $table->string('password');
            $table->dateTime('deleted_at')->nullable();
            $table->string('salt', 100);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('adminpanel_plugins', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->string('version');
            $table->string('icon');
            $table->boolean('active')->default(0);
            $table->string('description');
            $table->string('migration_file');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('adminpanel_settings', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('adminpanel_option_groups', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('adminpanel_options', function (Blueprint $table){
            $table->increments('id');
            $table->integer('option_group_id');
            $table->string('name');
            $table->string('value');
            $table->string('description');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('adminpanel_users');
        Schema::drop('adminpanel_plugins');
        Schema::drop('adminpanel_settings');
        Schema::drop('adminpanel_option_groups');
        Schema::drop('adminpanel_options');
    }
}