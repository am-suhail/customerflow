<?php

namespace App\Http\Livewire\Tables;

use App\Models\Area;
use App\Models\Street;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class StreetTable extends LivewireDatatable
{
    public $model = Street::class;

    public function columns()
    {
        return [

            Column::name('name')
                ->defaultSort('asc')
                ->editable()
                ->searchable(),

            Column::name('area.name')
                ->label('Belonging Area')
                ->filterable($this->area)
                ->searchable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()

        ];
    }

    public function getAreaProperty()
    {
        return Area::all()->pluck('name');
    }
}
