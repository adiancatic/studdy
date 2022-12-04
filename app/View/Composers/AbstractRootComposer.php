<?php

namespace App\View\Composers;

use App\Helpers\DI;

abstract class AbstractRootComposer extends AbstractComposer
{
    abstract public static function alias(): string;

    public static function url($id = null): string
    {
        return "/" . static::alias();
    }

    public static function stackTrace($id = null)
    {
        return [DI::get(static::class)];
    }

    public function getUrl(): string
    {
        return static::url();
    }
}
