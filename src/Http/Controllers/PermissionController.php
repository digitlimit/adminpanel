<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\PermissionService;

class PermissionController extends Controller{

	public function __construct(Auth $auth, PermissionService $permissionService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->permissionService = $permissionService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.permission.index',[
			 'page_title' => 'Permissions',
			 'sub_title' => 'All Permissions',
			 'permissions' => $this->permissionService->paginate()
		 ]);
	}

	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

}
