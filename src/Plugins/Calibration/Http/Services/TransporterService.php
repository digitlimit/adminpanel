<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationTransporter as Transporter;

class TransporterService{

    public function __construct(Transporter $transporter){
        $this->transporter = $transporter;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->transporter->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->transporter->lists('name', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->transporter->find($id);
    }

    public function store(array $transporter)
    {
        $transporter['slug'] = str_slug($transporter['name']);
        return $this->transporter->create($transporter);
    }

    public function update($transporter, array $data)
    {
        return $transporter ? $transporter->update($data) : false;
    }

    public function delete($transporter)
    {
        return $transporter ? $transporter->delete() : false;
    }
}