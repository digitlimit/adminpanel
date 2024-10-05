<?php namespace Digitlimit\Adminpanel\Plugins\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginVideo extends Model{

    use AdminpanelCache;

    protected $fillable =[
        'title',
        'video_id',
        'detail',
        'youtube',
        'name',
        'privacy',
        'expires_on'
    ];

    protected static function boot(){
        parent::boot();
        static::saved(function($model) { // before delete() method call this
            \Cache::forget('adminpanel_dashboard');
        });
    }
}