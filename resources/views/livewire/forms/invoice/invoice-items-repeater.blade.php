<div>
	<div class="flex flex-wrap px-4 mt-4">
		<div class="grid grid-cols-1 md:grid-cols-12 xl:grid-cols-12 mb-2 gap-4 w-full">
			<div class="form-control w-full col-span-2 md:col-span-8 xl:col-span-7">
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
				<label class="label uppercase">Unit Price</label>
				<input placeholder="Service Price" type="number" min="1" wire:model.lazy="selling_price"
					class="input input-bordered input-primary">
				@error('selling_price')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('selling_price') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Discount</label>
				<input placeholder="Calculated Price" type="number" step=".01" wire:model.lazy="discount"
					class="input input-bordered input-primary" name="discount">
				@error('discount')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('discount') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-3">
				<label class="label uppercase">Authority Charges</label>
				<input placeholder="Govt Charges if Any" type="number" step=".01" wire:model.lazy="additional_charge"
					class="input input-bordered input-primary" name="additional_charge">
				@error('additional_charge')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('additional_charge') }}
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
