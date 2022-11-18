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
        return Invoice::query()
            ->orderBy('number', 'desc');
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('number')
                ->toggleable()
                ->searchable(),

            TextColumn::make('date')
                ->label('Invoice Date')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->date)->format('d-m-Y'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('vendor.company_name')
                ->label('Company Name')
                ->limit(25)
                ->toggleable()
                ->searchable(),

            TextColumn::make('service')
                ->label('Services')
                ->getStateUsing(fn (Invoice $record) => $record->items->first()->service->subcategory->category->name)
                ->toggleable()
                ->searchable(),

            TextColumn::make('total_amount')
                ->label('Total Amount')
                ->toggleable()
                ->searchable(),

            TextColumn::make('createdBy')
                ->label('Created By')
                ->getStateUsing(fn (Invoice $record) => $record->activities->where('description', 'created')->first()->causer->name ?? "--")
                ->limit(12)
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
