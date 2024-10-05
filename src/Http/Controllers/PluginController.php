<?php namespace Digitlimit\Adminpanel\Http\Controllers;

use Illuminate\Contracts\Auth\Guard as Auth;
use Digitlimit\Adminpanel\Http\Services\PluginService;

use Digitlimit\Adminpanel\Http\Requests\Plugin\StoreRequest;
use Digitlimit\Adminpanel\Http\Requests\Plugin\UpdateRequest;

class PluginController extends Controller{

	public function __construct(Auth $auth, PluginService $pluginService)
	{
		$this->middleware('adminpanel.admin');

		$this->auth = $auth;
		$this->pluginService = $pluginService;
		$this->user = $auth->user();
	}

	public function getIndex()
	{
		 return view('adminpanel::pages.plugin.index',[
			 'page_title' => 'Plugins',
			 'sub_title' => 'All Plugins',
			 'plugins' => $this->pluginService->paginate(),
			 'other_plugins' => $this->pluginService->discover()
		 ]);
	}


	public function getOther()
	{
		return view('adminpanel::pages.plugin.other',[
			'page_title' => 'Plugins',
			'sub_title' => 'Other Plugins',
			'plugins' => $this->pluginService->discover()
		]);
	}

	public function getOtherDeleteConfirm($name){

		if(!is_dir(adminpanel_plugin_path($name))) abort(404);

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete Plugin',
			'message' => "Sure you want to delete '$name' plugin",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.plugin.getOtherDelete', ['name'=>$name])
			]
		]);
	}

	public function getOtherDelete($name){

		if(!is_dir(adminpanel_plugin_path($name))) abort(404);

		if($this->pluginService->deleteOther($name)){
			return redirect()->route('adminpanel.plugin.getOther')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.plugin.getOther')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Plugin was could not be deleted'
			]);
		}
	}

	public function getOtherInstall($plugin){

		if(!is_dir(adminpanel_plugin_path($plugin))) abort(404);

		$result = $this->pluginService->store($plugin);

		if($result === TRUE){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin successfully installed'
			]);
		}

		return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => $result
		]);
	}





	public function getCreate()
	{
		return view('adminpanel::pages.plugin.create',[
			'page_title' => 'Plugins - Add new',
			'sub_title' => 'Add a Plugin'
		]);
	}

	public function postStore(StoreRequest $request)
	{
		$plugin = $request->file('plugin');

		if(!$plugin->isValid()){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'error',
				'message' => 'Invalid Zip file.'
			]);
		}

		$result = $this->pluginService->store($plugin);

		if($result === TRUE){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin successfully installed'
			]);
		}

		return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
			'status' => 'warning',
			'message' => $result
		]);
	}


	public function getUpdate($id)
	{

	}

	public function postUpdate(UpdateRequest $request, $id)
	{

	}

	public function getShow($id){

	}

	public function getDeleteConfirm($id)
	{
		if(!$plugin = $this->pluginService->find($id)){
			abort(404);
		}

		return redirect()->back()->with('adminpanel_modal',[
			'title' => 'Delete Plugin',
			'message' => "Sure you want to delete '$plugin->name' plugin",
			'action' => [
				'label' => 'Yes',
				'url' => route('adminpanel.plugin.getDelete', ['id'=>$id])
			]
		]);
	}

	public function getDelete($id)
	{
		if(!$plugin = $this->pluginService->find($id)){
			abort(404);
		}

		if($this->pluginService->delete($plugin)){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin was successfully deleted'
			]);
		}else{
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Plugin was could not be deleted'
			]);
		}
	}


	public function getActivate($id){

		if(!$plugin = $this->pluginService->find($id)){
			abort(404);
		}

		if($this->pluginService->activate($plugin)){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin was successfully activated'
			]);
		}else{
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Plugin was could not be activated'
			]);
		}
	}

	public function getDeactivate($id){

		if(!$plugin = $this->pluginService->find($id)){
			abort(404);
		}

		if($this->pluginService->deactivate($plugin)){
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'success',
				'message' => 'Plugin was successfully deactivated'
			]);
		}else{
			return redirect()->route('adminpanel.plugin.getIndex')->with('adminpanel_form',[
				'status' => 'warning',
				'message' => 'Plugin was could not be deactivated'
			]);
		}
	}
}
