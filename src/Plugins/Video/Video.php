<?php namespace Digitlimit\Adminpanel\Plugins\Video;


class Video
{

    /**
     * Registers dashboards
     */
    public function registerDashboard()
    {
        if(!adminpanel_routeIs('adminpanel.dashboard.index')) return;
        return [
            'count' => 3,
            'title' => 'Videos',
            'icon' => 'fa fa-video-camera',
            'bg_class' => 'bg-green',
            'url' => route('adminpanel.video.getIndex')
        ];
    }

    /**
     * Registers all sidebars
     */
    public function registerSidebar()
    {
        return [
            'active' => adminpanel_routeIs('adminpanel.video.getIndex'),
            'title' => 'Videos',
            'icon' => 'fa fa-video-camera',
            'url' => route('adminpanel.video.getIndex')
        ];
    }
}