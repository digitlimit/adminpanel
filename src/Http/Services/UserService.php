<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\User;

class UserService extends BaseService
{

    public function __construct(User $user){
        if($user_model = config('adminpanel.model')){
            $this->user = app($user_model);
        }elseif(config('adminpanel.entrust_enabled')){
            $this->user = app(\Digitlimit\Adminpanel\Models\UserEntrust::class);
        }else{
            $this->user = $user;
        }
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->user->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function show($id)
    {
        if($user = $this->user->find($id)){

            return [
                'id' => ['label' => 'User ID',  'value' => $user->id],
                'first_name' => ['label' => 'First name','value' => $user->first_name],
                'last_name' => ['label' => 'Last name','value' => $user->last_name],
                'biography' => ['label' => 'Biography', 'value' => $user->biography],
                'occupation' => ['label' => 'Occupation', 'value' => $user->occupation],
                'date_of_birth' => ['label' => 'Date of Birth','value' => $user->date_of_birth],
                'address' => ['label' => 'Address','value' => $user->address],
                'website' => ['label' => 'Website', 'value' => $user->website],
                'phone' => ['label' => 'Phone', 'value' => $user->phone],
                'roles' => ['label' => 'Roles', 'value' => $user->roles ? $user->roles->implode('display_name', ',') : ''],
                'country_id' => ['label' => 'Country','value' => $user->country ? $user->country->name: ''],
                'state_id' => ['label' => 'State','value' => $user->state ? $user->state->name: ''],
                'sex_menu_id' => ['label' => 'Sex','value' => $user->sex ? $user->sex->name: ''],
                'email' => ['label' => 'Email', 'value' => $user->email],
                'invite_date' => ['label' => 'Invite', 'value' => $user->invite_dt],
                'last_login_date' => ['label' => 'Last login', 'value' => $user->last_login_dt],
                'inviter_user_id' => ['label' => 'Inviter','value' => $user->inviter_user_id],
                'deleted_at' => ['label' => 'Deleted at','value' => $user->deleted_at],
                'status' => ['label' => 'Status','value' => $user->status],
                'verified' => ['label' => 'Verified', 'value' => $user->verified],
                'disabled' => ['label' => 'Disabled', 'value' => $user->disabled],
                'banned' => ['label' => 'Banned', 'value' => $user->banned],
                'social_registered' => ['label' => 'Registered via Social', 'value' => $user->social_registered],
                'social_logged_in' => ['label' => 'Social Login', 'value' => $user->social_logged_in],
                'social_password_set' => ['label' => 'Set Social password', 'value' => $user->social_password_set]
            ];
        }

        return false;
    }

    public function store($fields)
    {
        $fields['slug'] = str_slug($fields['title']);
        return $this->user->create($fields);
    }

    public function update($fields, $user)
    {
        $fields['slug'] = str_slug($fields['title']);
        return $user ? $user->update($fields) : false;
    }

    public function delete($user)
    {
        if($user){
            $user->delete();
            return true;
        }
        return true;
    }

    public function ban($user)
    {
        if($user){
            $user->banned = 1;
            $user->disabled = 1;
            $user->save();
            return true;
        }

        return false;
//        return $user ? $user->update(['banned'=>1, 'disabled'=>1]) : false;
    }

    public function unBan($user)
    {
        if($user){
            $user->banned = 0;
            $user->disabled = 0;
            $user->save();
            return true;
        }

        return false;
//        return $user ? $user->update(['banned'=>1, 'disabled'=>1]) : false;
    }
}