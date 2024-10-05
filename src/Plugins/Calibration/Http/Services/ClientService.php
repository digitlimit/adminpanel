<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationClient as Client;

class ClientService{

    public function __construct(Client $client){
        $this->client = $client;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->client->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->client->lists('name', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->client->find($id);
    }

    public function store(array $client)
    {
        $client['slug'] = str_slug($client['name']);
        return $this->client->create($client);
    }

    public function update($client, array $data)
    {
        return $client ? $client->update($data) : false;
    }

    public function delete($client)
    {
        return $client ? $client->delete() : false;
    }
}