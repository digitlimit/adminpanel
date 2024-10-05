<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\AdminpanelEvent;

class EventService extends BaseService
{

    public function __construct(Adminpanelevent $adminpanelEvent){
        $this->adminpanelEvent = $adminpanelEvent;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->adminpanelEvent->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->adminpanelEvent->find($id)->first();
    }

    public function store($event)
    {
        $event['slug'] = str_slug($event['title']);
        return $this->adminpanelEvent->create($event);
    }

    public function update($fields, $event)
    {
        $fields['slug'] = str_slug($fields['title']);
        return $event ? $event->update($fields) : false;
    }

    public function delete($event)
    {
        return $event ? $event->delete() : false;
    }

}