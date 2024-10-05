<?php namespace Digitlimit\Adminpanel\Models;

use Illuminate\Database\Eloquent\Model;
use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationClient;

class User extends Model{

    protected $fillable = [
        'email',
        'password'
    ];
}