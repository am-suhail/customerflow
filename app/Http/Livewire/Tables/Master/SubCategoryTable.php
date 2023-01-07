<?php

namespace App\Http\Livewire\Tables\Master;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;

class SubCategoryTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public $sub_category_type;

    protected $listeners = ['refreshLivewireDatatable' => '$refresh'];

    public function mount($sub_category_type)
    {
        $this->sub_category_type = $sub_category_type;
    }

    protected function getTableQuery(): Builder
    {
        $sub_category_type = $this->sub_category_type;

        return SubCategory::query()
            ->whereHas('category', function ($query) use ($sub_category_type) {
                return $query->where('type', $sub_category_type);
            })
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

            TextColumn::make('category.name')
                ->label('Parent Category')
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
                        'category_id' => $record->category_id,
                        'name' => $record->name,
                    ]))
                    ->form([
                        Select::make('category_id')
                            ->label('Parent Category')
                            ->options(Category::query()->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('name')
                            ->label('Sub Category')
                            ->required(),
                    ]),

                DeleteAction::make('delete')
                    ->label("Delete")
            ])
        ];
    }

    public function render()
    {
        return view('livewire.tables.master.sub-category-table');
    }
}
