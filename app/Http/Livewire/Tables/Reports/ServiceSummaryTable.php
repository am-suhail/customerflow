<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Service;
use Livewire\Component;

class ServiceSummaryTable extends Component
{
    public $services;

    public function mount()
    {
        $this->services = Service::all();
    }

    public function render()
    {
        return view('livewire.tables.reports.service-summary-table');
    }
}
