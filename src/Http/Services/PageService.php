<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\AdminpanelPage;

class PageService extends BaseService
{

    public function __construct(AdminpanelPage $adminpanelPage){
        $this->adminpanelPage = $adminpanelPage;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->adminpanelPage->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }

    public function lists()
    {
        return $this->adminpanelPage->lists('title', 'id')->toArray();
    }

    public function find($id)
    {
        return $this->adminpanelPage->find($id);
    }

    public function store($fields)
    {
        $fields['slug'] = str_slug($fields['title']);
        $fields['template'] = str_replace('.blade.php', '', $fields['template']);
        $fields['published_date'] = $fields['published_date'] ? $fields['published_date'] : date("d-m-Y");
        $fields['parent_id'] = $fields['parent'] ? $fields['parent'] : '';

        $main_image = $fields['main_image'];

        if($main_image && $filename = $this->upload($main_image)){
            $fields['main_image'] = $filename;
        }else{
            unset($fields['main_image']);
        }

        return $this->adminpanelPage->create($fields);
    }

    public function update($fields, $page)
    {
        $fields['slug'] = str_slug($fields['title']);
        $fields['template'] = str_replace('.blade.php', '', $fields['template']);
        $fields['published_date'] = $fields['published_date'] ? $fields['published_date'] : date("d-m-Y");
        $fields['parent_id'] = $fields['parent'] ? $fields['parent'] : '';

        $main_image = $fields['main_image'];

        if($main_image && $filename = $this->upload($main_image)){
            $fields['main_image'] = $filename;
        }else{
            unset($fields['main_image']);
        }

        return $page ? $page->update($fields) : false;
    }

    public function delete($page)
    {
        return $page ? $page->delete() : false;
    }





    protected function upload($main_image){
        if($main_image && $main_image->isValid()){
            $ext = $main_image->guessClientExtension();
            $filename = str_random(20) . ".{$ext}";

            if($main_image->move(config('adminpanel.uploads'), $filename)){
                return $filename;
            }

            return false;
        }
    }

    protected function templateName($line){
        $line = str_replace('{{--', '', $line);
        $line = str_replace('--}}', '', $line);

        $name = explode(':', trim($line));

        if(!is_array($name)) return false;

        return trim($name[1]);
    }

    public function pageTemplates(){
        $templates_dir = config('adminpanel.page_templates_dir');
        if(!is_dir($templates_dir)) return false;

        $templates = scandir($templates_dir);

        unset($templates[0]); //remove .
        unset($templates[1]); //remove ..

        if(empty($templates)) return false;

        $template_names = [];

        foreach($templates as $template){
            $file = "$templates_dir/$template";

            if(file_exists("$templates_dir/$template"))
            {
                $f = fopen($file, 'r');
                $line = fgets($f);

                if($template_name = $this->templateName($line)){
                    $template = str_replace('.blade.php','', $template);
                    $template_names[$template] =  $template_name;
                }

                fclose($f);
            }
        }

        return $template_names;
    }
}