<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;

class DailySummaryTable extends Component
{
    public $daily_summary;

    public function mount()
    {
        $this->daily_summary = Invoice::all();
        // ->groupBy(function ($data) {
        //     return Carbon::parse($data->created_at)->format('d-m-Y');
        // });
    }

    public function render()
    {
        return view('livewire.tables.reports.daily-summary-table');
    }
}
