<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationDocument as Document;

class DocumentService{

    public function __construct(Document $document){
        $this->document = $document;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->document->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->document->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->document->find($id);
    }

    public function store(array $document)
    {
        return $this->document->create($document);
    }

    public function update($document, array $data)
    {
        return $document ? $document->update($data) : false;
    }

    public function delete($document)
    {
        return $document ? $document->delete() : false;
    }
}