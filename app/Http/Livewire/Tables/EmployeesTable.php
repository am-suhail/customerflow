<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EmployeesTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return User::whereProfile('employee');
    }

    public function columns()
    {
        return [

            Column::name('name')
                ->label('Employee Name')
                ->searchable(),

            NumberColumn::name('mobile')
                ->label('Mobile')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->searchable()
                ->hide(),

            Column::name('user_detail.nid')
                ->label('National ID')
                ->searchable(),

            Column::name('user_detail.nid_expiry')
                ->label('NID Expiry')
                ->hide(),

            Column::name('employee_detail.code')
                ->label('Employee Code'),

            Column::name('employee_detail.designation.name')
                ->label('Designation'),

            DateColumn::name('employee_detail.joining_date')
                ->label('Joined On')
                ->hide(),

            NumberColumn::name('employee_detail.salary')
                ->label('Salary')
                ->searchable(),

            Column::name('user_detail.building_name')
                ->label('Building')
                ->searchable(),

            Column::name('user_detail.city.state.name')
                ->label('State')
                ->hide(),

            Column::name('user_detail.city.name')
                ->label('City')
                ->hide(),

            Column::name('user_detail.area')
                ->label('Area'),

            Column::name('user_detail.street')
                ->label('Street'),

            // Column::callback(['id', 'name'], function ($id, $name) {
            //     return view('tables.user-table-actions', ['id' => $id, 'name' => $name]);
            // })->unsortable(),

        ];
    }
}
