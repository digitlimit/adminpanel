<?php namespace Digitlimit\Adminpanel\Utils;

use Illuminate\Contracts\Console\Kernel;

class Artisan{

    public $artisan;

    public function __construct(Kernel $artisan){
        $this->artisan = $artisan;
    }

    public function migrate($path=null)
    {
        $options = [];
        if($path) $options['--path'] = $path;

        $this->artisan->call('migrate', $options);
        return $this->artisan;
    }

    public function optimize()
    {
        $this->artisan->call('optimize');
        return $this->artisan;
    }

    public function clearCompiled()
    {
        $this->artisan->call('clear-compiled');
        return $this->artisan;
    }
}