<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;

class CityTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return City::query();
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('state.name')
                ->label('Belongs to State')
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
                    ->mountUsing(fn (ComponentContainer $form, $record) => $form->fill([
                        'state_id' => $record->state_id,
                        'name' => $record->name,
                    ]))
                    ->form([
                        Select::make('state_id')
                            ->label('Belongs to State')
                            ->options(State::query()->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('name')
                            ->label('City')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.city-table');
    }
}
