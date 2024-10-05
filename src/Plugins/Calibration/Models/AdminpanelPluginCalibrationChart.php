<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginCalibrationChart extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'adminpanel_plugin_calibration_document_id',
        'chart_no',
        'issued_date',
        'expiry_date'
    ];

    public function getIssuedDateAttribute($value){
        return $value ? date_format(date_create($value),'F d, Y') : $value;
    }

    public function setIssuedDateAttribute($value)
    {
        $value = $value ? $value : date('Y-m-d');
        $this->attributes['issued_date'] = date_format(date_create($value),'Y-m-d');
    }


    public function getExpiryDateAttribute($value){
        return $value ? date_format(date_create($value),'F d, Y') : $value;
    }

    public function setExpiryDateAttribute($value)
    {
        $value = $value ? $value : date('Y-m-d');
        $this->attributes['expiry_date'] = date_format(date_create($value),'Y-m-d');
    }
}