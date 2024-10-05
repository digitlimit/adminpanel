<?php namespace Digitlimit\Adminpanel\Plugins\Calibration\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;

use Illuminate\Http\Request;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Document\StoreRequest;
use Digitlimit\Adminpanel\Plugins\Calibration\Http\Requests\Document\UpdateRequest;

use Digitlimit\Adminpanel\Plugins\Calibration\Http\Services\DocumentService;

class DocumentController extends Controller{

	public function __construct(Auth $auth, Request $request, DocumentService $documentService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->user = $auth->user();
		$this->request = $request;
		$this->documentService =  $documentService;
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.calibration.document.index',[
			 'page_title' => 'Calibration - Documents',
			 'sub_title' => 'All Documents',
			 'documents' => $this->documentService->paginate()
		 ]);
	}

	/**
	 * Returns a new document creation form
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('adminpanel::pages.calibration.document.create',[
			'page_title' => 'Documents - Add new',
			'sub_title' => 'Add a document'
		]);
	}

	/**
	 * Creates new document
	 * @param StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postStore(StoreRequest $request)
	{
		$document = $request->only(['name', 'detail']);

		if($this->documentService->store($document)){
			return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Document was created successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
//			'icon' => 'fa fa-check-circle',
			'status' => 'warning',
			'message' => 'Document could not be created'
		]);
	}

	/**
	 * Returns an update form
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getUpdate($id)
	{
		if(!$document = $this->documentService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.calibration.document.update',[
			'page_title' => 'Update Document',
			'sub_title' => 'Update a document',
			'document' => $document
		]);
	}

	/**
	 * Updates a document
	 *
	 * @param UpdateRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$document = $this->documentService->find($id)){
			abort(404);
		}

		//TODO - check permission

		$data = $request->only(['name', 'detail']);

		if($this->documentService->update($document, $data)){
			return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Document was updated successfully'
			]);
		}

		return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Document could not be updated'
		]);
	}

	/**
	 * Ask for delete confirmation
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDeleteConfirm($id)
	{
		if(!$document = $this->documentService->find($id)){
			abort(404);
		}

		//TODO - check permission

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Document',
			'message' => "Are you sure you want to delete '$document->name'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.calibration.document.getDelete', ['id'=>$id])
			]
		]);
	}

	/**
	 * Delete a document
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		if(!$document = $this->documentService->find($id)){
			abort(404);
		}

		//TODO - check permission

		if($this->documentService->delete($document)){
			return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Document was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.calibration.document.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Document was could not be deleted'
			]);
		}
	}

}
