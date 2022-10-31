<?php

namespace App\Http\Livewire\Tables;

use App\Models\MarketLead;
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

final class MarketLeadsTable extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'date';

    public string $sortDirection = 'desc';

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    protected $listeners = ['newRecord' => '$refresh'];

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showCheckBox()
            ->showRecordCount('full')
            ->showPerPage()
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv']);
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
        return MarketLead::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'user' => [
                'name'
            ],
            'country' => [
                'name'
            ]
        ];
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
            ->addColumn('name', function(MarketLead $model) {
                return Str::limit($model->name, 30, '..');
            })
            ->addColumn('designation')
            ->addColumn('company_name', function (MarketLead $model) {
                return Str::limit($model->company_name, 10, '..');
            })
            ->addColumn('email')
            ->addColumn('mobile')
            ->addColumn('landline')
            ->addColumn('alternate_number')
            ->addColumn('country_name', function (MarketLead $model) {
                return $model->country->name;
            })
            ->addColumn('city_id')
            ->addColumn('area')
            ->addColumn('street')
            ->addColumn('address')
            ->addColumn('user_id_name', function (MarketLead $model) {
                return Str::limit(Str::upper($model->user->name ?? 'NA'), 10, '...');
            })
            ->addColumn('date_formatted', function (MarketLead $model) {
                return Carbon::parse($model->date)->format('d-m-Y');
            })
            ->addColumn('product_presented', function (MarketLead $model) {
                if ($model->demo_presented == 1) {
                    return
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>';
                } else {
                    return
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>';
                }
            })
            ->addColumn('product_feedback')
            ->addColumn('product_name', function (MarketLead $model) {
                return Str::limit($model->sub_category->name ?? 'NA', 10, '..');
            })
            ->addColumn('remarks')
            ->addColumn('created_at_formatted', function (MarketLead $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function (MarketLead $model) {
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

    /**
     * PowerGrid Columns.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->hidden(),

            Column::add()
                ->title('DATE')
                ->field('date_formatted', 'date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('date'),

            Column::add()
                ->title('NAME')
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('DESIGNATION')
                ->field('designation')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('NATIONALITY')
                ->field('country_name', 'country_id')
                ->makeInputText(),

            Column::add()
                ->title('COMPANY')
                ->field('company_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('PRODUCT')
                ->field('product_name')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('EXECUTIVE')
                ->field('user_id_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('EMAIL')
                ->field('email')
                ->hidden(),

            Column::add()
                ->title('MOBILE')
                ->field('mobile')
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('LANDLINE')
                ->field('landline')
                ->hidden(),

            Column::add()
                ->title('ALTERNATE NUMBER')
                ->field('alternate_number')
                ->hidden(),

            Column::add()
                ->title('CITY ID')
                ->field('city_name')
                ->hidden(),

            Column::add()
                ->title('AREA')
                ->field('area')
                ->hidden(),

            Column::add()
                ->title('STREET')
                ->field('street')
                ->hidden(),

            Column::add()
                ->title('ADDRESS')
                ->field('address')
                ->hidden(),

            Column::add()
                ->title('DEMO')
                ->field('product_presented'),

            Column::add()
                ->title('REMARKS')
                ->field('remarks')
                ->hidden(),

            Column::add()
                ->title('CREATED AT')
                ->field('created_at_formatted', 'created_at')
                ->hidden(),

            Column::add()
                ->title('UPDATED AT')
                ->field('updated_at_formatted', 'updated_at')
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

    /**
     * PowerGrid MarketLead action buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

    public function actions(): array
    {
        return [
            Button::add('show-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.view-market-lead-modal', ['lead' => 'id']),

            Button::add('edit')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                ')
                ->class('text-white')
                ->route('leads.edit', ['lead' => 'id'])
                ->target('_self'),

            Button::add('delete-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700 hover:text-red-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.delete-modal', ['model' => 'App\Models\MarketLead', 'record_id' => 'id']),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('show-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Add New
              ')
                ->class('btn btn-outline btn-primary btn-sm')
                ->route('leads.create', [])
                ->target('_self'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

    /**
     * PowerGrid MarketLead Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = MarketLead::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}
