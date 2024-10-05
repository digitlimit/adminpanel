<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\PageService;

use Digitlimit\Adminpanel\Http\Requests\Page\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Page\UpdateRequest;

class PageController extends Controller{

	public function __construct(Auth $auth, PageService $pageService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->pageService = $pageService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.page.index',[
			 'page_title' => 'Pages',
			 'sub_title' => 'All Pages',
			 'pages' => $this->pageService->paginate()
		 ]);
	}

	public function getCreate()
	{
		return view('adminpanel::pages.page.create',[
			'page_title' => 'Pages - Add new',
			'sub_title' => 'Add a Page',
			'options'=> [
				'parent' => $this->pageService->lists(),
				'published' => [
					1=>'Published',
					0=>'Draft'
				],
				'privacy' => [
					'public' => 'Public - Anyone can view this Page',
					'members' => 'Members - Only registered members'
				],
				'template' => $this->pageService->pageTemplates(),
				'selected' => [
					'parent' => 'public',
					'published' => 0,
					'privacy' => 'public'
				]
			],
		]);
	}

	public function postStore(StoreRequest $request)
	{
		$fields = $request->only([
			'title', 'content', 'privacy','published','summary',
			'template','meta_keywords','published_date', 'icon',
			'parent'
		]);

		$fields['main_image'] = $request->file('main_image');

		if($this->pageService->store($fields)){
			return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Page created successfully'
			]);
		}

		return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Page could not be created'
		]);
	}


	public function getUpdate($id)
	{
		if(!$page = $this->pageService->find($id)){
			abort(404);
		}

		return view('adminpanel::pages.page.update',[
			'page_title' => 'Pages - Add an Page',
			'sub_title' => 'Add an Page',
			'page' => $page,
			'page_templates' => $this->pageService->pageTemplates(),
			'options'=> [
				'parent' => $this->pageService->lists(),
				'published' => [
					1=>'Published',
					0=>'Draft'
				],
				'privacy' => [
					'public' => 'Public - Anyone can view this Page',
					'members' => 'Members - Only registered members'
				],
				'template' => $this->pageService->pageTemplates(),
				'selected' => [
					'parent' => $page->parent,
					'published' => $page->published,
					'privacy' => $page->privacy,
					'template' => $page->template
				]
			]
		]);
	}

	public function postUpdate(UpdateRequest $request, $id)
	{
		if(!$page = $this->pageService->find($id)){
			abort(404);
		}

		$fields = $request->only([
			'title', 'content', 'privacy','published','summary',
			'template','meta_keywords','published_date', 'icon',
			'parent'
		]);

		$fields['main_image'] = $request->file('main_image');

		if($this->pageService->update($fields, $page)){
			return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Page was successfully updated'
			]);
		}

		return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => 'Page could not be updated'
		]);
	}


	public function getShow($id){

	}

	public function actions(){

		//$user_ids = implode(',', $this->request->get('users'))
	}

	public function getDeleteConfirm($id)
	{
		if(!$page = $this->pageService->find($id)){
			abort(404);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete a Page',
			'message' => "Are you sure you want to delete page with title '$page->title'",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.page.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$page = $this->pageService->find($id)){
			abort(404);
		}

		if($this->pageService->delete($page)){
			return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Page was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.page.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Page was could not be deleted'
			]);
		}
	}
}
