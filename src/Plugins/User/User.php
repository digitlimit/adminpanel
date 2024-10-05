<?php namespace Digitlimit\Adminpanel\Plugins\User;


class User
{

    /**
     * Registers dashboards
     */
    public function registerDashboard()
    {
        if(!adminpanel_routeIs('adminpanel.dashboard.index')) return;
        return [
            'count' => 3,
            'title' => 'Users',
            'icon' => 'fa fa-users',
            'bg_class' => 'bg-aqua',
            'url' => route('adminpanel.user.getIndex')
        ];
    }

    /**
     * Registers all sidebars
     */
    public function registerSidebar()
    {
        return [
            'active' => adminpanel_routeIs('adminpanel.user.getIndex'),
            'title' => 'Users',
            'icon' => 'fa fa-users',
            'url' => route('adminpanel.user.getIndex')
        ];
    }
}