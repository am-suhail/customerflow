<?php

namespace App\Http\Livewire\Tables;

use App\Models\Invoice;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class InvoiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Invoice::query();
    }

    public function render()
    {
        return view('livewire.tables.invoice-table');
    }
}
