<?php namespace Digitlimit\Adminpanel\Plugins;

use Illuminate\Filesystem\Filesystem;
use Digitlimit\Adminpanel\Utils\Zip;

interface PluginContract{

    public function install($plugin);

    public function uninstall();

    public function discover($path=null);

    public function backup();

    public function migrate($plugin_name);

    public function demigrate($plugin_name);

    public function activate();

    public function deactivate();

    public function update();

    public function active();

}