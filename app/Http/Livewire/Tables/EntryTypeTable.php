<?php

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TransactionEntryType;
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
use Filament\Forms\ComponentContainer;

class EntryTypeTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $listeners = ['refreshLivewireDatatable' => '$refresh'];

    protected function getTableQuery(): Builder
    {
        return TransactionEntryType::query()
            ->orderBy('name');
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('#')
                ->rowIndex(),

            TextColumn::make('sub_category.name')
                ->label('Sub Category')
                ->sortable()
                ->searchable(),

            TextColumn::make('name')
                ->label('Entry Type')
                ->sortable()
                ->searchable(),

            TextColumn::make('created_at')
                ->label('Created On')
                ->getStateUsing(fn (TransactionEntryType $record) => Carbon::parse($record->created_at)->format('d-m-Y | h:i:s A'))
                ->toggleable()
                ->searchable(),

            TextColumn::make('updated_at')
                ->label('Updated On')
                ->getStateUsing(fn (TransactionEntryType $record) => Carbon::parse($record->updated_at)->format('d-m-Y | h:i:s A'))
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
                    ->mountUsing(fn (ComponentContainer $form, $record) => $form->fill([
                        'sub_category_id' => $record->sub_category_id,
                        'name' => $record->name,
                    ]))
                    ->form([
                        Select::make('sub_category_id')
                            ->label('Sub Category')
                            ->options(SubCategory::query()
                                ->whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
                                ->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('name')
                            ->label('Expense Type Name')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.entry-type-table');
    }
}
