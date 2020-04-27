<?php

namespace ttungbmt\REST\Geoserver;

use OneOffTech\GeoServer\Http\InteractsWithHttp;
use OneOffTech\GeoServer\Http\Routes;
use OneOffTech\GeoServer\Options;
use ttungbmt\REST\Geoserver\Traits\BaseGeoserver;
use ttungbmt\REST\Geoserver\Traits\MyGeoserver;

class Geoserver
{
    use InteractsWithHttp, BaseGeoserver, MyGeoserver;

    /** @var string */
    private $workspace;

    /** @var  Routes */
    private $routes;


    public function __construct($url, $workspace, Options $options)
    {
        $this->httpClient = $options->httpClient;
        $this->messageFactory = $options->messageFactory;
        $this->routes = new Routes($url);
        $this->serializer = $options->serializer;
        $this->workspace = $workspace;
    }

}
