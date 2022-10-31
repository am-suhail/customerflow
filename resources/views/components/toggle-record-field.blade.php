<div x-data={isAdding:false}>
    <button class="btn" :class="!isAdding ? 'bg-green-500 my-2 hover:bg-green-400' : 'bg-red-500 hover:bg-red-400'"
        @click="isAdding = !isAdding" x-text="isAdding ? 'Cancel' : 'Add New'"></button>
    <div x-show="isAdding" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90">
        {{ $slot }}
    </div>
</div>