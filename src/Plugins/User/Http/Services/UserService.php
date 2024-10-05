<?php namespace Digitlimit\Adminpanel\Plugins\User\Http\Services;

use Digitlimit\Adminpanel\Models\User;
use Digitlimit\Adminpanel\Plugins\Calibration\Models\AdminpanelPluginCalibrationUser;

class UserService{

    protected $user;
    protected $calibrationUser;

    public function __construct(User $user, AdminpanelPluginCalibrationUser $calibrationUser){
        $this->user = $user;
        $this->calibrationUser = $calibrationUser;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->user->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->user->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function store(array $user)
    {
        $user['slug'] = str_slug($user['name']);
        return $this->user->create($user);
    }

    public function update($user, array $data)
    {
        return $user ? $user->update($data) : false;
    }

    public function delete($user)
    {
        return $user ? $user->delete() : false;
    }
}