<?php

namespace App\Http\Livewire\Views\Subjects\Modal;

use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditSubjectModal extends Component
{
    /** @var Subject */
    public $subject;

    public function mount($params)
    {
        if (! empty($params["id"])) {
            $this->subject = Subject::find($params["id"]);
        }

        if (! $this->subject) {
            $this->subject = new Subject();
        }
    }

    public function save($formData)
    {
        $validatedData = Validator::make(
            [
                "title" => $formData["title"],
                "icon" => $formData["icon"],
            ],
            [
                "title" => "required",
                "icon" => "sometimes",
            ],
        )->validate();

        if (! empty($formData["id"])) {
            Subject::find((int) $formData["id"])
                ->fill($validatedData)
                ->save();
        } else {
            Subject::create($validatedData);
        }

        $this->dispatchBrowserEvent("closeModal");
        $this->emit("refresh");
    }

    public function render()
    {
        return view('livewire.views.subjects.modal.edit-subject-modal');
    }
}
