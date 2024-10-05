<?php namespace Digitlimit\Adminpanel\Facades;

use Illuminate\Support\Facades\Facade;

class Adminpanel extends Facade {

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor() {

        return 'adminpanel';
    }

} 