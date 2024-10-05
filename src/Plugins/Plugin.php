<?php namespace Digitlimit\Adminpanel\Plugins;

use Exception;
use Illuminate\Filesystem\Filesystem as File;
use Digitlimit\Adminpanel\Models\AdminpanelPlugin;
use Digitlimit\Adminpanel\Http\Exceptions\PluginException;

use Digitlimit\Adminpanel\Utils\Zip;
use Digitlimit\Adminpanel\Utils\Artisan;
use Digitlimit\Adminpanel\Utils\Composer;
use Schema;

class Plugin implements PluginContract{

    protected $attributes = ['ext','filename','name'];

    public function __construct(File $file, AdminpanelPlugin $plugin, Zip $zip, Artisan $artisan, Composer $composer){
        $this->file = $file;
        $this->plugin = $plugin;

        $this->zip = $zip;
        $this->artisan = $artisan;
        $this->composer = $composer;
    }

    public function install($plugin)
    {
        //
        if(!is_dir(adminpanel_plugin_path()) || !is_writable(adminpanel_plugin_path() )){
            throw new PluginException('Plugins directory is not writable');
        }


        //here we need to know if we installing from a zip file or a directory existing in plugins directory
        //this will allow developers to simply drop plugins in plugins directory which can the be installed
        //from the panel in plugin page

        if(is_string($plugin)){
            //directory name
            $this->attributes['name'] = $plugin;
        }elseif(is_object($plugin)){
            $this->attributes['ext'] = $plugin->getClientOriginalExtension();
            $this->attributes['filename'] = $plugin->getClientOriginalName();
            $this->attributes['name']  = str_replace(".{$this->attributes['ext']}", '', $this->attributes['filename']);
        }

        //check if plugin exists under installed plugins in the table
        $plugin_exists = $this->plugin->where('name', $this->attributes['name'])->get();
        if($plugin_exists->count()){
            throw new PluginException('Plugin already exists');
        }


        //this is only applicable to uploaded zip files
        if(is_object($plugin))
        {
            $plugin->move(adminpanel_plugin_path(), $this->attributes['filename']);

            //verify successful upload
            if(!file_exists(adminpanel_plugin_path($this->attributes['filename']))){
                throw new PluginException('Plugin upload failed');
            }

            //extract to plugins directory
            if(!$this->extract($this->attributes['filename'])){
                throw new PluginException('Plugin unzip failed');
            }

            //remove zip file
            $this->file->delete(adminpanel_plugin_path($this->attributes['filename']));
        }

        //run migrations
        $migration = $this->migrate($this->attributes['name']);
        if($migration !== TRUE){
            //we commented out line below as we are not going to delete plugin directory if migration fails
            // there  is now an option to delete it from the panel.

            # $this->file->deleteDirectory(adminpanel_plugin_path($this->attributes['name']));
            throw new PluginException("Plugin Error: Migration failed -> $migration");
        }

        //save to plugin tables
        if(!$this->save($this->attributes)){
            //we commented out line below as we are not going to delete plugin directory if migration fails
            // there  is now an option to delete it from the panel.

            # $this->file->deleteDirectory(adminpanel_plugin_path($this->attributes['name']));
            throw new PluginException('Plugin failed to write to database');
        }

        return true;
    }

    public function uninstall(){

    }

    public function backup(){

    }

    public function migrate($name)
    {
        //adminpanel_plugin_post_setup_tables

        $source_migration_filename = "adminpanel_plugin_".strtolower($name)."_setup_tables.php";
        $source_migration_file = adminpanel_plugin_path("$name/database/migrations/$source_migration_filename");

        if(!file_exists($source_migration_file)){
            //we commented out PluginException since we want to continue installation if migration does not
            //exist within plugin directory

            # throw new PluginException('Plugin Error: Migration file now found');
            return true; //to continue without migration
        }

        $target_migration_filename = date('Y_m_d_His'). "_adminpanel_plugin_".strtolower($name)."_setup_tables.php";
        $target_migration_file = database_path("migrations/$target_migration_filename");

        //publish migration file to database/migrations
        if(!$this->file->copy($source_migration_file, $target_migration_file)){
            throw new PluginException('Plugin Error: Migration publish failed');
        }
        //Add this to attributes to be saved in database as reference
        $this->attributes['migration_file'] = $target_migration_filename;

        try{
            //Run php artisan clear-compiled, composer dump-autoload  and php artisan optimize
            $this->migrationHelperScripts();

            //Run php artisan migrate
            $this->artisan->migrate();

        }catch(Exception $e){
            //delete copied migration file since it failed
            $this->file->delete($target_migration_file);

            //Run php artisan clear-compiled, composer dump-autoload  and php artisan optimize
            $this->migrationHelperScripts();

            //return exception message
            return $e->getMessage();
        }

        return true;
    }

    public function demigrate($plugin_name){

    }

    public function activate(){

    }

    public function deactivate(){

    }

    public function update(){

    }

    public function active(){
        return $this->plugin->where('active',1)->get();
    }


    public function discover($path=null){

        $plugin_dirs = scandir(adminpanel_plugin_path());
        unset($plugin_dirs[0]); //remove .
        unset($plugin_dirs[1]); //remove ..

        //get currently installed plugins
        $installedPlugins = $this->plugin->all();
        $otherPlugins = [];

        foreach($plugin_dirs as $name)
        {
            //get plugin configuration
            $plugin = adminpanel_plugin_config($name);

            //ensure we have an array and plugin is not already installed
            if(is_array($plugin) && !$installedPlugins->where('name',$name)->count()){
                $otherPlugins[] = (object) $plugin;
            }
        }

        return collect($otherPlugins);
    }


    /**
     * Extract plugin zip file to plugins directory
     *
     * @param $filename
     * @return bool|void
     */
    protected function extract($filename)
    {
        return $this->zip->extract(adminpanel_plugin_path($filename), adminpanel_plugin_path());
    }

    protected function save($attributes)
    {
        //gets plugin configuration
        $config = adminpanel_plugin_config($attributes['name']);

        if(!is_array($config)) return;
        $config['name'] = $attributes['name'];;

        return $this->plugin->create($config);
    }

    protected function migrationHelperScripts()
    {
        //Run php artisan clear-compiled
        $this->artisan->clearCompiled();
        //Run composer dump-autoload
        $this->composer->dumpAutoload();
        //Run php artisan optimize
        $this->artisan->optimize();
    }
}