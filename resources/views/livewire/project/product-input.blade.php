<div>
	<div class="flex flex-wrap p-4 my-4">
		<div class="grid grid-cols-4 mb-2 gap-4 w-full">
			<div class="form-control w-full">
				<label class="label uppercase">Product Name</label>
				<x-select-search :data="$service_lists" wire:model.lazy="service_id" placeholder="--choose service--" />
				@error('service_id')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('service_id') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control w-1/5">
				<label class="label uppercase">Quantity</label>
				<input placeholder="Service Quantity" type="number" wire:model.lazy="qty"
					class="@error('qty') border-2 border-red-600 @enderror input input-bordered input-primary" name="qty">
				@error('qty')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('qty') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control">
				<label class="label uppercase">Unit Price</label>
				<input placeholder="Service Price" type="number" step=".01" wire:model.lazy="selling_price"
					class="@error('selling_price') border-2 border-red-600 @enderror input input-bordered input-primary"
					max="{{ $selectedService->max_price ?? '' }}">
				@error('selling_price')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('selling_price') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control">
				<label class="label uppercase">Total Price</label>
				<input placeholder="Calculated Price" type="number" step=".01" wire:model.lazy="price"
					class="input input-bordered" name="price[]" readonly>
				@error('price')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('price') }}
						</span>
					</div>
				@enderror
			</div>
		</div>
	</div>
</div>
