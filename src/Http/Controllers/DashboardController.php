<?php namespace Digitlimit\Adminpanel\Http\Controllers;

class DashboardController extends Controller{

	public function __construct()
	{
		$this->middleware('adminpanel.admin');
	}

	public function index()
	{
		 //check Digitlimit\Adminpanel\Http\Composers\AdminpanelDashboardComposer
		 return view('adminpanel::pages.dashboard.index');
	}

}
