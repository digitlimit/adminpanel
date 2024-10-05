<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\Role;
use Digitlimit\Adminpanel\Models\RoleUser;
use Digitlimit\Adminpanel\Models\PermissionRole;

class RoleService extends BaseService
{
    public function __construct(PermissionRole $permissionRole){
        $this->role = config('entrust.role') ? app(Role::class) : null;
        $this->permissionRole = config('entrust.role') ? $permissionRole : null;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->role->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function permissionRole($role_id){
        return $this->permissionRole->where('role_id', $role_id);
    }

    public function attachPermission($permissions, $role)
    {
        $data = [];

        foreach($permissions['permissions'] as $permission_id){
            $data[] = [
                'role_id' => $role->id,
                'permission_id' =>$permission_id
            ];
        }

        //Delete all existing permission for this role so to avoid duplicates
        if($existing_role_permission = $this->permissionRole($role->id)){
            $existing_role_permission->delete();
        }

        //insert fresh role/permissions
        $this->permissionRole->insert($data);

        return true;
    }

    public function roleByName($name)
    {
        return $this->role ? $this->role->where('name', $name)->first() : null;
    }
}