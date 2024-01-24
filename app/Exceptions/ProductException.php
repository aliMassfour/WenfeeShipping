<?php

namespace App\Exceptions;

use Exception;

class ProductException extends Exception
{
    public static function notFoundProduct()
    {
        return new self("the product not found",404);
    }
}
