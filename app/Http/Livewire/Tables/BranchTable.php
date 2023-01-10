<?php

namespace App\Http\Livewire\Tables;

use App\Models\Branch;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class BranchTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Branch::query();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('index')
                ->label('#')
                ->rowIndex(),

            TextColumn::make('company.name')
                ->label('Company Name')
                ->limit(40)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('name')
                ->label('Branch Name')
                ->limit(40)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('code')
                ->label('Code')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('inc_date')
                ->getStateUsing(function (Branch $record) {
                    return Carbon::parse($record->inc_date ?? "")->format('d-m-Y');
                })
                ->label('Inc. Date')
                ->toggleable(),

            TextColumn::make('age')
                ->getStateUsing(function (Branch $record) {
                    return Carbon::parse($record->inc_date ?? "")->diffForHumans();
                })
                ->label('Age')
                ->toggleable(),

            TextColumn::make('building_size')
                ->label('Building Size')
                ->toggleable()
                ->sortable(),

            TextColumn::make('country.name')
                ->label('Country')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('city.name')
                ->label('City')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('telephone')
                ->label('Telephone')
                ->toggleable()
                ->searchable(),

            TextColumn::make('capital')
                ->label('Capital')
                ->toggleable(),

            TextColumn::make('total_shares')
                ->label('Total Shares')
                ->toggleable(),

            TextColumn::make('investment_amount')
                ->label('Investment Amount')
                ->toggleable(),

            TextColumn::make('investment_percentage')
                ->label('Investment Percentage')
                ->toggleable(),

            TextColumn::make('investment_shares')
                ->label('Investment Shares')
                ->toggleable(),

            TextColumn::make('remark')
                ->label('Remarks')
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
                    ->url(fn ($record) => route('branch.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete Branch')
                    ->modalSubheading('Are you sure you\'d like to delete this branch? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete branch'))
            ])
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'name';
    }

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
        return view('livewire.tables.branch-table');
    }
}
