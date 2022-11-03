<?php

namespace App\Http\Livewire\Tables;

use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;

class InvoiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Invoice::query();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('number')
                ->toggleable()
                ->searchable(),

            TextColumn::make('vendor.name')
                ->label('Vendor')
                ->toggleable()
                ->searchable(),

            TextColumn::make('date')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->date)->format('d-m-Y'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('serviceCount')
                ->label('Services')
                ->getStateUsing(fn (Invoice $record) => count($record->items))
                ->toggleable()
                ->searchable(),

            TextColumn::make('total_amount')
                ->label('Total Amount')
                ->toggleable()
                ->searchable(),

            Column::make('Manage')
                ->view('tables.modals.invoice.actions')
                ->extraAttributes(['class' => 'justify-center']),
        ];
    }

    public function render()
    {
        return view('livewire.tables.invoice-table');
    }
}
