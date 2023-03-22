<div class="px-5 my-2 rounded">
	<div class="py-2">
		<form wire:submit.prevent='save'>
			<div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
				<div class="form-control">
					<label for="sub_category_id" class="font-semibold uppercase label">Sub Category</label>
					<select wire:model='sub_category_id' class="select select-primary select-bordered" id="sub_category_id"
						name="sub_category_id" required>
						<option value="" selected>--choose sub category--</option>
						@foreach ($subcategory_lists as $id => $name)
							<option value="{{ $id }}">{{ $name }}</option>
						@endforeach
					</select>
					@error('sub_category_id')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
				</div>

				<div class="form-control">
					<label for="name" class="font-semibold uppercase label">Expense Type</label>
					<input type="text" id="name" class="input input-bordered" wire:model='name' required>
					@error('name')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
				</div>
			</div>

			<div class='grid grid-flow-row grid-cols-1 md:grid-cols-2 gap-4 mt-4 w-1/2'>
				<button type="submit" class='btn btn-accent'>
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
					</svg>
					Create
				</button>
				<button type="button" wire:click="$emit('closeModal')" class="bg-red-600 border-0 btn hover:bg-red-500">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
					Cancel
				</button>
			</div>
		</form>
	</div>
</div>
