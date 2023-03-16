<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Branch;
use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;

class CountryReportTable extends Component
{
    public $companies;
    public $companiesByCountry,
        $totalCompanies,
        $totalInvoices;

    public function mount()
    {
        $this->companies = Company::whereHas('country')->get();

        $companiesByCountry = $this->companies->groupBy('country.name');
        $this->totalCompanies = $this->companies->count();
        $this->totalInvoices = $companiesByCountry->flatMap->sum(function ($company) {
            return $company->sum(function ($c) {
                return $c->branches->sum(function ($b) {
                    return $b->invoices->sum('total_amount');
                });
            });
        });
    }

    public function render()
    {
        return view('livewire.tables.reports.country-report-table');
    }
}
