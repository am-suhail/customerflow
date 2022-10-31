<div class="grid grid-cols-2 gap-4 mt-4">
	<div class="form-control">
		<label for="category_id" class="font-semibold uppercase label">Category</label>
		<select wire:model='selectedCategory' class="select select-primary select-bordered" id="category_id" name="category_id"
			required>
			<option value="" selected>--choose--</option>
			@foreach ($categories as $category)
				<option value="{{ $category->id }}" style="font-weight:900; font-size:18px">{{ $category->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-control">
		<label for="sub_category_id" class="font-semibold uppercase label">Sub Category</label>
		<select wire:model='selectedSubCategory' class="select select-primary select-bordered" id="sub_category_id"
			name="sub_category_id" required {{ !is_null($selectedCategory) ? '' : 'disabled' }}>
			<option value="" selected>--choose--</option>
			@foreach ($subcategories as $subcategory)
				<option value="{{ $subcategory->id }}" style="font-weight:900; font-size:18px">{{ $subcategory->name }}</option>
			@endforeach
		</select>
	</div>

</div>
