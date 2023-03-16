<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;

class CountryReportTable extends Component
{
    public $companies;

    public function mount()
    {
        $this->companies = Company::whereHas('country')->get();

        // Total Companies for the Country
        // Total Sum
    }

    public function render()
    {
        return view('livewire.tables.reports.country-report-table');
    }
}
