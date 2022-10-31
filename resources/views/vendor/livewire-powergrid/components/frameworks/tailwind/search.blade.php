@if($searchInput)
<div class="flex-row mt-2 md:mt-0 w-full flex justify-start sm:justify-center md:justify-end">

    <div class="relative w-full md:w-4/12 float-end float-right lg:w-1/2">
        <div class="flex items-center">
            <span class="absolute left-0 flex items-center pl-1">
                <span class="p-1 focus:outline-none focus:shadow-outline">
                    <x-livewire-powergrid::icons.search class="text-gray-300 dark:text-gray-200" />
                </span>
            </span>
            <input wire:model.debounce.600ms="search" type="text" style="padding-left: 36px !important;"
                class="input input-bordered input-sm w-full input-primary"
                placeholder="{{ trans('livewire-powergrid::datatable.placeholders.search') }}">
        </div>
    </div>

</div>
@endif