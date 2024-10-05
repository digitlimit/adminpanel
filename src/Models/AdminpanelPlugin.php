<?php namespace Digitlimit\Adminpanel\Models;

use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPlugin extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'title',
        'name',
        'icon',
        'active',
        'description',
        'migration_file',
        'version',
        'url'
    ];

    public function setPublishedDateAttribute($value){
        $this->attributes['published_date'] = date("Y-m-d", strtotime($value));
    }


    public function getPublishedDateAttribute($value){
        return date("d-m-Y", strtotime($value));
    }
}