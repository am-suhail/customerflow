<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;

class CompanyCategory extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Category::query()
            ->where('type', Category::TYPE_PRODUCT)
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

            TextColumn::make('sub_category_count')
                ->label('Sub Category Count')
                ->getStateUsing(fn ($record) => count($record->subcategories ?? 0)),
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
                            ->label('Category Name')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.company-category');
    }
}
