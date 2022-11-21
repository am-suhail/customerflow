<div class="px-2 my-2 rounded shadow-md bg-base-200">
	<div class="py-2">
		<form wire:submit.prevent='addRecord'>
			<div class="form-control">
				<label for="name" class="label">
					<div wire:loading>
						<x-icons.cog class="w-3 h-3 text-green-600 animate-spin" />
					</div>
					<span class="label-text" wire:loading.remove>
						Add State
					</span>
				</label>

				<div class="flex flex-col space-y-2 space-x-0 sm:flex-row sm:space-y-0 sm:space-x-2">
					<div>
						<select id="country" wire:model='country' class="select select-bordered w-full">
							<option>--choose country--</option>
							@foreach ($countries as $country)
								<option value="{{ $country->id }}">{{ $country->name }}</option>
							@endforeach
						</select>
					</div>
					<div>
						<input type="text" id="name" class="input input-bordered w-full" wire:model='name' required>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" class="btn btn-accent">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
							</svg>
						</button>
						<button type="button" wire:click="resetField" class="bg-red-600 border-0 btn hover:bg-red-500">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" wire:click="refreshRecord" class="bg-green-600 border-0 btn hover:bg-green-500">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
							</svg>
						</button>
					</div>
				</div>
				@error('country')
					<span class="text-red-600">{{ $message }}</span>
				@enderror
				@error('name')
					<span class="text-red-600">{{ $message }}</span>
				@enderror
			</div>
		</form>
	</div>
</div>
