<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Branch;
use Livewire\Component;

class BranchReportTable extends Component
{
    public $branches,
        $total_branches,
        $total_invoices,
        $total_invoice_amount;

    public function mount()
    {
        $this->branches = Branch::whereHas('company')->get();

        $this->total_branches = $this->branches->count();
        $this->total_invoices = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices->sum(fn ($invoice) => $invoice->items->sum('tax'))
            ));
        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices->sum('total_amount')
            ));
    }

    public function render()
    {
        return view('livewire.tables.reports.branch-report-table');
    }
}
