<?php

use Illuminate\Database\Seeder;

class AdminpanelSeeder extends Seeder
{
    public function run()
    {
        DB::table('adminpanel_users')->delete();
        DB::table('adminpanel_users')->insert([
            [
                'role_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@localhost.com',
                'password' => \Hash::make('admin'),
                'job_title' => 'Web Developer',
            ]
        ]);

        DB::table('adminpanel_events')->delete();
        DB::table('adminpanel_events')->insert([
            [
                'slug' => 'employee_soft_skill',
                'title' => 'Employee Soft Skill',
                'detail' => 'Employee Soft Skill at First Bank Nigeria',
                'venue' => 'TC Event Place',
                'active' => 1,
                'start_time' => \Carbon\Carbon::createFromTime(10,20,1),
                'start_date'=> \Carbon\Carbon::createFromDate(2016, 7, 27),
                'end_time' => \Carbon\Carbon::createFromTime(12,20,1),
                'end_date'=> \Carbon\Carbon::createFromDate(2016, 7, 27)
            ],

            [
                'slug' => 'training_at_firstBank',
                'title' => 'Training at FirstBank',
                'detail' => 'Employee Soft Skill at First Bank Nigeria',
                'venue' => 'TC Event Place',
                'active' => 1,
                'start_time' => \Carbon\Carbon::createFromTime(10,40,1),
                'start_date'=> \Carbon\Carbon::createFromDate(2016, 7, 27),
                'end_time' => \Carbon\Carbon::createFromTime(12,20,1),
                'end_date'=> \Carbon\Carbon::createFromDate(2016, 7, 27)
            ]
        ]);


        DB::table('adminpanel_videos')->delete();
        DB::table('adminpanel_videos')->insert([
            [
                'title' => 'Create and Share Calendar in Outlook',
                'youtube' => 'VAxsCOH-Z18',
                'privacy' => 'public',
                'expires_on' => \Carbon\Carbon::createFromDate(2016, 7, 26)
            ]
        ]);


        DB::table('adminpanel_posts')->delete();
        DB::table('adminpanel_posts')->insert([
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


        DB::table('adminpanel_pages')->delete();
        DB::table('adminpanel_pages')->insert([
            [
                'slug' => 'first_page',
                'title' => 'First Page',
                'summary' => 'First page summary',
                'content' => 'First page summary',
                'published' => 1,
                'privacy' => 'public',
                'meta_keywords' => 'Just the first page',
                'published_date' => \Carbon\Carbon::createFromDate(2016, 7, 26),
                'published_at' => \Carbon\Carbon::createFromDate(2016, 7, 26),
            ]
        ]);

    }
}