<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Transporter\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Transporter\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\TransporterService;

class TransporterController extends Controller{

	public function __construct(Auth $auth, Request $request, TransporterService $transporterService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->transporterService =  $transporterService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.transporter.index',[
			 'page_title' => 'Calibration - Transporters',
			 'sub_title' => 'All Transporters',
			 'transporters' => $this->transporterService->paginate()
		 ]);
	}

	/**
	 * Returns a new transporter creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.transporter.create',[
			'page_title' => 'Transporters - Add new',
			'sub_title' => 'Add a transporter'
		]);
	}

	/**
	 * Creates new transporter
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$transporter = $request->only(['name', 'detail']);

		if($this->transporterService->store($transporter)){
			return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Transporter was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Transporter could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$transporter = $this->transporterService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.transporter.update',[
			'page_title' => 'Update Transporter',
			'sub_title' => 'Update a transporter',
			'transporter' => $transporter
		]);
	}

	/**
	 * Updates a transporter
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$transporter = $this->transporterService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['name', 'detail']);

		if($this->transporterService->update($transporter, $data)){
			return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Transporter was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Transporter could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$transporter = $this->transporterService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Transporter',
			'message' => "Are you sure you want to delete '$transporter->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.transporter.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a transporter
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$transporter = $this->transporterService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->transporterService->delete($transporter)){
			return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Transporter was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.transporter.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Transporter was could not be deleted'
			]);
		}
	}

}
