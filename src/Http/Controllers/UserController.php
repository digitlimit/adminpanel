<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\UserService;

use Digitlimit\Adminpanel\Http\Requests\User\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\User\UpdateRequest;

class UserController extends Controller{

	public function __construct(Auth $auth, UserService $userService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->userService = $userService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.user.index',[
			 'page_title' => 'Users',
			 'sub_title' => 'All Users',
			 'users' => $this->userService->paginate()
		 ]);
	}

	public function getCreate()
	{
		return view('adminpanel::pages.user.create',[
			'page_title' => 'users - Add new',
			'sub_title' => 'Add a user'
		]);
	}

	public function postStore(StoreRequest $request)
	{
//		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
////		$fields['featured_image'] = $request->file('featured_image');
//
//		if($this->userService->store($fields)){
//			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
//				'icon' => 'fa fa-check-circle',
//				'status' => 'success',
//				'message' => 'user created successfully'
//			]);
//		}
//
//		return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
//			'status' => 'warning',
//			'message' => 'user could not be created'
//		]);
	}

	public function getUpdate($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

//		return view('adminpanel::pages.user.update',[
//			'page_title' => 'users - Add an user',
//			'sub_title' => 'Add an user',
//			'user' => $user,
//			'auth' => $this->user,
//			'dashboard' => $this->dashboardService->dashboard(),
//			'options'=> [
//				'published' => [
//					1=>'Published',
//					0=>'Draft'
//				],
//				'privacy' => [
//					'public' => 'Public - Anyone can view this user',
//					'members' => 'Members - Only registered members'
//				],
//				'category' => [],
//				'selected' => [
//					'published' => $user->published,
//					'privacy' => $user->privacy,
//					'category'=>''
//				]
//			]
//		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
//		if(!$user = $this->userService->find($id)){
//			abort(404);
//		}
//
//		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
////		$fields['main_image'] = $request->file('main_image');
//
//		if($this->userService->update($fields, $user)){
//			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
//				'icon' => 'fa  fa-check-circle',
//				'status' => 'success',
//				'message' => 'user was successfully updated'
//			]);
//		}
//
//		return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
//			'status' => 'warning',
//			'message' => 'user could not be updated'
//		]);
	}

	public function getDeleteConfirm($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		if($user->id == $this->user->id){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot delete own account'
			]);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a User',
			'message' => "Are you sure you want to delete user with title '$user->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.user.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		if($user->id == $this->user->id){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot delete own account'
			]);
		}

		if($this->userService->delete($user)){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'User was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'User was could not be deleted'
			]);
		}
	}

	public function getUnBan($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		if($user->id == $this->user->id){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot un-ban own account'
			]);
		}

		if($this->userService->unBan($user)){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'User was successfully unbanned'
			]);
		}else{
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'User could not be unbanned'
			]);
		}
	}

	public function getBan($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		if($user->id == $this->user->id){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'You cannot ban own account'
			]);
		}

		if($this->userService->ban($user)){
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'User was successfully banned'
			]);
		}else{
			return redirect()->route('adminpanel.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'User could not be banned'
			]);
		}
	}

	public function getShow($id){
		if(!$user = $this->userService->show($id)){
			abort(404);
		}


		return view('adminpanel::pages.user.show',[
			'user' => $user,
		]);
	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

}
