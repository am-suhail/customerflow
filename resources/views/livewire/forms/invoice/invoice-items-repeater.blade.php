<div>
	<div class="flex flex-wrap px-4 mt-4">
		<div class="grid grid-cols-1 md:grid-cols-12 xl:grid-cols-12 mb-2 gap-4 w-full">
			<div class="form-control w-full col-span-2 md:col-span-8 xl:col-span-5">
				<label class="label uppercase">Service</label>
				<x-select-search :data="$service_lists" wire:model.lazy="service_id" placeholder="--choose product--" />
				@error('service_id')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('service_id') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Unit Price</label>
				<input placeholder="Service Price" type="number" wire:model.lazy="selling_price"
					class="input input-bordered input-primary" disabled>
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-1">
				<label class="label uppercase">QTY</label>
				<input placeholder="Service Quantity" type="number" wire:model.lazy="qty"
					class="@error('qty') border-2 border-red-600 @enderror input input-bordered input-primary" name="qty"
					min="0">
				@error('qty')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('qty') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Discount Amount</label>
				<input placeholder="Calculated Price" type="number" step=".01" wire:model.lazy="discount"
					class="input input-bordered" name="discount">
				@error('total')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('total') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Total Price</label>
				<input placeholder="Calculated Price" type="number" step=".01" wire:model.lazy="total"
					class="input input-bordered" name="total" disabled>
				@error('total')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('total') }}
						</span>
					</div>
				@enderror
			</div>
		</div>
	</div>
</div>
