<?php

namespace App\Http\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ListItem extends Component
{
    /** @var Model */
    public $item;
    public $index;
    public $isSortable = false;

    public function update($data)
    {
        $this->item->fill($data)->save();
        $this->emitUp("refresh");
    }

    public function delete()
    {
        $this->item->delete();
        $this->emitUp("refresh");
    }

    public function render()
    {
        return view('livewire.components.list-item');
    }
}
