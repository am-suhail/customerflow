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
            ->with('activities', 'activities.causer', 'items', 'items.subcategory');
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('number')
                ->label('Ref Number')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('date')
                ->label('Revenue Date')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->date)->format('d-m-Y'))
                ->toggleable(),

            TextColumn::make('vendor.company_name')
                ->label('Branch')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('vendor.country.name')
                ->label('Country')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('vendor.city.state.name')
                ->label('Zone/District')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('vendor.city.name')
                ->label('City')
                ->limit(25)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('total_amount')
                ->label('Total Amount')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('createdBy')
                ->label('Created By')
                ->getStateUsing(fn (Invoice $record) => $record->activities->where('description', 'created')->first()->causer->name ?? "--")
                ->limit(12)
                ->toggleable(),

            TextColumn::make('created_at')
                ->label('Created On')
                ->getStateUsing(fn (Invoice $record) => Carbon::parse($record->created_at)->format('d-m-Y | h:i:s A'))
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

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'number';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
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
