<?php

namespace App\Http\Livewire\Tables;

use App\Models\State;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;

class StateTable extends LivewireDatatable
{
    public $model = State::class;
    public $number = 1;

    public function columns()
    {
        return [

            Column::name('name')
                ->defaultSort('asc')
                ->searchable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()
                ->unsortable()
                ->excludeFromExport()
        ];
    }
}
