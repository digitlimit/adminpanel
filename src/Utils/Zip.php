<?php namespace Digitlimit\Adminpanel\Utils;

use Illuminate\Session\Store;
use Illuminate\Filesystem\Filesystem;
use ZipArchive;

class Zip{

    public function __construct(ZipArchive $zip){
        $this->zip = $zip;
    }

    public function extract($file, $destination)
    {
        if(!file_exists($file) || $this->zip->open($file) === FALSE) return;

        $this->zip->extractTo($destination);
        $this->zip->close();

        return true;
    }

}