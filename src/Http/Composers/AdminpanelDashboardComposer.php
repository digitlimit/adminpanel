<?php namespace Digitlimit\Adminpanel\Http\Composers;

use Illuminate\View\View;
use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\DashboardService;

class AdminpanelDashboardComposer{

    protected $auth;
    protected $dashboardService;
    protected $user;

    public function __construct(Auth $auth, DashboardService $dashboardService)
    {
        $this->auth = $auth;
        $this->dashboardService = $dashboardService;
        $this->user = $auth->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if($this->auth->check()){
            $view->with('auth', $this->user);
            $view->with('dashboard', $this->dashboardService->dashboard());
        }
    }
}