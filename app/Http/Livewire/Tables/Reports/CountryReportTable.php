<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;

class CountryReportTable extends Component
{
    public $countries;

    public function mount()
    {
        $this->countries = Company::whereHas('country')->get();
    }

    public function render()
    {
        return view('livewire.tables.reports.country-report-table');
    }
}
