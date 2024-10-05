<?php namespace Digitlimit\Adminpanel\Utils;

class Composer{

    public function __construct(){

    }

    public function run($command){
        return shell_exec('(cd '. base_path() .' && /usr/local/bin/composer '.$command.')');
    }

    public function install(){
        return $this->run('install');
    }

    public function dumpAutoload(){
        return $this->run('dump-autoload');
    }
}
