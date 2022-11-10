<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Exports\UserSummaryReport;
use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class UserSummaryTable extends Component
{
    public $invoices;

    public $date;

    public $filter_active = false;

    public function mount()
    {
        $this->invoices = Invoice::all();
    }

    public function filter()
    {
        $date = $this->date;

        $this->invoices =   Invoice::whereBetween('created_at', [Carbon::parse($date)->startOfDay(), Carbon::parse($date)->endOfDay()])->get();

        $this->filter_active = true;
    }

    public function clearFilter()
    {
        unset($this->date);

        $this->invoices = Invoice::all();

        $this->filter_active = false;
    }

    public function excelExport()
    {
        return Excel::download(new UserSummaryReport($this->invoices), Carbon::now() . '_user_summary_report.xlsx');
    }

    public function render()
    {
        return view('livewire.tables.reports.user-summary-table');
    }
}
