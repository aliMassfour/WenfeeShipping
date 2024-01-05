<?php

namespace App\Exceptions;

use Exception;

class LoginException extends Exception
{
    public static function invalidCredentials()
    {
        return new self("this email is not match our email in database ",401);

    }

}
