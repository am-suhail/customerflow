<?php

namespace App\Http\Livewire\Tables\Reports;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class UserSummaryTable extends Component
{
    public $invoices;

    public function mount()
    {
        $this->invoices = Activity::where('description', 'created')
            ->where('subject_type', 'App\Models\Invoice')
            ->get();
    }

    public function render()
    {
        return view('livewire.tables.reports.user-summary-table');
    }
}
