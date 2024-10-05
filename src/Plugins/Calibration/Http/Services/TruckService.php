<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationTruck as Truck;

class TruckService{

    public function __construct(Truck $truck){
        $this->truck = $truck;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->truck->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->truck->lists('reg_number', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->truck->find($id);
    }

    public function store(array $truck)
    {
        return $this->truck->create($truck);
    }

    public function update($truck, array $data)
    {
        return $truck ? $truck->update($data) : false;
    }

    public function delete($truck)
    {
        return $truck ? $truck->delete() : false;
    }
}