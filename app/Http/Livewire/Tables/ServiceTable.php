<?php

namespace App\Http\Livewire\Tables;

use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use Illuminate\Support\Str;

class ServiceTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->showRecordCount('full')
            ->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Builder
    {
        return Service::query()->with('subcategory', 'subcategory.category');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('name_limited', function (Service $model) {
                return Str::limit($model->name, 50, '...');
            })
            ->addColumn('code')
            ->addColumn('category', function (Service $model) {
                return $model->subcategory->category->name ?? '--';
            })
            ->addColumn('category_limited', function (Service $model) {
                return Str::limit($model->subcategory->category->name ?? '--', 10, '...');
            })
            ->addColumn('sub_category', function (Service $model) {
                return $model->subcategory->name ?? '--';
            })
            ->addColumn('unit_name', function (Service $model) {
                return Str::upper($model->unit->name);
            })
            ->addColumn('selling_price')
            ->addColumn('cost_one')
            ->addColumn('cost_one_desc')
            ->addColumn('cost_two')
            ->addColumn('cost_two_desc')
            ->addColumn('total_cost', fn (Service $model) => $model->cost_one + $model->cost_two)
            ->addColumn('gross_profit', fn (Service $model) => $model->selling_price - ($model->cost_one + $model->cost_two))
            ->addColumn('created_at_formatted', function (Service $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function (Service $model) {
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */
    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id')
                ->hidden(),

            Column::add()
                ->title(__('SERVICE NAME'))
                ->field('name')
                ->hidden(),

            Column::add()
                ->title(__('NAME'))
                ->field('name_limited', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->visibleInExport(false),

            Column::add()
                ->title(__('CATEGORY'))
                ->field('category')
                ->hidden(),

            Column::add()
                ->title(__('SUB CATEGORY'))
                ->field('sub_category'),

            Column::add()
                ->title(__('SELLING PRICE'))
                ->field('selling_price')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('TOTAL COST'))
                ->field('total_cost')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('GROSS PROFIT'))
                ->field('gross_profit')
                ->sortable()
                ->searchable(),

            // Column::add()
            //     ->title(__('COST ONE DESCRIPTION'))
            //     ->field('cost_one_desc')
            //     ->sortable()
            //     ->searchable(),

            // Column::add()
            //     ->title(__('COST two'))
            //     ->field('cost_two')
            //     ->sortable()
            //     ->searchable(),

            // Column::add()
            //     ->title(__('COST two DESCRIPTION'))
            //     ->field('cost_two_desc')
            //     ->sortable()
            //     ->searchable(),

            // Column::add()
            //     ->title(__('COMMENT'))
            //     ->field('comment')
            //     ->hidden(),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at_formatted')
                ->hidden(),

            Column::add()
                ->title(__('UPDATED AT'))
                ->field('updated_at_formatted')
                ->hidden(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    public function actions(): array
    {
        return [
            Button::add('edit')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                ')
                ->class('text-white')
                ->route('service.edit', ['service' => 'id'])
                ->target('_self'),

            Button::add('delete-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700 hover:text-red-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.redirect-after-delete-modal', ['model' => 'App\Models\Service', 'record_id' => 'id', 'route' => 'service.index']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Service::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }
    */

    public function template(): ?string
    {
        return null;
    }
}
