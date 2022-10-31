<?php

namespace App\Http\Livewire\Tables;

use App\Models\Vendor;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class CustomerTable extends PowerGridComponent
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
        $this->showCheckBox()
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
        return Vendor::query();
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
            ->addColumn('code')
            ->addColumn('vat')
            ->addColumn('industry_id')
            ->addColumn('building_name')
            ->addColumn('city_id')
            ->addColumn('area')
            ->addColumn('street')
            ->addColumn('telephone')
            ->addColumn('email')
            ->addColumn('website')
            ->addColumn('contact_name')
            ->addColumn('contact_number')
            ->addColumn('contact_email')
            ->addColumn('remarks')
            ->addColumn('created_at_formatted', function(Vendor $model) { 
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function(Vendor $model) { 
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
                ->makeInputRange(),

            Column::add()
                ->title(__('NAME'))
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CODE'))
                ->field('code')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('VAT'))
                ->field('vat')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('INDUSTRY ID'))
                ->field('industry_id')
                ->makeInputRange(),

            Column::add()
                ->title(__('BUILDING NAME'))
                ->field('building_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CITY ID'))
                ->field('city_id')
                ->makeInputRange(),

            Column::add()
                ->title(__('AREA'))
                ->field('area')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('STREET'))
                ->field('street')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('TELEPHONE'))
                ->field('telephone')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('EMAIL'))
                ->field('email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('WEBSITE'))
                ->field('website')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CONTACT NAME'))
                ->field('contact_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CONTACT NUMBER'))
                ->field('contact_number')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CONTACT EMAIL'))
                ->field('contact_email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('REMARKS'))
                ->field('remarks')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title(__('UPDATED AT'))
                ->field('updated_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('updated_at'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('vendor.edit', ['vendor' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('vendor.destroy', ['vendor' => 'id'])
               ->method('delete')
        ];
    }
    */

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
           $updated = Vendor::query()->find($data['id'])->update([
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
