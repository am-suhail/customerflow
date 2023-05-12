<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Branch;
use App\Models\Invoice;
use Livewire\Component;

class BranchReportTable extends Component
{
    public $branches,
        $total_branches,
        $total_invoices,
        $total_invoice_amount;

    public $start_date, $end_date;

    public $filter_active = false;

    public function mount()
    {
        $this->branches = Branch::whereHas('company')->get();
        $this->total_branches = $this->branches->count();

        $this->report();
    }

    public function filter()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date'  => 'required|after_or_equal:start_date'
        ]);

        $this->report($this->start_date, $this->end_date);
        $this->filter_active = true;
    }

    public function clearFilter()
    {
        $this->reset(
            'start_date',
            'end_date'
        );

        $this->report();
        $this->filter_active = false;
    }

    public function render()
    {
        return view('livewire.tables.reports.branch-report-table');
    }

    public function report($start_date = null, $end_date = null)
    {
        $earliest_date = Invoice::min('date');
        $latest_date = Invoice::max('date');

        $start_date = $start_date ?? $earliest_date;
        $end_date = $end_date ?? $latest_date;

        $this->total_invoices = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum(fn ($invoice) => $invoice->items->sum('tax'))
            ));

        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum('total_amount')
            ));
    }
}
