<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationChart as Chart;

class ChartService{

    public function __construct(Chart $chart){
        $this->chart = $chart;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->chart->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->chart->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->chart->find($id);
    }

    public function store(array $chart)
    {
        return $this->chart->create($chart);
    }

    public function update($chart, array $data)
    {
        return $chart ? $chart->update($data) : false;
    }

    public function delete($chart)
    {
        return $chart ? $chart->delete() : false;
    }
}