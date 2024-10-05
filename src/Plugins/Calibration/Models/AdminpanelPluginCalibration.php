<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;

class AdminpanelPluginCalibration extends Model{

    use AdminpanelCache;

    protected $fillable = [
        'id',
        'adminpanel_plugin_calibration_client_id',
        'adminpanel_plugin_calibration_truck_id',
        'adminpanel_plugin_calibration_transporter_id',
        'adminpanel_plugin_calibration_chart_id',
        'adminpanel_plugin_calibration_document_id',
    ];


    public function client(){
        return $this->belongsTo(AdminpanelPluginCalibrationClient::class, 'adminpanel_plugin_calibration_client_id', 'id');
    }

    public function truck(){
        return $this->belongsTo(AdminpanelPluginCalibrationTruck::class, 'adminpanel_plugin_calibration_truck_id', 'id');
    }

    public function transporter(){
        return $this->belongsTo(AdminpanelPluginCalibrationTransporter::class, 'adminpanel_plugin_calibration_transporter_id', 'id');
    }

    public function chart(){
        return $this->belongsTo(AdminpanelPluginCalibrationChart::class, 'adminpanel_plugin_calibration_chart_id', 'id');
    }

    public function document(){
        return $this->belongsTo(AdminpanelPluginCalibrationDocument::class, 'adminpanel_plugin_calibration_document_id', 'id');
    }
}