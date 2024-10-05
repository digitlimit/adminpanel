<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\Permission;

class PermissionService extends BaseService
{
    public function __construct(){
        $this->permission = config('entrust.permission') ? app(Permission::class) : null;
    }

    public function all()
    {
        return $this->permission ? $this->permission->all() : null;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->permission->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

}