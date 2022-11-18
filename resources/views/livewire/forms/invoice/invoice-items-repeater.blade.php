<div>
	<div class="flex flex-wrap px-4 mt-4">
		<div class="grid grid-cols-1 md:grid-cols-12 xl:grid-cols-12 mb-2 gap-4 w-full">
			<div class="form-control w-full col-span-2 md:col-span-8 xl:col-span-7">
				<label class="label uppercase">Service</label>
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
				<label class="label uppercase">Unit Price</label>
				<input placeholder="Service Price" type="number" min="1" wire:model="selling_price"
					class="input input-bordered input-primary">
				@error('selling_price')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('selling_price') }}
						</span>
					</div>
				@enderror
			</div>
		</div>
	</div>
</div>
