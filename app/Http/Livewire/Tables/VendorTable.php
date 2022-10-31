<?php

namespace App\Http\Livewire\Tables;

use App\Models\Vendor;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class VendorTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    public $model = Vendor::class;

    public function columns()
    {
        return [

            Column::name('name')
                ->searchable(),

            Column::name('country.name')
                ->label('Nationality')
                ->searchable(),

            NumberColumn::name('mobile')
                ->label('Mobile')
                ->searchable(),

            NumberColumn::name('email')
                ->label('Email')
                ->searchable(),

            Column::name('company_name')
                ->label('Company Name')
                ->searchable(),

            Column::name('industry.name')
                ->label('Industry')
                ->searchable(),

            Column::name('vat')
                ->label('VAT')
                ->searchable(),

            Column::name('url')
                ->label('Website')
                ->searchable(),

            Column::name('city.state.name')
                ->label('State')
                ->searchable(),

            Column::name('city.name')
                ->label('City')
                ->searchable(),

            NumberColumn::name('telephone')
                ->label('Telephone')
                ->searchable(),

            Column::name('remarks')
                ->label('Remarks')
                ->searchable(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('tables.general-table-actions', ['id' => $id, 'name' => $name, 'route' => 'vendor.edit']);
            })
                ->unsortable()
                ->excludeFromExport()
        ];
    }
}
