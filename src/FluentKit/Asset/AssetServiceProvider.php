<?php
namespace FluentKit\Asset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AssetServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

    public function register()
    {

		//register asset management
        $this->app->bindShared('fluentkit.asset', function(){

            $assetManager = new AssetManager;

            /////  PREDEFINED LIBRARIES  /////
            $assetManager->register('jquery', function($asset)
            {
                $asset->js('//ajax.googleapis.com/ajax/libs/jquery/{version}/jquery.min.js', array('version' => '1.11.0'));
            });
            $assetManager->register('jquery-ui', function($asset)
            {
                $asset->js('//ajax.googleapis.com/ajax/libs/jqueryui/{version}/jquery-ui.min.js', array('version' => '1.10.4'));
                $asset->css('//ajax.googleapis.com/ajax/libs/jqueryui/{version}/themes/smoothness/jquery-ui.css', array('version' => '1.10.4'));
                $asset->requires('jquery');
            });
            $assetManager->register('angular-js', function($asset)
            {
                $asset->js('//ajax.googleapis.com/ajax/libs/angularjs/{version}/angular.min.js', array('version' => '1.2.15'));
            });
            $assetManager->register('bootstrap', function($asset)
            {
                $asset->js('//netdna.bootstrapcdn.com/bootstrap/{version}/js/bootstrap.min.js', array('version' => '3.1.1'), array('defer' => 'defer'));
                $asset->requires('jquery');
                $asset->css('//netdna.bootstrapcdn.com/bootstrap/{version}/css/bootstrap.min.css', array('version' => '3.1.1'));
            });

            return $assetManager;
        });

    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    	//register facades
    	$loader = AliasLoader::getInstance();

		//fluent aliases
		$loader->alias('Asset', 'FluentKit\Asset\Facade');

    }

    public function provides(){
    	return array('fluentkit.asset');
    }

}