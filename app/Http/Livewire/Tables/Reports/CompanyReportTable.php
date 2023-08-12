<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Exports\CompanySummaryReportExport;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

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
        $this->reset('start_date', 'end_date');

        $this->report();
        $this->filter_active = false;
    }

    public function excelExport()
    {
        return Excel::download(new CompanySummaryReportExport($this->companies, $this->total_invoices, $this->total_invoice_amount), Carbon::now() . '_company_report.xlsx');
    }

    public function render()
    {
        return view('livewire.tables.reports.company-report-table');
    }

    public function report($start_date = null, $end_date = null, $company = null)
    {
        $earliest_date = Invoice::min('date');
        $latest_date = Invoice::max('date');

        $start_date = $start_date ?? $earliest_date;
        $end_date = $end_date ?? $latest_date;

        $this->total_invoices = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum(fn ($invoice) => $invoice->items->sum('tax'))
            ));

        $this->total_invoice_amount = $this->branches
            ->groupBy(fn ($branch) => $branch->company->name)
            ->map(fn ($companyBranches) => $companyBranches->sum(
                fn ($branch) => $branch->invoices
                    ->when($start_date && $end_date, fn ($query) => $query->whereBetween('date', [$start_date, $end_date]))
                    ->sum('total_amount')
            ));
    }
}
