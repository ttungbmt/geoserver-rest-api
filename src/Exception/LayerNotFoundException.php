<?php

namespace ttungbmt\REST\Geoserver\Exception;

use OneOffTech\GeoServer\Exception\GeoServerClientException;

/**
 * Raised when a store cannot be found on the specific geoserver instance
 */
class LayerNotFoundException extends GeoServerClientException
{
    /**
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 404);
    }


    /**
     * Create a store not found exception for a data store
     *
     * @param string $name the data store name
     * @return LayerNotFoundException
     */
    public static function layer($name)
    {
        return new self("Layer [$name] not found.");
    }

}
