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

            TextColumn::make('name')
                ->toggleable()
                ->searchable(),

            TextColumn::make('sex')
                ->toggleable()
                ->searchable(),

            TextColumn::make('country.name')
                ->label('Nationality')
                ->toggleable()
                ->searchable(),

            TextColumn::make('mobile')
                ->label('Mobile')
                ->toggleable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->label('')
                ->toggleable()
                ->searchable(),

            TextColumn::make('company_name')
                ->label('Company Name')
                ->toggleable()
                ->searchable(),

            TextColumn::make('industry.name')
                ->label('Industry')
                ->toggleable()
                ->searchable(),

            TextColumn::make('vat')
                ->label('VAT')
                ->toggleable()
                ->searchable(),

            TextColumn::make('url')
                ->label('Website')
                ->toggleable()
                ->searchable(),

            TextColumn::make('city.state.name')
                ->label('State')
                ->toggleable()
                ->searchable(),

            TextColumn::make('city.name')
                ->label('City')
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

    public function render()
    {
        return view('livewire.tables.vendor-table');
    }
}
