<?php

use Illuminate\Database\Seeder;

class AdminpanelPluginPostSeeder extends Seeder
{
    public function run()
    {
        DB::table('adminpanel_plugin_posts')->delete();
        DB::table('adminpanel_plugin_posts')->insert([
            [
                'slug' => 'first_post',
                'title' => 'First Post',
                'summary' => 'First post summary',
                'content' => 'First post summary',
                'privacy' => 'public',
                'published' => 1,
                'created_at' => \Carbon\Carbon::createFromDate(2016, 7, 26)
            ],

            [
                'slug' => 'second_post',
                'title' => 'Second Post',
                'summary' => 'Second post summary',
                'content' => 'Second post summary',
                'privacy' => 'public',
                'published' => 1,
                'created_at' => \Carbon\Carbon::createFromDate(2016, 7, 26)
            ]
        ]);

    }
}