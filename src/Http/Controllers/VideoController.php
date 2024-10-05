<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\VideoService;

use Digitlimit\Adminpanel\Http\Requests\Video\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Video\UpdateRequest;

class VideoController extends Controller{

	public function __construct(Auth $auth, VideoService $videoService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->videoService = $videoService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.video.index',[
			 'page_title' => 'Videos',
			 'sub_title' => 'All Videos',
			 'videos' => $this->videoService->paginate()
		 ]);
	}

	public function getCreate()
	{
		return view('adminpanel::pages.video.create',[
			'page_title' => 'Videos - Add new',
			'sub_title' => 'Add a Video'
		]);
	}

	public function postStore(StoreRequest $request)
	{
		$video = $request->only(['title', 'detail', 'youtube', 'privacy']);

		if($this->videoService->store($video)){
			return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Video created successfully'
			]);
		}

		return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Video could not be created'
		]);
	}


	public function getUpdate($id)
	{
		if(!$video = $this->videoService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.video.update',[
			'page_title' => 'Videos - Add an Video',
			'sub_title' => 'Add an Video',
			'video' => $video
		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$video = $this->videoService->find($id)){
			abort(404);
		}

		$fields = $request->only(['title', 'detail', 'youtube', 'privacy']);

		if($this->videoService->update($fields, $video)){
			return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Video was successfully updated'
			]);
		}

		return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Video could not be updated'
		]);
	}


	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

	public function getDeleteConfirm($id)
	{
		if(!$video = $this->videoService->find($id)){
			abort(404);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Video',
			'message' => "Are you sure you want to delete video with title '$video->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.video.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$video = $this->videoService->find($id)){
			abort(404);
		}

		if($this->videoService->delete($video)){
			return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Video was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.video.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Video was could not be deleted'
			]);
		}
	}

}
