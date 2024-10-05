<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\AdminpanelPlugin;
use Digitlimit\Adminpanel\Plugins\PluginContract;
use Digitlimit\Adminpanel\Http\Exceptions\PluginException;
use Illuminate\Filesystem\Filesystem as File;

class PluginService extends BaseService
{

    public function __construct(AdminpanelPlugin $adminpanelPlugin, PluginContract $plugin, File $file){
        $this->adminpanelPlugin = $adminpanelPlugin;
        $this->plugin = $plugin;
        $this->file = $file;
    }

    public function paginate($per_plugin=15, $columns=null, $orderBy='DESC')
    {
        return $this->adminpanelPlugin->orderBy('id', $orderBy)->paginate($per_plugin, $columns);
    }

    public function lists()
    {
        return $this->adminpanelPlugin->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->adminpanelPlugin->find($id);
    }

    public function store($plugin)
    {
        try{
            $this->plugin->install($plugin);
        }catch (PluginException $e){
            return $e->getMessage();
        }

        return true;
    }


    protected function addProvider($name){

    }

    public function update($fields, $plugin)
    {
    }

    public function delete($plugin)
    {
        if(adminpanel_plugin_exists($plugin->name)){
            $this->file->deleteDirectory(adminpanel_plugin_path($plugin->name));
        }
        return $plugin ? $plugin->delete() : false;
    }

    public function deleteOther($plugin){
        return $this->file->deleteDirectory(adminpanel_plugin_path($plugin));
    }

    public function discover(){
        return $this->plugin->discover();
    }

    public function activate($plugin){
        return $plugin->update(['active'=>1]);
    }

    public function deactivate($plugin){
        return $plugin->update(['active'=>0]);
    }
}