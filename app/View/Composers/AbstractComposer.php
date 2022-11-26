<?php

namespace App\View\Composers;

use Illuminate\View\View;

abstract class AbstractComposer
{
    protected const TITLE = "";
    public const ICON = "";
    public const VIEW = "";

    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('title', $this->getTitle());
        $view->with('icon', $this->getIcon());
    }

    public function getTitle(): string
    {
        return __(static::TITLE);
    }

    public function getIcon(): string
    {
        return static::ICON;
    }

    public function getView(): string
    {
        return static::VIEW;
    }
}
