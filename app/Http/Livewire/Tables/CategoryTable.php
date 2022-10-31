<?php

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CategoryTable extends LivewireDatatable
{
    public $model = Category::class;

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
