<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class UserTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return User::query()->where('admin', false);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->toggleable(),

            TextColumn::make('user_detail.dob')
                ->getStateUsing(function (User $record) {
                    return Carbon::parse($record->user_detail->dob ?? "")->format('d-m-Y');
                })
                ->label('DOB')
                ->searchable()
                ->toggleable(),

            TextColumn::make('user_detail.sex')
                ->label('Sex')
                ->searchable()
                ->toggleable(),

            TextColumn::make('user_detail.country.name')
                ->label('Nationality')
                ->searchable()
                ->toggleable(),

            TextColumn::make('sign_up')
                ->label('Signed Up')
                ->getStateUsing(function (User $record) {
                    return Carbon::parse($record->created_at)->format('d-m-Y');
                })
                ->toggleable(),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('appoint-employee')
                    ->label('Appoint as Employee')
                    ->icon('heroicon-o-user-add')
                    ->color('primary')
                    ->url(fn ($record) => route('employee.appoint', $record->id))
                    ->visible(fn ($record) => !$record->employee),

                Action::make('manage-roles')
                    ->label('Manage Roles')
                    ->icon('heroicon-o-adjustments')
                    ->color('warning')
                    ->url(fn ($record) => route('user.manage', $record->id))
                    ->visible(fn ($record) => $record->employee),

                Action::make('manage-roles')
                    ->label('Suspend User')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->url(fn ($record) => route('user.manage', $record->id))
            ])
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'name';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }

    public function render()
    {
        return view('livewire.tables.user-table');
    }
}
