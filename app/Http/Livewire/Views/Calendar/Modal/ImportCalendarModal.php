<?php

namespace App\Http\Livewire\Views\Calendar\Modal;

use App\Models\Event;
use ICal\ICal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCalendarModal extends Component
{
    use WithFileUploads;

    public $params;
    public $ical;
    /** @var Event[] */
    public $events;
    public $filename;

    protected $validationAttributes = [
        "ical" => "calendar upload",
    ];

    public function updatedIcal()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate([
            "ical" => "mimes:ics,ical|max:1024",
        ]);

        $this->filename = $this->ical->store("icals");
        if (! $this->filename) return;

        $file = Storage::get($this->filename);
        $ical = new ICal($file, ["defaultTimeZone" => "UTC"]);
        $this->events = collect();

        foreach ($ical->events() as $icalEvent) {
            // todo: add fields in db
            // $event->description
            // $event->location

            $event = new Event();
            $event->title = $icalEvent->summary;
            $event->date_start = Carbon::createFromTimestamp($icalEvent->dtstart_array[2])->format("d-m-Y H:i:s");
            $event->date_end = Carbon::createFromTimestamp($icalEvent->dtend_array[2])->format("d-m-Y H:i:s");
            $event->user_id = Auth::user()->id;
            $event->type = "timetable";

            $this->events->push($event->toArray());
        }

        Storage::delete($this->filename);
    }

    public function commit()
    {
        $now = Carbon::now()->format("Y-m-d H:i:s");

        foreach ($this->events as $event) {
            $event = new Event($event);
            $event->created_at = $now;
            $event->updated_at = $now;
            $event->save();
        }

        $this->dispatchBrowserEvent("closeModal");
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.calendar.modal.import-calendar-modal');
    }
}
