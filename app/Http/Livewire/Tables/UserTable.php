<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserTable extends LivewireDatatable
{
    public $hideable = 'select';

    public function builder()
    {
        return User::where('profile', '!=', 1991);
    }

    public function columns()
    {
        return [

            Column::name('name')
                ->label('Full Name')
                ->searchable(),

            NumberColumn::name('mobile')
                ->label('Mobile')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->searchable(),

            DateColumn::name('user_detail.dob')
                ->label('D.O.B')
                ->searchable(),

            Column::name('user_detail.sex')
                ->label('Sex')
                ->filterable(['Male', 'Female'])
                ->searchable(),

            Column::name('user_detail.national_id')
                ->label('National ID')
                ->searchable(),

            Column::name('user_detail.national_id_expiry')
                ->label('NID Expiry'),

            Column::name('user_detail.building_name')
                ->label('Building')
                ->searchable(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('tables.user-table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
                ->unsortable()
                ->excludeFromExport()

        ];
    }
}
