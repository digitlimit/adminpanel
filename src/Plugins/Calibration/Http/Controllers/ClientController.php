<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Client\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Client\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\ClientService;

class ClientController extends Controller{

	public function __construct(Auth $auth, Request $request, ClientService $clientService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->clientService =  $clientService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.client.index',[
			 'page_title' => 'Calibration - Clients',
			 'sub_title' => 'All Clients',
			 'clients' => $this->clientService->paginate()
		 ]);
	}

	/**
	 * Returns a new client creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.client.create',[
			'page_title' => 'Clients - Add new',
			'sub_title' => 'Add a client'
		]);
	}

	/**
	 * Creates new client
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$client = $request->only(['name', 'detail']);

		if($this->clientService->store($client)){
			return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Client was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Client could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$client = $this->clientService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.client.update',[
			'page_title' => 'Update Client',
			'sub_title' => 'Update a client',
			'client' => $client
		]);
	}

	/**
	 * Updates a client
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$client = $this->clientService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['name', 'detail']);

		if($this->clientService->update($client, $data)){
			return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Client was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Client could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$client = $this->clientService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Client',
			'message' => "Are you sure you want to delete '$client->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.client.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a client
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$client = $this->clientService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->clientService->delete($client)){
			return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Client was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.client.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Client was could not be deleted'
			]);
		}
	}

}
