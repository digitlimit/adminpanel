<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\AdminpanelPost;

class PostService extends BaseService
{

    public function __construct(Adminpanelpost $adminpanelPost){
        $this->adminpanelPost = $adminpanelPost;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->adminpanelPost->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->adminpanelPost->find($id);
    }

    public function store($fields)
    {
        $fields['slug'] = str_slug($fields['title']);
        return $this->adminpanelPost->create($fields);
    }

    public function update($fields, $post)
    {
        $fields['slug'] = str_slug($fields['title']);
        return $post ? $post->update($fields) : false;
    }

    public function delete($post)
    {
        if($post){
            $post->delete();
            return true;
        }
        return true;
    }
}