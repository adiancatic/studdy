<?php

namespace App\Http\Livewire\Views\Calendar;

use Carbon\Carbon;
use Livewire\Component;

class Header extends Component
{
    /** @var Carbon */
    public $now;
    public $offset;
    public $offsetType;

    public function render()
    {
        return view('livewire.views.calendar.header');
    }
}
