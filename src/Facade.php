<?php
namespace ttungbmt\Laravel\Geoserver;
use OneOffTech\GeoServer\StyleFile;

/**
 * @method static array manifest()
 * @method static string version()
 * @method static object workspace()
 * @method static \OneOffTech\GeoServer\Models\Workspace createWorkspace(string $name = '')
 * @method static array datastores()
 * @method static \OneOffTech\GeoServer\Models\DataStore datastore($name)
 * @method static \OneOffTech\GeoServer\Models\DataStore deleteDatastore($name)
 * @method static \OneOffTech\GeoServer\Models\Feature feature($datastore, $name = null)
 * @method static \OneOffTech\GeoServer\Models\Style style($name)
 * @method static \OneOffTech\GeoServer\Models\Style[] styles()
 * @method static \OneOffTech\GeoServer\Models\Style uploadStyle(StyleFile $file)
 * @method static \OneOffTech\GeoServer\Models\Style removeStyle($name)
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
