<?php

namespace App\Helpers;

class DI
{
    public static function get($className)
    {
        return new $className;
    }
}
