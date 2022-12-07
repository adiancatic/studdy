<?php

namespace App\Helpers;

trait SingletonObjectGetterTrait
{
    public static function get()
    {
        return DI::get(static::class);
    }
}
