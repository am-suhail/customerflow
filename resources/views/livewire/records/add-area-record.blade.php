<div class="px-2 my-2 rounded shadow-md bg-base-200">
    <div class="py-2">
        <form wire:submit.prevent='addRecord'>
            <div class="form-control">
                <label for="name" class="label">
                    <div wire:loading>
                        <x-icons.cog class="w-3 h-3 text-green-600 animate-spin" />
                    </div>
                    <span class="label-text" wire:loading.remove>
                        Add Area
                    </span>
                </label>

                <div class="flex space-x-2">
                    <select id="state" wire:model='city' class="select select-bordered">
                        <option>--choose city--</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" id="name" class="w-1/3 input input-bordered" wire:model='name' required>
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
                    <button type="button" wire:click="refreshRecord"
                        class="bg-green-600 border-0 btn hover:bg-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
                @error('city') <span class="text-red-600">{{ $message }}</span> @enderror
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </form>
    </div>
</div>