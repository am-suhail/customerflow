<div x-data="{ open: false }" @click.away="open = false">
    <button @click.prevent="open = ! open" class="btn btn-outline btn-accent btn-sm">
        <x-livewire-powergrid::icons.download class="w-6 h-6" />
    </button>

    <div x-show="open" x-cloak x-transition:enter="transform duration-200" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transform duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="absolute z-20 w-auto mt-2 bg-white shadow-xl dark:bg-gray-500">

        @if(in_array('excel',$exportType))
        <div class="flex px-4 py-2 text-gray-400 dark:text-gray-300">
            <span class="w-12">Excel</span>
            <a x-on:click="$wire.call('exportToXLS'); open = false" href="#"
                class="block px-2 text-gray-800 rounded hover:bg-gray-100 hover:text-black-300 dark:text-gray-200 dark:hover:bg-gray-700">
                @lang('livewire-powergrid::datatable.labels.all')
            </a>
            @if($checkbox)
            <a x-on:click="$wire.call('exportToXLS', true); open = false" href="#"
                class="block px-2 text-gray-800 rounded hover:bg-gray-100 hover:text-black-300 dark:text-gray-200 dark:hover:bg-gray-700">
                @lang('livewire-powergrid::datatable.labels.selected')
            </a>
            @endif
        </div>
        @endif
        @if(in_array('csv',$exportType))
        <div class="flex px-4 py-2 text-gray-400 dark:text-gray-300">
            <span class="w-12">Csv</span>
            <a x-on:click="$wire.call('exportToCsv'); open = false" href="#"
                class="block px-2 text-gray-800 rounded hover:bg-gray-100 hover:text-black-300 dark:text-gray-200 dark:hover:bg-gray-700">
                @lang('livewire-powergrid::datatable.labels.all')
            </a>
            @if($checkbox)
            <a x-on:click="$wire.call('exportToCsv', true); open = false" href="#"
                class="block px-2 text-gray-800 rounded hover:bg-gray-100 hover:text-black-300 dark:text-gray-200 dark:hover:bg-gray-700">
                @lang('livewire-powergrid::datatable.labels.selected')
            </a>
            @endif
        </div>
        @endif
    </div>
</div>