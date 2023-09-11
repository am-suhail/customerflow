<?php

namespace App\Http\Livewire\Tables;

use App\Models\Company;
use App\Models\Branch;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Models\CustomerFlow;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class CustomerFlowTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return CustomerFlow::query();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('index')
                ->label('#')
                ->rowIndex(),

                TextColumn::make('branch.company.name')
                ->label('Company')
                ->limit(30)
                ->toggleable()
                ->searchable()
                ->sortable(),

                TextColumn::make('branch.name')
                ->label('Branch')
                ->limit(20)
                ->toggleable()
                ->searchable()
                ->sortable(),

                TextColumn::make('date')
                ->getStateUsing(function (CustomerFlow $record) {
                    return Carbon::parse($record->date ?? "")->format('d-m-Y');
                })
                ->label('Date')
                ->searchable()
                ->toggleable(),

            TextColumn::make('invoices')
                ->label('Invoices')
                ->searchable()
                ->toggleable(),

            TextColumn::make('loyalty_cards')
                ->label('Loyalty Cards')
                ->toggleable()
                ->searchable(),

          
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->url(fn ($record) => route('customer-flow.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete CustomerFlow')
                    ->modalSubheading('Are you sure you\'d like to delete this Customer Flow ? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete customer flow'))
            ])
        ];
    }

    // protected function getDefaultTableSortColumn(): ?string
    // {
    //     return 'branch.company.name';
    // }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }
    public function render()
    {
        return view('livewire.tables.customer-flow-table');
    }
}
