<?php

namespace App\Http\Livewire\Views\Calendar\Modal;

use App\Http\Livewire\ModelComponent;
use App\Models\Event;
use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

class EditEventModal extends ModelComponent
{
    protected const MODEL = Event::class;

    protected $rules = [
        "model.title" => "required",
        "model.date_start" => "required",
        "model.date_end" => "required",
    ];

    protected $listeners = [
        "setDate",
        "setHour",
        "setMinute",
    ];

    public function mount($params = null, $defaults = null)
    {
        parent::mount($params, $defaults);

        if (! $this->model->date_start) {
            $this->model->date_start = CarbonImmutable::now()
                ->setMinute(0)
                ->setSecond(0);
        }

        if (! $this->model->date_end) {
            $this->model->date_end = CarbonImmutable::now()
                ->setMinute(0)
                ->setSecond(0)
                ->addHour();
        }
    }

    public function setDate($date, $isEnd = false)
    {
        $date = explode("-", $date);

        if ($isEnd) {
            $dateEnd = Carbon::parse($this->model->date_end);
            $dateEnd->setYear($date[0]);
            $dateEnd->setMonth($date[1]);
            $dateEnd->setDay($date[2]);

            $this->model->date_end = $dateEnd->format("Y-m-d H:i:s");
        } else {
            $dateStart = Carbon::parse($this->model->date_start);
            $dateStart->setYear($date[0]);
            $dateStart->setMonth($date[1]);
            $dateStart->setDay($date[2]);

            $this->model->date_start = $dateStart->format("Y-m-d H:i:s");
        }
    }

    public function setHour($hour, $isEnd = false)
    {
        if ($isEnd) {
            $dateEnd = Carbon::parse($this->model->date_end);
            $dateEnd->setHour($hour);

            $this->model->date_end = $dateEnd->format("Y-m-d H:i:s");
        } else {
            $dateStart = Carbon::parse($this->model->date_start);
            $dateStart->setHour($hour);

            $this->model->date_start = $dateStart->format("Y-m-d H:i:s");
        }
    }

    public function setMinute($minute, $isEnd = false)
    {
        if ($isEnd) {
            $dateEnd = Carbon::parse($this->model->date_end);
            $dateEnd->setMinute($minute);

            $this->model->date_end = $dateEnd->format("Y-m-d H:i:s");
        } else {
            $dateStart = Carbon::parse($this->model->date_start);
            $dateStart->setMinute($minute);

            $this->model->date_start = $dateStart->format("Y-m-d H:i:s");
        }
    }

    public function validateAndSave()
    {
        $this->model->type = "basic";

        parent::validateAndSave();

        $this->dispatchBrowserEvent("closeModal");
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.calendar.modal.edit-event-modal');
    }
}
