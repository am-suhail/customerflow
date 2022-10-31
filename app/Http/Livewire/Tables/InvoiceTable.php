<?php

namespace App\Http\Livewire\Tables;

use Filament\Tables;
use Livewire\Component;

class InvoiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Post::query();
    }

    public function render()
    {
        return view('livewire.tables.invoice-table');
    }
}
