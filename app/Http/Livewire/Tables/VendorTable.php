<?php

namespace App\Http\Livewire\Tables;

use App\Models\Vendor;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;

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

            TextColumn::make('company_name')
                ->label('Company Name')
                ->toggleable()
                ->searchable(),

            TextColumn::make('country.name')
                ->label('Country')
                ->toggleable()
                ->searchable(),

            TextColumn::make('city.name')
                ->label('City')
                ->toggleable()
                ->searchable(),

            TextColumn::make('name')
                ->toggleable()
                ->searchable(),

            TextColumn::make('sex')
                ->toggleable()
                ->searchable(),

            TextColumn::make('nationality.name')
                ->limit(15)
                ->label('Nationality')
                ->toggleable()
                ->searchable(),

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

            Column::make('Manage')
                ->view('tables.modals.vendor.actions')
                ->extraAttributes(['class' => 'justify-center']),
        ];
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
