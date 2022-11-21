<?php

namespace App\Http\Livewire\Tables;

use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;

class InvoiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Invoice::query()
            ->with('activities', 'activities.causer', 'items', 'items.subcategory')
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

            TextColumn::make('vendor.country.name')
                ->label('Country')
                ->limit(25)
                ->toggleable()
                ->searchable(),

            TextColumn::make('vendor.city.state.name')
                ->label('State')
                ->limit(25)
                ->toggleable()
                ->searchable(),

            TextColumn::make('vendor.city.name')
                ->label('City')
                ->limit(25)
                ->toggleable()
                ->searchable(),

            TextColumn::make('service')
                ->label('Category')
                ->getStateUsing(fn (Invoice $record) =>  $record->items->first()->subcategory->category->name ?? "--")
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
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                ViewAction::make('view')
                    ->label("View")
                    ->color('secondary')
                    ->url(fn ($record) => route('revenue.show', $record->id))
                    ->openUrlInNewTab(),

                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->url(fn ($record) => route('revenue.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete Revenue Input')
                    ->modalSubheading('Are you sure you\'d like to delete this input? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete revenue'))
            ])
        ];
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.tables.invoice-table');
    }
}
