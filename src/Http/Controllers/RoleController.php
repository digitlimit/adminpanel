<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\RoleService;
use Digitlimit\Adminpanel\Http\Services\PermissionService;
use Illuminate\Http\Request;

use Digitlimit\Adminpanel\Http\Requests\Role\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Role\UpdateRequest;

class RoleController extends Controller{

	public function __construct(Auth $auth, RoleService $roleService,
		PermissionService $permissionService, Request $request)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->roleService = $roleService;
		$this->permissionService = $permissionService;
		$this->user = $auth->user();
		$this->request = $request;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.role.index',[
			 'page_title' => 'Roles',
			 'sub_title' => 'All Roles',
			 'roles' => $this->roleService->paginate()
		 ]);
	}

	public function getPermissions($name){

		if(!$name) abort(404);
		$role = $this->roleService->roleByName($name);
		if(!$role) abort(404);

		//lets fetch all the saved permissions for this role so we can thick their respective checkboxes in the view
		if($role_permissions = $this->roleService->permissionRole($role->id)->get()){
			$role_permissions = array_column($role_permissions->toArray(), 'permission_id');
		}else{
			$role_permissions = [];
		}


		return view('adminpanel::pages.role.permission',[
			'page_title' => "$role->display_name Role Permissions",
			'sub_title' => "$role->display_name permissions",
			'role' => $role,
			'role_permissions' => $role_permissions,
			'permissions' => $this->permissionService->all()
		]);
	}

	public function postPermissions($name){
		if(!$name) abort(404);
		$role = $this->roleService->roleByName($name);
		if(!$role) abort(404);

		$permissions = $this->request->only('permissions');

		if($this->roleService->attachPermission($permissions, $role)){
			return redirect()->route('adminpanel.role.getPermissions', ['name'=>$name])
				->with('form_success', 'Permission was successfully saved');
		}else{
			return redirect()->route('adminpanel.role.getPermissions', ['name'=>$name])
				->with('form_error', 'Permission cannot be saved');
		}
	}

	public function getCreate()
	{
		return view('adminpanel::pages.role.create',[
			'page_title' => 'Roles - Add new',
			'sub_title' => 'Add a role'
		]);
	}

	public function postStore(StoreRequest $request)
	{
		dd($request->all());
//		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
////		$fields['featured_image'] = $request->file('featured_image');
//
//		if($this->roleService->store($fields)){
//			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
//				'icon' => 'fa fa-check-circle',
//				'status' => 'success',
//				'message' => 'role created successfully'
//			]);
//		}
//
//		return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
//			'status' => 'warning',
//			'message' => 'role could not be created'
//		]);
	}

	public function getUpdate($id)
	{
		if(!$role = $this->roleService->find($id)){
			abort(404);
		}

//		return view('adminpanel::pages.role.update',[
//			'page_title' => 'roles - Add an role',
//			'sub_title' => 'Add an role',
//			'role' => $role,
//			'auth' => $this->role,
//			'dashboard' => $this->dashboardService->dashboard(),
//			'options'=> [
//				'published' => [
//					1=>'Published',
//					0=>'Draft'
//				],
//				'privacy' => [
//					'public' => 'Public - Anyone can view this role',
//					'members' => 'Members - Only registered members'
//				],
//				'category' => [],
//				'selected' => [
//					'published' => $role->published,
//					'privacy' => $role->privacy,
//					'category'=>''
//				]
//			]
//		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
//		if(!$role = $this->roleService->find($id)){
//			abort(404);
//		}
//
//		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
////		$fields['main_image'] = $request->file('main_image');
//
//		if($this->roleService->update($fields, $role)){
//			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
//				'icon' => 'fa  fa-check-circle',
//				'status' => 'success',
//				'message' => 'role was successfully updated'
//			]);
//		}
//
//		return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
//			'status' => 'warning',
//			'message' => 'role could not be updated'
//		]);
	}

	public function getDeleteConfirm($id)
	{
		if(!$role = $this->roleService->find($id)){
			abort(404);
		}

		if($role->id == $this->role->id){
			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot delete own account'
			]);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Role',
			'message' => "Are you sure you want to delete role with title '$role->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.role.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$role = $this->roleService->find($id)){
			abort(404);
		}

		if($role->id == $this->role->id){
			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot delete own account'
			]);
		}

		if($this->roleService->delete($role)){
			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Role was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.role.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Role was could not be deleted'
			]);
		}
	}

}
