<?php


namespace App\Facades;

use App\Services\GeocodingService;

/**
 * Class Geocoding
 * @package App\Facades
 * @method   static array getLatLng(string $destenation)
 * @see \App\Services\GeocodingService
 */

class Geocoding
{
    public static function __callStatic($method, $arguments)
    {

        return (self::resolveFacade('GeocodingService'))->$method(...$arguments);
    }
    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

}
