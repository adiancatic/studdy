<?php

namespace App\View\Composers;

class DashboardComposer extends AbstractComposer
{
    protected const TITLE = "Dashboard";
    public const ICON = "objects-column";
    public const VIEW = "dashboard";

    public function getUrl(): string
    {
        // TODO: Implement getUrl() method.
    }

    public static function url($id = null): string
    {
        // TODO: Implement url() method.
    }

    public static function stackTrace($id = null)
    {
        // TODO: Implement stackTrace() method.
    }
}
