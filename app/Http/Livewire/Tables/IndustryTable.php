<?php

namespace App\Http\Livewire\Tables;

use App\Models\Industry;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class IndustryTable extends LivewireDatatable
{
    public $model = Industry::class;

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
