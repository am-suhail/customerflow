<div>
	<div class="flex flex-wrap px-4 mt-4">
		<div class="grid grid-cols-1 md:grid-cols-12 xl:grid-cols-12 mb-2 gap-4 w-full">
			<div class="form-control w-full col-span-2 md:col-span-8 xl:col-span-6">
				<label class="label uppercase">Category</label>
				<x-select-search :data="$subcategory_lists" wire:model.lazy="sub_category_id" placeholder="--choose product--" />
				@error('sub_category_id')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('sub_category_id') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Sales Revenue</label>
				<input placeholder="Amount" type="number" min="1" wire:model="selling_price"
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
				<label class="label uppercase">Other Revenue</label>
				<input placeholder="Amount" type="number" min="1" wire:model="additional_charge"
					class="input input-bordered input-primary">
				@error('additional_charge')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('additional_charge') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase">Total Invoice</label>
				<input placeholder="Total Invoices of Each Month" type="number" min="1" wire:model="tax"
					class="input input-bordered input-primary">
				@error('tax')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('tax') }}
						</span>
					</div>
				@enderror
			</div>
		</div>
	</div>
</div>
