<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Plugins\Video\Models\AdminpanelPluginVideo;
use Illuminate\Filesystem\Filesystem as File;

class VideoService extends BaseService
{
    protected $videos_path;

    public function __construct(AdminpanelPluginVideo $video, File $file){
        $this->video = $video;
        $this->file = $file;

        $this->videos_path =  storage_path('videos');
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->video->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function find($id)
    {
        return $this->video->find($id)->first();
    }

    public function store($video)
    {
        $filename = '';
        if(is_object($video['video']))
        {
            if(!is_dir($this->videos_path)){
                $this->file->makeDirectory($this->videos_path);
            }

            $filename=str_random(16) . "." .$video['video']->extension();

            $video['video']->move($this->videos_path, $filename);
        }

        $video['name'] = $filename;

        return $this->video->create($video);
    }

    public function update($request, $video)
    {
        if(is_object($video['video'])){

            //move file to videos directory
            $filename=str_random(16) . "." .$video['video']->extension();

            $video['video']->move(storage_path('videos'), $filename);

            //remove old video
            if($this->file->exists($old_video = "$this->videos_path/$video->name")){
                $this->file->delete($old_video);
            }

            $video['name'] = $filename;
        }else{
            unset($video['name']);
        }



        return $video ? $video->update($request) : false;
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