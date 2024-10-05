<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\EventService;

use Digitlimit\Adminpanel\Http\Requests\Event\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Event\UpdateRequest;
use Alert;

class EventController extends Controller{

	public function __construct(Auth $auth, EventService $eventService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->eventService = $eventService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.event.index',[
			 'page_title' => 'Events',
			 'sub_title' => 'All Events',
			 'events' => $this->eventService->paginate()
		 ]);
	}


	public function getCreate()
	{
		return view('adminpanel::pages.event.create',[
			'page_title' => 'Events - Add an Event',
			'sub_title' => 'Add an Event'
		]);
	}

	public function postStore(StoreRequest $request)
	{
		$event = $request->only(['title', 'venue', 'start_date', 'start_time', 'end_date', 'end_time', 'detail']);

		if($this->eventService->store($event)){
			return redirect()->route('adminpanel.event.getIndex')
			->with('alert_success', 'Event created successfully');
		}

		return redirect()->route('adminpanel.event.getIndex')
			->with('alert_error', 'Event could not be created');
	}


	public function getUpdate($id)
	{
		if(!$event = $this->eventService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.event.update',[
			'page_title' => 'Events - Add an Event',
			'sub_title' => 'Add an Event',
			'event' => $event
		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$event = $this->eventService->find($id)){
			abort(404);
		}

		$fields = $request->only(['title', 'venue', 'start_date', 'start_time', 'end_date', 'end_time', 'detail']);

		if($this->eventService->update($fields, $event)){
			return redirect()->route('adminpanel.event.getIndex')
				->with('alert_success', 'Event updated successfully');
		}

		return redirect()->route('adminpanel.event.getIndex')
			->with('alert_error', 'Event could not be updated');
	}


	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

	public function getDeleteConfirm($id)
	{
		if(!$event = $this->eventService->find($id)){
			abort(404);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Page',
			'message' => "Are you sure you want to delete event with title '$event->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.event.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$event = $this->eventService->find($id)){
			abort(404);
		}

		if($this->eventService->delete($event)){
			return redirect()->route('adminpanel.event.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Event was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.event.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Event was could not be deleted'
			]);
		}
	}

}
