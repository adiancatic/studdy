<?php

namespace App\View\Composers;

use Illuminate\View\View;

abstract class AbstractComposer
{
    protected string $title;
    protected string $icon;
    protected string $view;

    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('title', $this->getTitle());
        $view->with('icon', $this->getIcon());
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return AbstractComposer
     */
    public function setTitle(string $title)
    {
        $this->title = __($title);
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return AbstractComposer
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @param string $view
     * @return AbstractComposer
     */
    public function setView(string $view)
    {
        $this->view = $view;
        return $this;
    }
}
