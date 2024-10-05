<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Product Images Folder
    |--------------------------------------------------------------------------
    |
    | All products images are uploaded here
    |
    */

    'name' => env('ADMINPANEL_NAME', 'Adminpanel'),
    'model'=> env('ADMINPANEL_MODEL', App\Models\User::class),
    'base_url' => env('ADMINPANEL_BASE_URL', 'adminpanel'),
    'assets' => env('ADMINPANEL_ASSETS', 'vendor/adminpanel/'),
    'theme' => env('ADMINPANEL_THEME', 'classic'),
    'uploads' => env('ADMINPANEL_UPLOADS', public_path('uploads/adminpanel')),
    'entrust_enabled' => env('ADMINPANEL_ROLE_ENGINE', false),

    'auth_model' => env('ADMINPANEL_AUTH_MODEL', Digitlimit\Adminpanel\Models\AdminpanelUser::class),
    'auth_table' => env('ADMINPANEL_AUTH_TABLE', 'adminpanel_users'),
    'guest_login_url' => env('ADMINPANEL_GUEST_LOGIN_URL', '/login'),

    'page_templates_dir' => env('ADMINPANEL_TEMPLATE_DIR', realpath(base_path('resources/views/templates'))),
    'plugins_dir' => env('PLUGINS_DIR', realpath(base_path('plugins')))
];
