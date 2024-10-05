<?php namespace Digitlimit\Adminpanel\Plugins\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginPost extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'privacy',
        'published',
        'published_at'
    ];

    protected $dates = ['published_at'];
}