<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Branch;
use App\Models\Company;
use Livewire\Component;

class CompanyReportTable extends Component
{
    public $companies,
        $branches,
        $total_branches,
        $total_invoices,
        $total_invoice_amount;

    public function mount()
    {
        $this->companies = Company::all();
        $this->branches = Branch::whereHas('company')->get();

        $this->total_branches = $this->branches->count();
        $this->total_invoices = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(fn ($branch) => count($branch->invoices)));
        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(fn ($branch) => $branch->invoices->sum('total_amount')));
    }

    public function render()
    {
        return view('livewire.tables.reports.company-report-table');
    }
}
