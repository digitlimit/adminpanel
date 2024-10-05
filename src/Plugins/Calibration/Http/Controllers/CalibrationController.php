<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Calibration\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Calibration\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\CalibrationService;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\ClientService;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\TruckService;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\TransporterService;

class CalibrationController extends Controller{

	public function __construct(Auth $auth, Request $request, CalibrationService $calibrationService,
		ClientService $clientService, TruckService $truckService, TransporterService $transporterService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;

		$this->calibrationService = $calibrationService;
		$this->clientService = $clientService;
		$this->truckService = $truckService;
		$this->transporterService = $transporterService;
	}

	public function getIndex()
	{
		return view('adminpanel::pages.calibration.index',[
			'page_title' => 'Calibration',
			'sub_title' => 'All Calibrations',
			'calibrations' => $this->calibrationService->paginate()
		]);
	}

	/**
	 * Returns a new calibration creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.create',[
			'page_title' => 'Calibrations - Add new',
			'sub_title' => 'Add a calibration',
			'clients' => $this->clientService->lists(),
			'trucks' => $this->truckService->lists(),
			'transporters' => $this->transporterService->lists()
		]);
	}

	/**
	 * Creates new calibration
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$calibration = $request->only(["title", "truck", "transporter", "issued_date", "client", "chart_no", "expiry_date", "chart"]);

		if($this->calibrationService->store($calibration)){
			return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Calibration was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Calibration could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$calibration = $this->calibrationService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.update',[
			'page_title' => 'Update Calibration',
			'sub_title' => 'Update a calibration',
			'calibration' => $calibration
		]);
	}

	/**
	 * Updates a calibration
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$calibration = $this->calibrationService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(["title", "truck", "transporter", "issued_date", "client", "chart_no", "expiry_date", "chart"]);

		if($this->calibrationService->update($calibration, $data)){
			return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Calibration was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Calibration could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$calibration = $this->calibrationService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Calibration',
			'message' => "Are you sure you want to delete '$calibration->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a calibration
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$calibration = $this->calibrationService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->calibrationService->delete($calibration)){
			return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Calibration was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Calibration was could not be deleted'
			]);
		}
	}
}