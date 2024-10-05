<?php namespace Digitlimit\Adminpanel\Plugins\Post\Http\Services;

use Digitlimit\Adminpanel\Plugins\Post\Models\AdminpanelPluginPost;

class PostService{

    public function __construct(AdminpanelPluginPost $post){
        $this->post = $post;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->post->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->post->find($id);
    }

    public function store($post)
    {
        $post['slug'] = str_slug($post['title']);
        return $this->post->create($post);
    }

    public function update($data, $post)
    {
        $data['slug'] = str_slug($data['title']);
        return $post ? $post->update($data) : false;
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