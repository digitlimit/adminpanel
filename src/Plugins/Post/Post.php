<?php namespace Digitlimit\Adminpanel\Plugins\Post;


class Post
{

    /**
     * Registers dashboards
     */
    public function registerDashboard()
    {
        if(!adminpanel_routeIs('adminpanel.dashboard.index')) return;
        return [
            'count' => 3,
            'title' => 'Posts',
            'icon' => 'fa fa-users',
            'bg_class' => 'bg-green',
            'url' => route('adminpanel.post.getIndex')
        ];
    }

    /**
     * Registers all sidebars
     */
    public function registerSidebar()
    {
        return [
            'active' => adminpanel_routeIs('adminpanel.post.getIndex'),
            'title' => 'Posts',
            'icon' => 'fa fa-thumb-tack',
            'url' => route('adminpanel.post.getIndex')
        ];
    }
}