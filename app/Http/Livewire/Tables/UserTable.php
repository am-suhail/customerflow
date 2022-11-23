<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ViewColumn;

class UserTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return User::query()->where('profile', '!=', 1991);
    }

    protected function getTableColumns(): array
    {
        return [
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

            Column::make('Manage')
                ->view('tables.modals.user.actions')
                ->extraAttributes(['class' => 'justify-center']),

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
