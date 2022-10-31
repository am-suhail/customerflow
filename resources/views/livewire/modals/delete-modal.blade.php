<div class="flex flex-col items-center p-5">
    <div class="text-center">
        <h6 class="font-extrabold">Are you sure to Delete?</h6>
        <h1 class="text-lg text-blue-600">{{ $item->name ?? '' }}</h1>
    </div>
    <div class="flex mt-4">
        <button wire:click="deleteRecord" class="mx-1 bg-red-500 hover:bg-red-700 btn">Delete</button>
        <button wire:click="$emit('closeModal')" class="mx-1 btn">Cancel</button>
    </div>
</div>