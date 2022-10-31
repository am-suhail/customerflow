<?php

namespace App\Http\Livewire\Modals;

use App\Models\ProjectEnquiry;
use LivewireUI\Modal\ModalComponent;

class EnquiryQuickViewModal extends ModalComponent
{
    public $enquiry;

    public function mount(ProjectEnquiry $record_id)
    {
        $this->enquiry = $record_id;
    }

    public function render()
    {
        return view('livewire.modals.enquiry-quick-view-modal');
    }
}
