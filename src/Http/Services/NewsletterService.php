<?php namespace Digitlimit\Adminpanel\Http\Services;

use Digitlimit\Adminpanel\Models\AdminpanelNewsletter;

class NewsletterService extends BaseService
{

    public function __construct(AdminpanelNewsletter $adminpanelNewsletter){
        $this->adminpanelNewsletter = $adminpanelNewsletter;
    }

    public function paginate($per_page=15, $columns=null, $orderBy='DESC')
    {
        return $this->adminpanelNewsletter->orderBy('id', $orderBy)->paginate($per_page, $columns);
    }
}