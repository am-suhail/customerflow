<?php

namespace App\Http\Livewire\Tables;

use App\Models\Qualification;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class QualificationTable extends LivewireDatatable
{
    public $model = Qualification::class;

    public function columns()
    {
        return [

            Column::name('name')
                ->editable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })->alignCenter()
                ->unsortable()
                ->excludeFromExport()

        ];
    }
}
