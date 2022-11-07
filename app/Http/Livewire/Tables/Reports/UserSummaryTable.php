<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class UserSummaryTable extends Component
{
    public $invoices;

    public $date;

    public function mount()
    {
        $this->invoices = Invoice::all();
    }

    public function filter()
    {
        $date = $this->date;

        $this->invoices =   Invoice::whereBetween('created_at', [Carbon::parse($date)->startOfDay(), Carbon::parse($date)->endOfDay()])->get();
    }

    public function render()
    {
        return view('livewire.tables.reports.user-summary-table');
    }
}
