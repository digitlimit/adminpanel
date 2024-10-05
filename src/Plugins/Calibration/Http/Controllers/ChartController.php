<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Chart\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Chart\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\ChartService;

class ChartController extends Controller{

	public function __construct(Auth $auth, Request $request, ChartService $chartService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->chartService =  $chartService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.chart.index',[
			 'page_title' => 'Calibration - Charts',
			 'sub_title' => 'All Charts',
			 'charts' => $this->chartService->paginate()
		 ]);
	}

	/**
	 * Returns a new chart creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.chart.create',[
			'page_title' => 'Charts - Add new',
			'sub_title' => 'Add a chart'
		]);
	}

	/**
	 * Creates new chart
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$chart = $request->only(['name', 'detail']);

		if($this->chartService->store($chart)){
			return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Chart was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Chart could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$chart = $this->chartService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.chart.update',[
			'page_title' => 'Update Chart',
			'sub_title' => 'Update a chart',
			'chart' => $chart
		]);
	}

	/**
	 * Updates a chart
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$chart = $this->chartService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['name', 'detail']);

		if($this->chartService->update($chart, $data)){
			return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Chart was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Chart could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$chart = $this->chartService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Chart',
			'message' => "Are you sure you want to delete '$chart->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.chart.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a chart
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$chart = $this->chartService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->chartService->delete($chart)){
			return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Chart was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.chart.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Chart was could not be deleted'
			]);
		}
	}

}
