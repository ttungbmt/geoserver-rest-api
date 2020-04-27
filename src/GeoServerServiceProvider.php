<?php

namespace ttungbmt\REST\Geoserver;

use Illuminate\Support\ServiceProvider;
use OneOffTech\GeoServer\Auth\Authentication;
use OneOffTech\GeoServer\Auth\NullAuthentication;
use OneOffTech\GeoServer\Options;

class GeoServerServiceProvider extends ServiceProvider
{

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['geoserver'];
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configFile = __DIR__ . '/../config/geoserver.php';

        $this->mergeConfigFrom($configFile, 'geoserver');

        $this->publishes([
            $configFile => config_path('geoserver.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('geoserver', function ($app) {
            $url = config('geoserver.url');
            $workspace = config('geoserver.workspace');
            $authentication = new Authentication(config('geoserver.username'), config('geoserver.password'));
            return GeoServer::build($url, $workspace, $authentication);
        });
    }
}
