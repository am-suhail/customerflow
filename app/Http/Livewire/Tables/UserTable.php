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
        return User::where('profile', '!=', 'super_admin');
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

            Column::name('user_detail.nid')
                ->label('National ID')
                ->searchable(),

            Column::name('user_detail.nid_expiry')
                ->label('NID Expiry'),

            Column::name('user_detail.building_name')
                ->label('Building')
                ->searchable(),

            Column::name('user_detail.city.name')
                ->label('City'),

            Column::name('user_detail.area')
                ->label('Area'),

            Column::name('user_detail.street')
                ->label('street'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('tables.user-table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
                ->unsortable()
                ->excludeFromExport()

        ];
    }
}
