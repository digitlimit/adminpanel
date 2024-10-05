<?php namespace Digitlimit\Adminpanel\Utils;

use Digitlimit\Adminpanel\Models\AdminpanelUser;
use Illuminate\Support\Facades\Request;

class Setting{

    protected $table;
    protected $model;
    protected $prefix;
    protected $route_options = [];

    public function __construct(){

        $this->app = app();

        //default middleware
        if(abs($this->app->version()) >= 5.2){
            $this->route_options['middleware'] = ['web'];
        }

        //set route prefix
        $this->prefix = config('adminpanel.base_url', 'adminpanel');

        //set table
        $this->table = config('adminpanel.auth_table', 'adminpanel_users');

        //set model
        $this->model = config('adminpanel.auth_model', AdminpanelUser::class);
    }


    public function isBackend(){
        return head(Request::segments()) == config('adminpanel.base_url', 'adminpanel');
    }

    public function getRouteOptions(){
        return $this->route_options;
    }

    public function getTable(){
        return $this->table;
    }

    public function getModel(){
        return $this->model;
    }

    public function getPrefix(){
        return $this->prefix;
    }
}