<?php

namespace App\Http\Livewire\Tables;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;

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
            TextColumn::make('name'),
            TextColumn::make('subcategory.name'),
            TextColumn::make('selling_price'),
            // TextColumn::make('totalCost')
            //     ->getStateUsing(function (Model $record) {
            //         dd($record);
            //         // return $service->cost_one + $service->cost_two;
            //     })->label('Total Cost'),
        ];
    }

    public function render()
    {
        return view('livewire.tables.service-table');
    }
}
