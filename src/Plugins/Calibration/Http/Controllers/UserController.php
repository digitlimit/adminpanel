<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\User\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\User\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\UserService;

class UserController extends Controller{

	public function __construct(Auth $auth, Request $request, UserService $userService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->userService =  $userService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.user.index',[
			 'page_title' => 'Calibration - Users',
			 'sub_title' => 'All Users',
			 'users' => $this->userService->paginate()
		 ]);
	}

	/**
	 * Returns a new user creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.user.create',[
			'page_title' => 'Users - Add new',
			'sub_title' => 'Add a user'
		]);
	}

	/**
	 * Creates new user
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$user = $request->only(['name', 'detail']);

		if($this->userService->store($user)){
			return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'User was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'User could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.user.update',[
			'page_title' => 'Update User',
			'sub_title' => 'Update a user',
			'user' => $user
		]);
	}

	/**
	 * Updates a user
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['name', 'detail']);

		if($this->userService->update($user, $data)){
			return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'User was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'User could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a User',
			'message' => "Are you sure you want to delete '$user->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.user.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a user
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$user = $this->userService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->userService->delete($user)){
			return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'User was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.user.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'User was could not be deleted'
			]);
		}
	}

}
