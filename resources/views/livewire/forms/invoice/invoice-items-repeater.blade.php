<div>
	<div class="flex flex-wrap px-4 mt-4">
		<div class="grid grid-cols-1 md:grid-cols-12 xl:grid-cols-12 mb-2 gap-4 w-full">
			<div class="form-control w-full col-span-2 md:col-span-6 xl:col-span-4">
				<label class="label uppercase text-sm font-bold">Revenue Type</label>
				<select wire:model='revenue_type_id' class="select select-primary select-bordered" id="revenue_type_id"
					name="revenue_type_id" required>
					<option value="" selected>--choose revenue type--</option>
					@foreach ($revenuetype_lists as $id => $name)
						<option value="{{ $id }}" style="font-size:18px">{{ $name }}</option>
					@endforeach
				</select>
				@error('revenue_type_id')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('revenue_type_id') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control w-full col-span-2 md:col-span-6 xl:col-span-4">
				<label class="label uppercase text-sm font-bold">Category</label>
				<select wire:model='sub_category_id' class="select select-primary select-bordered" id="sub_category_id"
					name="sub_category_id" required>
					<option value="" selected>--choose sub category--</option>
					@foreach ($subcategory_lists as $id => $name)
						<option value="{{ $id }}" style="font-size:18px">{{ $name }}</option>
					@endforeach
				</select>
				@error('sub_category_id')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('sub_category_id') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase text-sm font-bold">
					Taxable Amount
				</label>
				<input placeholder="Amount" type="number" min="0" step=".01" wire:model="selling_price"
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
				<label class="label uppercase text-sm font-bold">Tax Amount</label>
				<input placeholder="Tax Amount" type="number" min="0" step=".01"
					class="input input-bordered input-primary" wire:model="discount">
				@error('discount')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('discount') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase text-sm font-bold">Tax %</label>
				<input placeholder="Tax %" type="number" min="0" step=".01" wire:model="tax_percentage"
					class="input input-bordered input-primary" disabled>
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase text-sm font-bold">Total Amount</label>
				<input placeholder="Total" type="number" min="0" wire:model="total"
					class="input input-bordered input-primary" disabled>
				@error('total')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('total') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control col-span-2 md:col-span-4 xl:col-span-2">
				<label class="label uppercase text-sm font-bold">No of Invoice</label>
				<input placeholder="Total" type="number" min="0" wire:model="tax"
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
