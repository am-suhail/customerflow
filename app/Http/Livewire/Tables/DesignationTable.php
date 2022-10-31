<?php

namespace App\Http\Livewire\Tables;

use App\Models\Designation;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DesignationTable extends LivewireDatatable
{
    public $model = Designation::class;

    public function columns()
    {
        return [

            Column::name('name')
                ->searchable()
                ->editable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()
                ->unsortable()
                ->excludeFromExport()
        ];
    }
}
