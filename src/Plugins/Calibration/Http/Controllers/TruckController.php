<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Truck\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Truck\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\TruckService;

class TruckController extends Controller{

	public function __construct(Auth $auth, Request $request, TruckService $truckService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->truckService =  $truckService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.truck.index',[
			 'page_title' => 'Calibration - Trucks',
			 'sub_title' => 'All Trucks',
			 'trucks' => $this->truckService->paginate()
		 ]);
	}

	/**
	 * Returns a new truck creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.truck.create',[
			'page_title' => 'Trucks - Add new',
			'sub_title' => 'Add a truck'
		]);
	}

	/**
	 * Creates new truck
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$truck = $request->only(['model', 'reg_number', 'chassis_number', 'volume']);

		if($this->truckService->store($truck)){
			return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Truck was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Truck could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{

		if(!$truck = $this->truckService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.truck.update',[
			'page_title' => 'Update Truck',
			'sub_title' => 'Update a truck',
			'truck' => $truck
		]);
	}

	/**
	 * Updates a truck
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$truck = $this->truckService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['model', 'reg_number', 'chassis_number', 'volume']);

		if($this->truckService->update($truck, $data)){
			return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Truck was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Truck could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$truck = $this->truckService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Truck',
			'message' => "Are you sure you want to delete '$truck->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.truck.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a truck
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$truck = $this->truckService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->truckService->delete($truck)){
			return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Truck was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.truck.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Truck was could not be deleted'
			]);
		}
	}

}
