<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;

class CountryReportTable extends Component
{
    public $companies,
        $total_companies,
        $total_branches,
        $total_invoice_amount;

    public function mount()
    {
        $this->companies = Company::whereHas('country')->get();

        $this->total_companies = $this->companies->count();
        $this->total_branches = $this->companies->map(fn ($company) => count($company->branches))->sum();
        $this->total_invoice_amount = $this->companies
            ->groupBy(fn ($company) => $company->country->name)
            ->map(fn ($countryCompanies) => $countryCompanies->sum(
                fn ($company) =>
                $company->branches->sum(fn ($branch) => $branch->invoices->sum('total_amount'))
            ));
    }

    public function render()
    {
        return view('livewire.tables.reports.country-report-table');
    }
}
