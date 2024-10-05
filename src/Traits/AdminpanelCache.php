<?php namespace Digitlimit\Adminpanel\Traits;

use Cache;

trait AdminpanelCache{

    protected static function boot(){

        parent::boot();

        static::saved(function($model) {
            Cache::forget('adminpanel_dashboard');
        });

        static::updated(function($model) {
            Cache::forget('adminpanel_dashboard');
        });

        static::created(function($model) {
            Cache::forget('adminpanel_dashboard');
        });

        static::deleted(function($model) {
            Cache::forget('adminpanel_dashboard');
        });
    }

}