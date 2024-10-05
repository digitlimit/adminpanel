<?php namespace Digitlimit\Adminpanel\Plugins\Calibration;

use App\Models\User;

class Calibration
{
    public function __construct(){
//        $this->user = $user;
    }

    /**
     * Registers dashboards
     */
    public function registerDashboard()
    {
        return [
            'count' => 12,
            'title' => 'Calibrations',
            'icon' => 'fa fa-certificate',
            'bg_class' => 'bg-yellow',
            'url' => route('adminpanel.calibration.getIndex')
        ];
    }

    /**
     * Registers all sidebars
     */
    public function registerSidebar()
    {
        return [
            'active' => adminpanel_routeIs('adminpanel.calibration.getIndex')
                || adminpanel_routeIs('adminpanel.calibration.transporter.getIndex')
                || adminpanel_routeIs('adminpanel.calibration.truck.getIndex')
                || adminpanel_routeIs('adminpanel.calibration.client.getIndex'),

            'title' => 'Calibrations',
            'icon' => 'fa fa-certificate',
            'url' => route('adminpanel.calibration.getIndex'),

            'sub_menu' =>[
                [
                    'active' => adminpanel_routeIs('adminpanel.calibration.transporter.getIndex'),
                    'title' => 'Transporters',
                    'icon' => 'fa fa-tags',
                    'url' => route('adminpanel.calibration.transporter.getIndex'),
                ],

                [
                    'active' => adminpanel_routeIs('adminpanel.calibration.truck.getIndex'),
                    'title' => 'Trucks',
                    'icon' => 'fa fa-truck',
                    'url' => route('adminpanel.calibration.truck.getIndex'),
                ],

                [
                    'active' => adminpanel_routeIs('adminpanel.calibration.client.getIndex'),
                    'title' => 'Clients',
                    'icon' => 'fa fa-user',
                    'url' => route('adminpanel.calibration.client.getIndex'),
                ]
            ]
        ];
    }
}