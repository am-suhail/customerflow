<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class StateTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return State::query()
            ->orderBy('name');
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('country.name')
                ->label('Belongs to Country')
                ->searchable(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('no_of_cities')
                ->label('Total Cities')
                ->getStateUsing(fn ($record) => count($record->cities ?? 0))
                ->searchable(),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make('edit')
                    ->label("Edit")
                    ->color('primary')
                    ->modalHeading(fn ($record) => "Edit " . $record->name)
                    ->form([
                        Select::make('country_id')
                            ->label('Belongs to Country')
                            ->options(Country::query()->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('name')
                            ->label('State Name')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.state-table');
    }
}
