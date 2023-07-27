<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\RevenueType;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;

class RevenueTypeTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $listeners = ['refreshLivewireDatatable' => '$refresh'];

    protected function getTableQuery(): Builder
    {
        return RevenueType::query()
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
                            ->label('Revenue Type')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.revenue-type-table');
    }
}
