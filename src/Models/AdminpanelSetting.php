<?php namespace Digitlimit\Adminpanel\Models;

use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelSetting extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'name',
        'value'
    ];


}