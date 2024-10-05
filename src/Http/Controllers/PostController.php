<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\PostService;

use Digitlimit\Adminpanel\Http\Requests\Post\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Post\UpdateRequest;

class PostController extends Controller{

	public function __construct(Auth $auth, PostService $postService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->postService = $postService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.post.index',[
			 'page_title' => 'Posts',
			 'sub_title' => 'All Posts',
			 'posts' => $this->postService->paginate()
		 ]);
	}

	public function getCreate()
	{
		return view('adminpanel::pages.post.create',[
			'page_title' => 'Posts - Add new',
			'sub_title' => 'Add a Post',
			'options'=> [
				'published' => [
					1=>'Published',
					0=>'Draft'
				],
				'privacy' => [
					'public' => 'Public - Anyone can view this Post',
					'members' => 'Members - Only registered members'
				],
				'category' => [],
				'selected' => [
					'published' => 0,
					'privacy' => 'public',
					'category'=>''
				]
			],
		]);
	}

	public function postStore(StoreRequest $request)
	{
		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
//		$fields['featured_image'] = $request->file('featured_image');

		if($this->postService->store($fields)){
			return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
				'icon' => 'fa fa-check-circle',
				'status' => 'success',
				'message' => 'Post created successfully'
			]);
		}

		return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Post could not be created'
		]);
	}

	public function getUpdate($id)
	{
		if(!$post = $this->postService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.post.update',[
			'page_title' => 'Posts - Add an Post',
			'sub_title' => 'Add an Post',
			'post' => $post,
			'options'=> [
				'published' => [
					1=>'Published',
					0=>'Draft'
				],
				'privacy' => [
					'public' => 'Public - Anyone can view this Post',
					'members' => 'Members - Only registered members'
				],
				'category' => [],
				'selected' => [
					'published' => $post->published,
					'privacy' => $post->privacy,
					'category'=>''
				]
			]
		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$post = $this->postService->find($id)){
			abort(404);
		}

		$fields = $request->only(['title', 'content', 'privacy','published','summary', 'tags', 'category']);
//		$fields['main_image'] = $request->file('main_image');

		if($this->postService->update($fields, $post)){
			return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
				'icon' => 'fa  fa-check-circle',
				'status' => 'success',
				'message' => 'Post was successfully updated'
			]);
		}

		return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Post could not be updated'
		]);
	}


	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

	public function getDeleteConfirm($id)
	{
		if(!$post = $this->postService->find($id)){
			abort(404);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Post',
			'message' => "Are you sure you want to delete post with title '$post->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.post.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$post = $this->postService->find($id)){
			abort(404);
		}

		if($this->postService->delete($post)){
			return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Post was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.post.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Post was could not be deleted'
			]);
		}
	}
}
