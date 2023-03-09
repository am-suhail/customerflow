<?php

namespace App\Http\Livewire\Tables;

use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class CompanyTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Company::query();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('index')
                ->label('#')
                ->rowIndex(),

            TextColumn::make('sub_category.category.name')
                ->label('Category')
                ->limit(40)
                ->toggleable(),

            TextColumn::make('sub_category.name')
                ->label('Sub Category')
                ->limit(40)
                ->toggleable()
                ->sortable(),

            TextColumn::make('name')
                ->label('Company Name')
                ->limit(40)
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('total_branches')
                ->label('Branches')
                ->getStateUsing(function (Company $record) {
                    return count($record->branches);
                })
                ->toggleable(),

            TextColumn::make('inc_date')
                ->getStateUsing(function (Company $record) {
                    return Carbon::parse($record->inc_date ?? "")->format('d-m-Y');
                })
                ->label('Inc. Date')
                ->searchable()
                ->toggleable(),

            TextColumn::make('inc_number')
                ->label('Inc. No')
                ->searchable()
                ->toggleable(),

            TextColumn::make('industry.name')
                ->label('Industry')
                ->toggleable()
                ->searchable(),

            TextColumn::make('tax_number')
                ->label('VAT/GST')
                ->toggleable()
                ->searchable(),

            TextColumn::make('telephone')
                ->label('Telephone')
                ->toggleable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->toggleable()
                ->searchable(),

            TextColumn::make('website')
                ->label('Website')
                ->toggleable()
                ->searchable(),

            TextColumn::make('remark')
                ->label('Remarks')
                ->limit(25)
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
                    ->url(fn ($record) => route('company.edit', $record->id)),

                DeleteAction::make("delete")
                    ->label("Delete")
                    ->modalHeading('Delete Company')
                    ->modalSubheading('Are you sure you\'d like to delete this Company? This cannot be undone.')
                    ->visible(fn () => auth()->user()->can('delete company'))
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
        return view('livewire.tables.company-table');
    }
}
