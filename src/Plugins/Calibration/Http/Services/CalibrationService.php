<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibration as Calibration;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\DocumentService;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\ChartService;

use Illuminate\Filesystem\Filesystem as File;

class CalibrationService{

    protected  $charts_dir;

    public function __construct(Calibration $calibration, DocumentService $documentService, ChartService $chartService, File $file){
        $this->calibration = $calibration;
        $this->documentService = $documentService;
        $this->chartService = $chartService;

        $this->file = $file;
        $this->charts_dir = storage_path('pdf/charts');
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->calibration->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->calibration->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->calibration->find($id);
    }

    public function store(array $calibration)
    {
        extract($calibration);

        //create dir if not exists
        $this->charts_dir = storage_path('pdf/charts');
        if(!is_dir($this->charts_dir)) $this->file->makeDirectory($this->charts_dir,0775, true);

        //new filename
        $filename_name = str_slug($chart_no) . "." .$chart->extension();

        //save in documents table
        $document = $this->documentService->store([
            'title' => $chart->getClientOriginalName(),
            'name' => $filename_name,
            'type' => $chart->extension()
        ]);

        if(!$document) return false; //throw exception later

        //upload file
        $chart->move($this->charts_dir, $filename_name);

        //save in charts table
        $chart = $this->chartService->store([
            'adminpanel_plugin_calibration_document_id' => $document->id,
            'chart_no' => $chart_no,
            'issued_date' => $issued_date,
            'expiry_date' => $expiry_date
        ]);

        if(!$chart) return false; //throw an exception later bro


        //create calibration
        //["title", "truck", "transporter", "issued_date", "client", "chart_no", "expiry_date", "chart"]
        return $this->calibration->create([
            'adminpanel_plugin_calibration_client_id' => $client,
            'adminpanel_plugin_calibration_truck_id' => $truck,
            'adminpanel_plugin_calibration_transporter_id' => $transporter,
            'adminpanel_plugin_calibration_chart_id' => $chart->id,
            'adminpanel_plugin_calibration_document_id' => $document->id
        ]);
    }

    public function update($calibration, array $data)
    {
        return $calibration ? $calibration->update($data) : false;
    }

    public function delete($calibration)
    {
        if(!$calibration->document) return;

        //remove document from storage
        $file = $this->charts_dir . DIRECTORY_SEPARATOR . $calibration->document->name;
        if(file_exists($file)) $this->file->delete($file);

        //delete from ducuments table
        $calibration->document->delete();

        return $calibration ? $calibration->delete() : false;
    }
}