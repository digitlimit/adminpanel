<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\User;
use Cache;

class DashboardService extends BaseService
{

    public function __construct(User $user){
        $this->user = $user;
    }

    public function dashboard()
    {
//        return Cache::rememberForever('adminpanel_dashboard', function(){
//
//        });
    }

}