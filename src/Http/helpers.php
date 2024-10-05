<?php
/**
 * Check is at current route
 */
if(!function_exists('adminpanel_routeIs')){
    function adminpanel_routeIs($route_name){
        return Request::url() == route($route_name);
    }
}

if(!function_exists('adminpanel_isAjax')){
    function adminpanel_isAjax(){
        return ($this->ajax() && ! $this->pjax()) || $this->wantsJson();
    }
}

if(!function_exists('adminpanel_base_path')){
    function adminpanel_base_path($path=''){
        return __DIR__."/.." .($path ? DIRECTORY_SEPARATOR.$path : DIRECTORY_SEPARATOR);
    }
}

if(!function_exists('adminpanel_plugin_path')){
    function adminpanel_plugin_path($path = ''){
        return adminpanel_base_path('Plugins') .($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if(!function_exists('adminpanel_plugin_config')){
    function adminpanel_plugin_config($directory_name){

        $config = adminpanel_plugin_path($directory_name) . DIRECTORY_SEPARATOR . 'Plugin.php';

        if(!file_exists($config)) return;

        return $c = include $config;
    }
}

if(!function_exists('adminpanel_plugin_exists')){
    function adminpanel_plugin_exists($directory_name){
        return file_exists(adminpanel_plugin_path($directory_name));
    }
}

if(!function_exists('adminpanel_views')){
    function adminpanel_views(){
        dd(__DIR__);
    }
}

if(!function_exists('adminpanel_plugin_views')){
    function adminpanel_plugin_views(){
        dd(__DIR__);
    }
}

