<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Exports\BranchSummaryReportExport;
use App\Models\Branch;
use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class BranchReportTable extends Component
{
    public $branches,
        $total_branches,
        $branch_list,
        $selected_branch,
        $total_invoices,
        $total_expense_amount,
        $total_invoice_amount;

    public $start_date, $end_date;

    public $filter_active = false;

    public function mount()
    {
        $this->branches = Branch::whereHas('company')->get();
        $this->branch_list = $this->branches->pluck('name', 'id');
        $this->total_branches = $this->branches->count();

        $this->report();
    }

    public function filter()
    {
        $this->validate([
            'start_date' => 'nullable|required_with:end_date|date',
            'end_date'   => 'nullable|required_with:start_date|after_or_equal:start_date',
        ]);

        $this->report($this->start_date, $this->end_date, $this->selected_branch);
        $this->filter_active = true;
    }

    public function clearFilter()
    {
        $this->reset(
            'start_date',
            'end_date',
            'selected_branch'
        );

        $this->branches = Branch::whereHas('company')->get();
        $this->report();
        $this->filter_active = false;
    }

    public function excelExport()
    {
        return Excel::download(new BranchSummaryReportExport($this->branches, $this->total_invoices, $this->total_invoice_amount, $this->total_expense_amount), Carbon::now() . '_branch_report.xlsx');
    }

    public function render()
    {
        return view('livewire.tables.reports.branch-report-table');
    }

    public function report($start_date = null, $end_date = null, $branch = null)
    {
        $earliest_date = Invoice::min('date');
        $latest_date = Invoice::max('date');

        $start_date = $start_date ?? $earliest_date;
        $end_date = $end_date ?? $latest_date;

        if (!is_null($branch)) {
            $selected_branch = Branch::where('id', $branch)->get();

            $this->branches = $selected_branch;
        }

        // Invoice/Revenue
        $this->total_invoices = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum(fn ($invoice) => $invoice->items->sum('tax'))
            ));

        // $this->total_expense_amount = $this->branches
        //     ->groupBy(fn ($company) => $company->name)
        //     ->map(fn ($companyBranches) => $companyBranches->sum(
        //         fn ($branch) => $branch->expenses
        //             ->when($start_date && $end_date, fn ($query) => $query->whereBetween('accounting_date', [$start_date, $end_date]))
        //             ->sum()
        //     ));

        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum('total_amount')
            ));

        // Expense
        $this->total_expense_amount = $this->branches
            ->groupBy(fn ($company) => $company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->expenses
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('accounting_date', [$start_date, $end_date]))
                    ->sum('amount') +
                    $branch->expenses
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('accounting_date', [$start_date, $end_date]))
                    ->sum('tax')
            ));
    }
}
