<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Models\InvoiceItems;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class BankSummaryTable extends Component
{
    public $items;

    public $date, $user = NULL;

    public $filter_active = false;

    public function mount()
    {
        $this->report(Carbon::today());
    }

    public function filter()
    {
        $this->report($this->date);
        $this->filter_active = true;
    }

    public function clearFilter()
    {
        $this->report(Carbon::today());

        $this->filter_active = false;
    }

    public function render()
    {
        return view('livewire.tables.reports.bank-summary-table');
    }

    public function report($date, $user = NULL)
    {
        $items = InvoiceItems::whereBetween('created_at', [Carbon::parse($date)->startOfDay(), Carbon::parse($date)->endOfDay()])
            ->get();
        $items = $items->filter(fn ($item) => count($item->activities->where('description', 'created')) > 0);

        if (!is_null($user)) {
            $items = $items->filter(fn ($item) => $item->activities->last()->causer->id == $user);
        }

        $this->items = $items;
    }
}
