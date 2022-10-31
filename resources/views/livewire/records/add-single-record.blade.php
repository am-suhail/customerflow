<div class="px-2 my-2 rounded shadow-md bg-base-200">
    <div class="py-2">
        <form wire:submit.prevent='addRecord'>
            <div class="form-control">
                <label for="name" class="label">
                    <div wire:loading>
                        <x-icons.cog class="w-3 h-3 text-green-600 animate-spin" />
                    </div>
                    <span class="label-text" wire:loading.remove>
                        {{ $recordLabel }}
                    </span>
                </label>

                <div class="flex space-x-2">
                    <input type="text" id="name" class="w-1/3 input input-bordered" wire:model.lazy='name' required>
                    <div class="mx-2 btn-group" role="group">
                        <button type="submit" class="btn btn-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                        <button type="button" wire:click="resetField" class="bg-red-600 border-0 btn hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </form>
    </div>
</div>