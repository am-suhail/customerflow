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

    public $start_date, $end_date;

    public $filter_active = false;

    public function mount()
    {
        $this->companies = Company::all();
        $this->branches = Branch::whereHas('company')->get();
        $this->total_branches = $this->branches->count();

        $this->report();
    }

    public function filter()
    {
        $this->report($this->start_date, $this->end_date);
        $this->filter_active = true;
    }

    public function clearFilter()
    {
        reset($this->start_date, $this->end_date);

        $this->report();
        $this->filter_active = false;
    }

    public function render()
    {
        return view('livewire.tables.reports.company-report-table');
    }

    public function report($start_date = null, $end_date = null)
    {
        $this->total_invoices = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(fn ($branch) => $branch->invoices->sum(fn ($invoice) => $invoice->items->sum('tax'))));
        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(fn ($branch) => $branch->invoices->sum('total_amount')));
    }
}
