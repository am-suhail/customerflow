<?php

namespace App\Http\Livewire\Tables\Master;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class RolesTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Role::query()
            ->where('name', '!=', 'Super Admin')
            ->orderBy('name');
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('no_of_permissions')
                ->label('Permissions Count')
                ->getStateUsing(fn ($record) => count($record->permissions ?? 0)),

            TextColumn::make('no_of_users')
                ->label('Users with Roles')
                ->getStateUsing(fn ($record) => count($record->users ?? 0)),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->url(fn ($record): string => route('roles.edit', $record)),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.roles-table');
    }
}
