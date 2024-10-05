<?php namespace Digitlimit\Adminpanel\Http\Services;

use Cache;

class BaseService{

    public function onStore(){
        Cache::forget('adminpanel_dashboard');
    }
}