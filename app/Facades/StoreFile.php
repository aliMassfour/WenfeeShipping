<?php


namespace App\Facades;

use Illuminate\Http\UploadedFile;

/**
 * Class StoreFile
 * @package App\Facades
 * @method static string store(UploadedFile $file, int $orderId)
 */
class StoreFile
{
    public static function __callStatic($method, $arguments)
    {

        return (self::resolveFacade('StoreFileService'))->$method(...$arguments);
    }

    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

}
