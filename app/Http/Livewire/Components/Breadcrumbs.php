<?php

namespace App\Http\Livewire\Components;

use App\Helpers\DI;
use Illuminate\Support\Facades\Request;

class Breadcrumbs extends \Livewire\Component
{
    public $node;
    public $breadcrumbs;

    public function mount()
    {
        if (! $this->node) {
            throw new \Exception("Node not defined");
        }

        $segment = last(Request::segments());
        $this->breadcrumbs = $this->getStackTrace($this->node, $segment);
    }

    protected function getStackTrace($nodeClass, $id = null)
    {
        $node = DI::get($nodeClass);

        if (! isset($node->breadcrumbConf()["item"])) {
            return [$node];
        }

        $node->setItem($id);
        // dd($node);

        $nodeModelClass = $node->breadcrumbConf()["modelClass"];
        $nodeModel = DI::get($nodeModelClass);
        // dd($nodeModel);

        $parentId = defined($nodeModelClass . "::PARENT_ID")
            ? $node->getItem()->{$nodeModel::PARENT_ID}
            : null;
        // dd($parentId);

        $parentClass = $node->breadcrumbConf()["parentClass"];
        if (! $parentClass) return;
        // dd($parentClass);

        $stackTrace = [];
        $parentStackTrace = $this->getStackTrace($parentClass, $parentId);

        if ($parentStackTrace) {
            $stackTrace = $parentStackTrace;
        }

        $stackTrace[] = $node;

        return $stackTrace;
    }

    public function render()
    {
        return view('livewire.components.breadcrumbs');
    }
}
