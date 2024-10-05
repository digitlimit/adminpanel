<?php namespace Digitlimit\Adminpanel\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Digitlimit\Adminpanel\Traits\AdminpanelCache;
use Zizaco\Entrust\Traits\EntrustUserTrait;
//, EntrustUserTrait;

class AdminpanelUser extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, AdminpanelCache;

    protected $softDelete = true;

    protected $table = 'adminpanel_users';
//    protected $primaryKey  = 'admin_id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'salt',
        'status'
    ];

    protected static function boot(){
        parent::boot();
        static::saved(function($model) { // before delete() method call this
            \Cache::forget('adminpanel_dashboard');
        });
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getRememberToken(){
        return $this->remember_token;
    }

    public function setRememberToken($value){
        $this->remember_token = $value;
    }

    public function getRememberTokenName(){
        return 'remember_token';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

}
