<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Services;

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
        return $this->calibrationUser->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->calibrationUser->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->calibrationUser->where('user_id', $id)->first();
    }

    public function store(array $data)
    {
        $user = $this->user->create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if(!$user) return;

        return $this->calibrationUser->create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'company_id' => $data['company'],
            'adminpanel_plugin_calibration_client_id' => $data['company']
        ]);
    }

    public function update($user, array $data)
    {
        if(!empty($data['password'])) $user->update(['password' => bcrypt($data['password'])]);

        return $this->calibrationUser->update([
            'user_id' => $user->id,
            'name' => $data['name'],
            'company_id' => $data['company'],
            'adminpanel_plugin_calibration_client_id' => $data['company']
        ]);
    }

    public function delete($user)
    {
        if($calibrationUser = $this->calibrationUser->where('user_id', $user->id)->first()){
            $calibrationUser->delete();
            $user->delete();
            return true;
        }
        return false;
    }
}