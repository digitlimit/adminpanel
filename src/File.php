<?php namespace Digitlimit\Adminpanel;

use Illuminate\Session\Store;
use Illuminate\Filesystem\Filesystem;

class File{

    public function __construct(Filesystem $file){
        $this->file = $file;
    }

}