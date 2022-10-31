<?php

namespace App\Http\Livewire\Tables;

use App\Models\City;
use App\Models\State;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;

class CityTable extends LivewireDatatable
{
    public $model = City::class;

    public $exportable = true;

    public function columns()
    {
        return [

            Column::name('name')
                ->label('City')
                ->defaultSort('asc')
                ->editable()
                ->searchable(),

            Column::name('state.name')
                ->label('Belonging State')
                ->filterable($this->state)
                ->searchable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()
                ->unsortable()
                ->excludeFromExport()

        ];
    }

    public function getStateProperty()
    {
        return State::all()->pluck('name');
    }
}
