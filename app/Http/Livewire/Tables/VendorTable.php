<?php

namespace App\Http\Livewire\Tables;

use App\Models\Vendor;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class VendorTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Vendor::query();
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('index')
                ->label('#')
                ->rowIndex(),

            TextColumn::make('company_name')
                ->label('Company Name')
                ->toggleable()
                ->searchable()
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

            TextColumn::make('name')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('sex')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('nationality.name')
                ->limit(15)
                ->label('Nationality')
                ->toggleable()
                ->searchable()
                ->sortable(),

            TextColumn::make('mobile')
                ->label('Mobile')
                ->toggleable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->toggleable()
                ->searchable(),

            TextColumn::make('url')
                ->label('Website')
                ->toggleable()
                ->searchable(),

            TextColumn::make('telephone')
                ->label('Telephone')
                ->toggleable()
                ->searchable(),

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
        return 'company_name';
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
        return view('livewire.tables.vendor-table');
    }
}
