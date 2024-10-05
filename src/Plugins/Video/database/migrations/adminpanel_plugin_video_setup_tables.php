<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminpanelPluginVideoSetupTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adminpanel_plugin_videos', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('youtube');
            $table->string('name');
            $table->string('video_id');
            $table->string('detail');
            $table->string('privacy');
            $table->dateTime('expires_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('adminpanel_plugin_videos');
    }
}