<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\DashboardService;
use Digitlimit\Adminpanel\Http\Services\NewsletterService;

class NewsletterController extends Controller{

	public function __construct(Auth $auth, NewsletterService $newsletterService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->newsletterService = $newsletterService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.newsletter.index',[
			 'page_title' => 'Newsletters',
			 'sub_title' => 'All Newsletters',
			 'newsletters' => $this->newsletterService->paginate()
		 ]);
	}

	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

}
