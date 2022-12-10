<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ListItem extends Component
{
    public $index;
    public $itemId;
    public $title;
    public $url;
    public $date;
    public $author;

    public function render()
    {
        return view('livewire.components.list-item');
    }
}
