<?php

namespace App\View\Composers;

use Illuminate\View\View;

class DashboardComposer extends AbstractComposer
{
    protected const TITLE = "Dashboard";
    public const ICON = "objects-column";
    public const VIEW = "dashboard";
}
