<?php

namespace App\Http\Livewire\Tables;

use App\Models\EmployeeDetail;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ViewColumn;

class EmployeesTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return EmployeeDetail::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')
                ->label('Name')
                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('user.user_detail.dob')
                ->getStateUsing(function (EmployeeDetail $record) {
                    return Carbon::parse($record->user->user_detail->dob ?? '')->format('d-m-Y');
                })
                ->label('DOB')
                ->toggleable(),

            TextColumn::make('user.user_detail.sex')
                ->label('Sex')
                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('user.user_detail.country.name')
                ->limit(15)
                ->label('Nationality')
                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('designation.name')
                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('joining_date')
                ->getStateUsing(function (EmployeeDetail $record) {
                    return Carbon::parse($record->joining_date)->format('d-m-Y');
                })
                ->label('Joining Date')
                ->searchable()
                ->toggleable(),

            TextColumn::make('user.user_detail.national_id')
                ->label('National ID')
                ->searchable()
                ->toggleable(),

            TextColumn::make('id_expiry')
                ->label('National ID Expiry')
                ->getStateUsing(function (EmployeeDetail $record) {
                    return Carbon::parse($record->user->user_detail->national_id_expiry ?? '')->format('d-m-Y');
                })
                ->toggleable(),

            TextColumn::make('user.mobile')
                ->searchable()
                ->toggleable(),

            Column::make('Manage')
                ->view('tables.modals.employee.actions')
                ->extraAttributes(['class' => 'justify-center']),

        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'user.name';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }

    public function render()
    {
        return view('livewire.tables.employees-table');
    }
}
