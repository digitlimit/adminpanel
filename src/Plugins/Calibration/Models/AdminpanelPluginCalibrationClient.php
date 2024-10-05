<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginCalibrationClient extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'id',
        'user_id',
        'slug',
        'name',
        'detail'
    ];

    public function calibrations(){
        return $this->hasMany(AdminpanelPluginCalibration::class, 'adminpanel_plugin_calibration_client_id');
    }
}