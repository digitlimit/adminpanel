<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginCalibrationTransporter extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'id',
        'name',
        'detail'
    ];

    
}