<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminpanelPluginPostSetupTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adminpanel_plugin_post_comments', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('user_ip')->nullable();
            $table->string('title')->nullable();
            $table->integer('post_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->boolean('approved')->default(0);
            $table->timestamps();
        });

        Schema::create('adminpanel_plugin_post_tags', function (Blueprint $table){
            $table->increments('id');
            $table->integer('post_id')->nullable();
            $table->string('name')->nullable();
        });

        Schema::create('adminpanel_plugin_post_types', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable();
        });

        Schema::create('adminpanel_plugin_posts', function (Blueprint $table){
            $table->increments('id');
            $table->integer('category_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('summary');
            $table->text('content');
            $table->string('privacy');
            $table->boolean('published')->default(0);
            $table->boolean('sticky')->default(0);

            $table->dateTime('published_date')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamp('published_at')->index();
            $table->string('featured_image')->nullable();
            $table->boolean('comments_allowed')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('adminpanel_plugin_post_comments');
        Schema::drop('adminpanel_plugin_post_types');
        Schema::drop('adminpanel_plugin_post_tags');
        Schema::drop('adminpanel_plugin_posts');
    }
}