<?php

namespace App\Http\Livewire\Modals;

use App\Models\MarketLead;
use LivewireUI\Modal\ModalComponent;

class ViewMarketLeadModal extends ModalComponent
{
    public $lead;

    public function mount(MarketLead $lead)
    {
        $this->lead = $lead;
    }

    public function render()
    {
        return view('livewire.modals.view-market-lead-modal');
    }
}
