<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;

class CountryReportTable extends Component
{
    public $daily_summary;

    public function mount()
    {
        $this->daily_summary = collect();
    }

    public function render()
    {
        return view('livewire.tables.reports.country-report-table');
    }
}
