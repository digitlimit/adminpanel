<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;
use Digitlimit\Adminpanel\Models\User;

class  AdminpanelPluginCalibrationUser extends Model{

    use AdminpanelCache;

//    protected $table = 'adminpanel_plugin_calibration_users';

    protected $fillable = [
        'user_id',
        'name',
        'company_id',
        'adminpanel_plugin_calibration_client_id'
    ];

    public function client(){
        return $this->hasOne(AdminpanelPluginCalibrationClient::class, 'id', 'adminpanel_plugin_calibration_client_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}