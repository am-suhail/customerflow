<?php

namespace App\Http\Livewire\Tables;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ViewColumn;

class ServiceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Service::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->toggleable(),

            TextColumn::make('subcategory.name')
                ->label('Sub Category')
                ->searchable()
                ->toggleable(),

            TextColumn::make('selling_price')
                ->label('Selling Price'),

            TextColumn::make('totalCost')
                ->getStateUsing(function (Service $record) {
                    return $record->cost_one + $record->cost_two;
                })->label('Total Cost'),

            TextColumn::make('grossProfit')
                ->getStateUsing(function (Service $record) {
                    return $record->selling_price - ($record->cost_one + $record->cost_two);
                })->label('Gross Profit'),

            Column::make('Manage')
                ->view('tables.modals.service.actions')
                ->extraAttributes(['class' => 'justify-center']),

        ];
    }

    // protected function getTableActions(): array
    // {
    //     return [
    //         EditAction::make('edit')
    //             ->url(fn (Service $record): string => route('service.edit', $record))
    //             ->extraAttributes(['class' => 'text-blue-500']),
    //     ];
    // }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.tables.service-table');
    }
}
