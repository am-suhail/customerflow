<?php

namespace App\Http\Livewire\Tables;

use App\Models\ProjectEnquiry;
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

class ProjectEnquiryTable extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'date';

    public string $sortDirection = 'desc';

    protected $listeners = ['recordDeleted'];

    public function recordDeleted()
    {
        $this->fillData();
    }

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
        return ProjectEnquiry::query();
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
            ->addColumn('name', function (ProjectEnquiry $enquiry) {
                return Str::limit($enquiry->name ?? '--', 25, '...');
            })
            ->addColumn('date_formatted', function (ProjectEnquiry $enquiry) {
                return Carbon::parse($enquiry->date)->format('d-m-Y');
            })
            ->addColumn('code')
            ->addColumn('vendor_id', function (ProjectEnquiry $enquiry) {
                return Str::limit($enquiry->vendor->name ?? '--', 15, '...');
            })
            ->addColumn('city_state_name', function (ProjectEnquiry $enquiry) {
                return Str::limit($enquiry->city->state->name ?? '--', 15, '...');
            })
            ->addColumn('assigned_user_id', function (ProjectEnquiry $enquiry) {
                return Str::limit($enquiry->assigned_user->name ?? '--', 15, '...') ?? '<span class="text-red-500">unassigned</span>';
            })
            ->addColumn('status', function (ProjectEnquiry $enquiry) {
                switch ($enquiry->status) {
                    case ProjectEnquiry::ENQUIRY_COMPLETE:
                        $status = '<span class="px-1 bg-green-400 rounded">Completed</span>';
                        break;

                    case ProjectEnquiry::ENQUIRY_ON_PROCESS:
                        $status = '<span class="px-1 bg-yellow-400 rounded">On Process</span>';
                        break;

                    default:
                        $status = '<span class="px-1 bg-blue-500 rounded">Open</span>';
                        break;
                }

                return $status;
            })
            ->addColumn('user_id', function (ProjectEnquiry $enquiry) {
                return Str::limit($enquiry->user->name, 10, '...');
            })
            ->addColumn('updated_at_formatted', function (ProjectEnquiry $enquiry) {
                return Carbon::parse($enquiry->updated_at)->format('d-m-Y H:i:s');
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
                ->title(__('DATE'))
                ->field('date_formatted')
                ->searchable()
                ->sortable(),
            // ->makeInputDatePicker('date'),

            Column::add()
                ->title(__('CODE'))
                ->field('code')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('CUSTOMER'))
                ->field('vendor_id'),

            Column::add()
                ->title(__('NAME'))
                ->field('name')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('STATE'))
                ->field('city_state_name'),

            Column::add()
                ->title(__('STATUS'))
                ->field('status'),

            Column::add()
                ->title(__('TEAM LEADER'))
                ->field('assigned_user_id'),

            Column::add()
                ->title(__('CREATED BY'))
                ->field('user_id')
                ->searchable(),

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
            Button::add('quick-view')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.enquiry-quick-view-modal', ['record_id' => 'id']),

            Button::add('add-as-project')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500 hover:text-purple-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.convert-enquiry-to-project-modal', ['record_id' => 'id']),

            Button::add('edit')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                ')
                ->class('text-white')
                ->route('enquiry.edit', ['enquiry' => 'id'])
                ->target('_self'),

            Button::add('delete-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700 hover:text-red-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.delete-modal', ['model' => 'App\Models\ProjectEnquiry', 'record_id' => 'id']),
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
                ->route('enquiry.create', [])
                ->target('_self'),
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
           $updated = ProjectEnquiry::query()->find($data['id'])->update([
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
