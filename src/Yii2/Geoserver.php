<?php
namespace ttungbmt\REST\Geoserver\Yii2;
use OneOffTech\GeoServer\Auth\Authentication;
use OneOffTech\GeoServer\Auth\NullAuthentication;
use OneOffTech\GeoServer\Http\InteractsWithHttp;
use OneOffTech\GeoServer\Http\Routes;
use OneOffTech\GeoServer\Options;
use ttungbmt\REST\Geoserver\Traits\BaseGeoserver;
use ttungbmt\REST\Geoserver\Traits\MyGeoserver;
use yii\base\Component;

class Geoserver extends Component
{
    use InteractsWithHttp, BaseGeoserver, MyGeoserver;

    public $url = 'http://localhost:8080/geoserver/';
    public $username = 'admin';
    public $password = 'geoserver';
    public $workspace;


    /** @var  Routes */
    private $routes;

    public function init()
    {
        parent::init();
        $authentication = new Authentication($this->username, $this->password);
        $options = new Options($authentication ?? (new NullAuthentication));
        $this->httpClient = $options->httpClient;
        $this->messageFactory = $options->messageFactory;
        $this->routes = new Routes($this->url);
        $this->serializer = $options->serializer;
    }

    public function setWorkspace($workspace){
        $this->workspace = $workspace;
    }
}
