<?php

namespace App\Http\Livewire\Tables;

use App\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use Illuminate\Support\Str;

class ProjectTable extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'inward';

    public string $sortDirection = 'desc';

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
    public function datasource(): ?Collection
    {
        return Project::query()->with('services', 'current_status')->get();
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
            ->addColumn('name')
            ->addColumn('name_limited', function (Project $project) {
                return Str::limit($project->name ?? '--', 20, '...');
            })
            ->addColumn('inward_formatted', function (Project $project) {
                return Carbon::parse($project->inward)->format('d-m-Y');
            })
            ->addColumn('code')
            ->addColumn('vendor', function (Project $project) {
                return Str::limit($project->vendor->name ?? '--', 10, '...');
            })
            ->addColumn('vendor_export', function (Project $project) {
                return $project->vendor->name ?? '--';
            })
            ->addColumn('referral_no')
            ->addColumn('building_name')
            ->addColumn('services_count', function (Project $project) {
                return count($project->services);
            })
            ->addColumn('cost', function (Project $project) {
                return $project->services()->sum('price');
            })
            ->addColumn('status', function (Project $project) {
                return $project->current_status->badge ?? '--';
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
                ->title(__('PROJECT'))
                ->field('name')
                ->hidden(),

            Column::add()
                ->title(__('PROJECT'))
                ->field('name_limited')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),

            Column::add()
                ->title(__('RECEIVED DATE'))
                ->field('inward_formatted')
                ->searchable()
                ->sortable(),
            // ->makeInputDatePicker('inward'),

            Column::add()
                ->title(__('PROJECT CODE'))
                ->field('code')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('CUSTOMER'))
                ->field('vendor')
                ->visibleInExport(false),

            Column::add()
                ->title(__('CUSTOMER'))
                ->field('vendor_export')
                ->hidden(),

            Column::add()
                ->title(__('CUST REFERRAL #'))
                ->field('referral_no')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('BUILDING NAME'))
                ->field('building_name')
                ->hidden(),

            Column::add()
                ->title(__('SERVICES'))
                ->field('services_count', 'services')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title(__('COST'))
                ->field('cost')
                ->searchable(),

            Column::add()
                ->title(__('STATUS'))
                ->field('status')
                ->searchable()
                ->sortable(),

            Column::add()
                ->title(__('UPDATED DATE'))
                ->field('status')
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
            Button::add('status-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.project-status-update-modal', ['project' => 'id']),

            Button::add('view')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                ')
                ->class('text-white')
                ->route('project.show', ['project' => 'id'])
                ->target('_self'),

            Button::add('edit')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700 hover:text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                ')
                ->class('text-white')
                ->route('project.edit', ['project' => 'id'])
                ->target('_self'),

            Button::add('delete-modal')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700 hover:text-red-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                ')
                ->class('cursor-pointer')
                ->openModal('modals.redirect-after-delete-modal', ['model' => 'App\Models\Project', 'record_id' => 'id', 'route' => 'project.index']),

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
           $updated = Project::query()->find($data['id'])->update([
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
