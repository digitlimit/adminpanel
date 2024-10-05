<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\PermissionRole;

class PermissionRoleService extends BaseService
{
    public function __construct(PermissionRole $permissionRole){
        $this->permissionRole = config('entrust.permission') ? $permissionRole : null;
    }

    public function all()
    {
        return $this->permissionRole ? $this->permissionRole->all() : null;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->permissionRole->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }
}