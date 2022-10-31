<div class="flex flex-col items-center p-5">
    @if ($enquiry->status == 3)
    <div class="mb-4 text-center">
        <h6 class="font-bold text-green-600">This Enquiry has already been converted to a Project</h6>
    </div>
    <div class="flex mt-4">
        <button wire:click="$emit('closeModal')" class="mx-1 btn">Okay</button>
    </div>
    @else
    <div class="text-center">
        <h1 class="text-lg text-blue-600">{{ $enquiry->name ?? '' }}</h1>
        <h6 class="font-bold">You are about to process this Enquiry to a New Project</h6>
        <h6 class="my-2 font-extrabold">Are you sure to Continue?</h6>
    </div>
    <div class="flex mt-4">
        <button wire:click="proceedFurther" class="mx-1 bg-green-500 hover:bg-green-700 btn">Continue</button>
        <button wire:click="$emit('closeModal')" class="mx-1 btn">Cancel</button>
    </div>
    @endif

</div>