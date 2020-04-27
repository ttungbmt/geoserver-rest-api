<?php
namespace ttungbmt\REST\Geoserver;
use OneOffTech\GeoServer\StyleFile;

/**
 *
 * @method static array manifest()
 * @method static string version()
 * @method static array workspaces()
 * @method static \OneOffTech\GeoServer\Models\Workspace workspace(string $name = '')
 * @method static \OneOffTech\GeoServer\Models\Workspace createWorkspace(string $name = '')
 * @method static \OneOffTech\GeoServer\Models\Workspace updateWorkspace(array $data, string $name)
 * @method static \OneOffTech\GeoServer\Models\Workspace deleteWorkspace($name)
 * @method static \OneOffTech\GeoServer\Models\DataStore[] datastores()
 * @method static \OneOffTech\GeoServer\Models\DataStore datastore($name)
 * @method static \OneOffTech\GeoServer\Models\DataStore createDatastore($name)
 * @method static \OneOffTech\GeoServer\Models\DataStore updateDatastore(string $name, array $data)
 * @method static \OneOffTech\GeoServer\Models\DataStore deleteDatastore($name)
 * @method static \OneOffTech\GeoServer\Models\Feature feature($datastore, $name = null)
 * @method static array layers()
 * @method static object layer(string $name)
 * @method static object updateLayer(string $name, array $data)
 * @method static object deleteLayer(string $name)
 * @method static \OneOffTech\GeoServer\Models\Style style($name)
 * @method static \OneOffTech\GeoServer\Models\Style[] styles()
 * @method static \OneOffTech\GeoServer\Models\Style uploadStyle(StyleFile $file)
 * @method static \OneOffTech\GeoServer\Models\Style removeStyle($name)
 *
 */

class Facade extends \Illuminate\Support\Facades\Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geoserver';
    }

}
