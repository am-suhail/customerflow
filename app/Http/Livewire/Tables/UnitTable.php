<?php

namespace App\Http\Livewire\Tables;

use App\Models\Unit;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UnitTable extends LivewireDatatable
{
    public $model = Unit::class;

    public function columns()
    {
        return [

            Column::name('name')
                ->editable()
                ->searchable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()
                ->unsortable()
                ->excludeFromExport()
        ];
    }
}
