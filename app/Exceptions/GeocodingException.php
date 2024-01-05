<?php

namespace App\Exceptions;

use Exception;

class GeocodingException extends Exception
{
    public static function badDestination()
    {
        return new self("destination  not found",404);
    }
}
