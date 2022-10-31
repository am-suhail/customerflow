<?php

namespace App\Http\Livewire\Modals;

use App\Models\ProjectEnquiry;
use LivewireUI\Modal\ModalComponent;

class ConvertEnquiryToProjectModal extends ModalComponent
{
    public $enquiry;

    public function mount(ProjectEnquiry $record_id)
    {
        $this->enquiry = $record_id;
    }

    public function proceedFurther()
    {
        return redirect()->route('project.create', $this->enquiry->id);
    }


    public function render()
    {
        return view('livewire.modals.convert-enquiry-to-project-modal');
    }
}
