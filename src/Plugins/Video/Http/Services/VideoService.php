<?php namespace Digitlimit\Adminpanel\Plugins\Video\Http\Services;

use Digitlimit\Adminpanel\Plugins\Video\Models\AdminpanelPluginVideo;

class VideoService{

    public function __construct(AdminpanelPluginVideo $video){
        $this->video = $video;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->video->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->video->find($id);
    }

    public function store($video)
    {
        $video['slug'] = str_slug($video['title']);
        return $this->video->create($video);
    }

    public function update($data, $video)
    {
        $data['slug'] = str_slug($data['title']);
        return $video ? $video->update($data) : false;
    }

    public function delete($video)
    {
        if($video){
            $video->delete();
            return true;
        }
        return true;
    }
}