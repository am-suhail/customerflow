<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\TaxOption;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TaxTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $listeners = ['refreshLivewireDatatable' => '$refresh'];

    protected function getTableQuery(): Builder
    {
        return TaxOption::query()
            ->orderBy('name');
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('value')
                ->label('Percentage')
                ->sortable()
                ->searchable(),

            TextColumn::make('created_at')
                ->label('Created On')
                ->getStateUsing(fn (TaxOption $record) => Carbon::parse($record->created_at)->format('d-m-Y | h:i:s A'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('updated_at')
                ->label('Updated On')
                ->getStateUsing(fn (TaxOption $record) => Carbon::parse($record->updated_at)->format('d-m-Y | h:i:s A'))
                ->toggleable()
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
                        TextInput::make('name')
                            ->label('Tax Type Name')
                            ->required(),

                        TextInput::make('value')
                            ->label('Percentage')
                            ->numeric()
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.tax-table');
    }
}
