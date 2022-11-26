<?php

namespace App\View\Composers;

use Illuminate\View\View;

class DashboardComposer extends AbstractComposer
{
    protected string $title = "Dashboard";
    protected string $icon = "objects-column";
    protected string $view = "dashboard";
}
