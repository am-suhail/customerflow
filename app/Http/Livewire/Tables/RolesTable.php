<?php

namespace App\Http\Livewire\Tables;

use Mediconesystems\LivewireDatatables\Column;
use Spatie\Permission\Models\Role;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class RolesTable extends LivewireDatatable
{
    public $model = Role::class;

    public function columns()
    {
        return [

            Column::callback('name', function ($name) {
                return Str::upper($name);
            })
                ->label('Role'),

            NumberColumn::name('permissions.id:count')
                ->label('Permissions Count')
                ->alignCenter(),

            NumberColumn::name('users.id:count')
                ->label('Users with the Role')
                ->alignCenter(),

            DateColumn::name('updated_at')
                ->label('Last Updated')
                ->alignCenter(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('tables.general-rud-actions', [
                    'id' => $id,
                    'name' => $name,
                    'route' => 'roles.edit',
                    'view_route' => 'roles.show'
                ]);
            }),

        ];
    }
}
