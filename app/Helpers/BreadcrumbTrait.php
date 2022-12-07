<?php

namespace App\Helpers;

trait BreadcrumbTrait
{
    abstract public function breadcrumbConf();

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->{$this->breadcrumbConf()["item"]};
    }

    /**
     * @param mixed $item
     * @return BreadcrumbTrait
     */
    public function setItem($item)
    {
        $this->{$this->breadcrumbConf()["item"]} = DI::get($this->breadcrumbConf()["modelClass"])::find($item);

        return $this;
    }
}
