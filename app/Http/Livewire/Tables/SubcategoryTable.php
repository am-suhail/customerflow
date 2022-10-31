<?php

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use App\Models\SubCategory;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SubcategoryTable extends LivewireDatatable
{
    public $model = SubCategory::class;

    public function columns()
    {
        return [
            Column::name('name')
                ->editable()
                ->searchable(),

            Column::name('category.name')
                ->label('Parent Category')
                ->filterable($this->category)
                ->searchable(),

            Column::callback(['id', 'name'], function ($value, $name) {
                return view('datatables::delete', ['value' => $value, 'name' => $name]);
            })
                ->alignCenter()
                ->unsortable()
                ->excludeFromExport()
        ];
    }

    public function getCategoryProperty()
    {
        return Category::all()->pluck('name');
    }
}
