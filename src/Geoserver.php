<?php

namespace ttungbmt\Laravel\Geoserver;

use OneOffTech\GeoServer\Exception\ErrorResponseException;
use OneOffTech\GeoServer\Exception\StoreNotFoundException;
use OneOffTech\GeoServer\Http\InteractsWithHttp;
use OneOffTech\GeoServer\Http\Responses\WorkspaceResponse;
use OneOffTech\GeoServer\Http\Routes;
use OneOffTech\GeoServer\Options;
use ttungbmt\Laravel\Geoserver\Exception\LayerNotFoundException;
use ttungbmt\Laravel\Geoserver\Traits\BaseGeoserver;

class Geoserver
{
    use InteractsWithHttp, BaseGeoserver;

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

    public function workspaces()
    {
        $route = $this->routes->url("workspaces");
        $response = $this->get($route);

        return $response->workspaces->workspace;
    }

    /**
     * Retrieve the workspace information.
     *
     * @param string $name
     * @return \OneOffTech\GeoServer\Models\Workspace
     * @uses the workspace specified during client instantiation
     *
     */
    public function workspace(string $name = '')
    {
        $route = $this->routes->url("workspaces/".$this->getWorkspaceName($name));

        $response = $this->get($route, WorkspaceResponse::class);

        return $response->workspace;
    }

    public function getWorkspaceName(string $name = ''){
        return $name ?? $this->workspace;
    }

    /**
     * Create the configured workspace, if not existing
     * @param string $name
     * @return \OneOffTech\GeoServer\Models\Workspace
     * @throws ErrorResponseException
     * @uses the workspace specified during client instantiation
     */
    public function createWorkspace(string $name = '')
    {
        $workspaceName = $this->getWorkspaceName($name);
        try {
            $route = $this->routes->url("workspaces");
            $response = $this->post($route, ['workspace' => ['name' => $workspaceName]]);
        } catch (ErrorResponseException $ex) {
            if ($ex->getCode() !== 401) {
                throw $ex;
            }
        }
        return $this->workspace($workspaceName);
    }

    public function updateWorkspace($name, $data = []){
        $route = $this->routes->url("workspaces/".$this->getWorkspaceName($name));
        $this->put($route, ['workspace' => $data]);

        return $this->workspace();
    }

    public function deleteWorkspace($name){
        $workspace = $this->workspace($name);

        $route = $this->routes->url("workspaces/".$this->getWorkspaceName($name));
        $this->delete($route);

        $workspace->exists = false;

        return $workspace;
    }


    public function createDatastore(array $data){
        /* { "dataStore": { "name": "{{storeName}}", "connectionParameters": { "entry": [ {"@key":"dbtype","$":"postgis"}, {"@key":"host","$":"{{host}}"}, {"@key":"port","$":"{{port}}"}, {"@key":"database","$":"{{database}}"}, {"@key":"user","$":"{{user}}"}, {"@key":"passwd","$":"{{passwd}}"}, {"@key":"Expose primary keys","$":true} ] } } } */
        $route = $this->routes->url("/workspaces/{$this->workspace}/datastores");
        $this->post($route, ['dataStore' => $data]);
        return $this->datastore($data['name']);
    }

    public function updateDatastore(string $name, array $data){
        /* { "dataStore": { "connectionParameters": { "entry": [ {"@key":"dbtype","$":"postgis"}, {"@key":"host","$":"{{host}}"}, {"@key":"port","$":"{{port}}"}, {"@key":"database","$":"{{database}}"}, {"@key":"user","$":"{{user}}"}, {"@key":"passwd","$":"{{passwd}}"}, {"@key":"Expose primary keys","$":true} ] } } } */
        $route = $this->routes->url("/workspaces/{$this->workspace}/datastores/".$name);
        $this->put($route, ['dataStore' => $data]);

        return $this->datastore($name);
    }

    public function layers(){
        $route = $this->routes->url("/workspaces/{$this->workspace}/layers");
        $response = $this->get($route);

        return data_get($response, 'layers.layer', []);
    }

    public function layer(string $name){
        $route = $this->routes->url("/workspaces/{$this->workspace}/layers/{$name}");

        try {
            return $this->get($route)->layer;
        } catch (ErrorResponseException $ex) {
            if ($ex->getMessage() === 'Not Found') {
                throw LayerNotFoundException::layer($name);
            }

            throw $ex;
        }
    }

    public function updateLayer(string $name, array $data){
        $route = $this->routes->url("/workspaces/{$this->workspace}/layers/{$name}");

        $this->put($route, ['layer' => $data]);

        return $this->layer($name);
    }

    public function deleteLayer(string $name){
        $layer = $this->workspace($name);

        $route = $this->routes->url("workspaces/{$this->workspace}/layers/{$name}");
        $this->delete($route);

        $layer->exists = false;

        return $layer;
    }

    public function deleteLayer(string $name){
        $layer = $this->workspace($name);

        $route = $this->routes->url("workspaces/{$this->workspace}/layers/{$name}");
        $this->delete($route);

        $layer->exists = false;

        return $layer;
    }



//    public function fonts()
//    {
//        $route = $this->routes->url('fonts');
//        $response = $this->get($route);
//        return $response->fonts;
//    }
//
//    public function layers()
//    {
//        $route = $this->routes->url('layers');
//        $response = $this->get($route);
//        return $response->layers->layer;
//    }
//
//    public function styles()
//    {
//        $styles = $this->client->styles();
//
//        $route = $this->routes->url('styles');
//        $response = $this->get($route);
//        return $response->styles->style;
//    }
//
//    public function style(...$args)
//    {
//        $route = $this->routes->url("workspaces/drought/styles/grid.sld");
//        $request = $this->messageFactory->createRequest('GET', $route, []);
//        $response = $this->handleRequest($request);
//        $stream = $response->getBody();
//        return $stream->getContents();
//
//
////        dd(file_get_contents('http://localhost:8080/geoserver/rest/workspaces/drought/styles/grid.css'));
//
////        $response = $this->get($route);
////        dd($response);
//
////        return $this->client->style(...$args);
//    }
}
