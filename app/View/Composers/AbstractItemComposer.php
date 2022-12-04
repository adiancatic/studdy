<?php

namespace App\View\Composers;

use App\Helpers\DI;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractItemComposer extends AbstractComposer
{
    public const MODEL = null;

    protected int $id;
    /** @var Model */
    protected $item;

    abstract public static function parentComposer(): string;

    public static function url($id = null): string
    {
        if (! $id) {
            throw new \Exception("No ID given");
        }

        if (! static::MODEL) return false;

        $parentId = null;

        if (defined(static::MODEL . "::PARENT_ID")) {
            $model = DI::get(static::MODEL);
            $parentId = $model::find($id)->{$model::PARENT_ID};
        }

        $parentInstance = DI::get(static::parentComposer());
        $parentUrl = $parentInstance::url($parentId);

        return "$parentUrl/$id";
    }

    public static function stackTrace($id = null)
    {
        if (! static::MODEL) return false;

        $model = DI::get(static::MODEL);
        $item = $model::find($id);

        $parentId = defined(static::MODEL . "::PARENT_ID")
            ? $item->{$model::PARENT_ID}
            : null;

        $parentInstance = DI::get(static::parentComposer());
        $parentStack = $parentInstance::stackTrace($parentId);

        $stack = [];

        if ($parentStack) {
            $stack = $parentStack;
        }

        $stack[] = DI::get(static::class)::fromId($id);

        return $stack;
    }

    public function getUrl(): string
    {
        return static::url($this->item->id);
    }

    public static function fromId($id)
    {
        $model = DI::get(static::MODEL);
        $item = $model::find($id);

        return DI::get(static::class)
            ->setItem($item);
    }

    public function getId(): int
    {
        if ($this->id === null && $this->item) {
            $this->setId($this->item->id);
        }

        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getItem(): Model
    {
        return $this->item;
    }

    public function setItem(Model $item)
    {
        $this->item = $item;
        return $this;
    }

    public function getTitle()
    {
        return $this->item->title ?? static::TITLE;
    }

    public function compose(View|\Illuminate\View\View $view): void
    {
        parent::compose($view);

        $this->setItem($view->getData()["item"]);
    }
}
