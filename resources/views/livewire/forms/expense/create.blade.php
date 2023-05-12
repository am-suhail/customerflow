<div>
	@if ($errors->any())
		<div class="alert">
			<ul class="menu">
				@foreach ($errors->all() as $error)
					<li class="text-danger-400">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form wire:submit.prevent="process">

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 xl:w-1/2">
			<div class="form-control">
				{!! Form::label('accounting_date', 'Accounting Date', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::date('accounting_date', old('accounting_date'), [
				    'class' => 'input input-bordered input-primary' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
				    'wire:model' => 'accounting_date',
				]) !!}
				@error('accounting_date')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="my-8 divider">Branch Details</div>

		<div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4 md:w-3/4">
			<div class="form-control">
				<label for="company_id" class="font-semibold uppercase label">Company</label>
				<select wire:model='company_id' class="select select-primary select-bordered" id="company_id" name="company_id"
					required>
					<option value="" selected>--choose company--</option>
					@foreach ($companies as $id => $name)
						<option value="{{ $id }}" class="lg:font-bold lg:text-1xl">{{ $name }}</option>
					@endforeach
				</select>
				@error('company_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>

			<div class="form-control">
				<label for="branch_id" class="font-semibold uppercase label">Branch</label>
				<select wire:model='branch_id' class="select select-primary select-bordered" id="branch_id" name="branch_id"
					required {{ !is_null($company_id) ? '' : 'disabled' }}>
					<option value="" selected>--choose branch--</option>
					@foreach ($branches as $id => $branch)
						<option value="{{ $id }}" class="lg:font-bold lg:text-1xl">{{ $branch }}</option>
					@endforeach
				</select>
				@error('branch_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="mt-8 mb-4 divider">Document Details</div>

		<div class="grid grid-cols-1 md:grid-cols-5 mt-4 gap-4">
			<div class="form-control">
				<label for="category_id" class="font-semibold uppercase label">Category</label>
				<select class="select select-primary select-bordered" id="category_id" name="category_id">
					<option value="" selected>--choose category--</option>
				</select>
				@error('category_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>

			<div class="form-control">
				<label for="sub_category_id" class="font-semibold uppercase label">Sub Category</label>
				<select wire:model='sub_category_id' class="select select-primary select-bordered" id="sub_category_id"
					name="sub_category_id" required>
					<option value="" selected>--choose sub category--</option>
					@foreach ($subcategory_lists->sort() as $id => $name)
						<option value="{{ $id }}" class="font-bold">{{ $name }}</option>
					@endforeach
				</select>
				@error('sub_category_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>

			<div class="form-control">
				<label for="entry_type_id" class="font-semibold uppercase label">Expense Type</label>
				<select class="select select-primary select-bordered" id="entry_type_id" name="entry_type_id"
					wire:model="entry_type_id" required>
					<option value="" selected>--choose--</option>
					@foreach ($entry_type_lists->sort() as $id => $name)
						<option value="{{ $id }}" class="font-bold">{{ $name }}</option>
					@endforeach
				</select>
				@error('entry_type_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
				<div class="mt-1">
					<a href="javascript:void(0)"
						wire:click.prevent='$emit("openModal", "records.modals.add-trans-entry-type",  {{ json_encode(['id' => $sub_category_id]) }})'
						class="text-black flex items-center uppercase text-sm font-semibold">
						Add New Expense Type
						<svg width="18" height="18" class="text-yellow-600 ml-1" fill="none" stroke="currentColor"
							stroke-linecap="round" stroke-width="1.5" viewBox="0 0 24 24">
							<path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20v0Z"></path>
							<path d="M16 12H8"></path>
							<path d="M12 8v8"></path>
						</svg>
					</a>
				</div>
			</div>

			<div class="form-control">
				<label class="label uppercase">Amount</label>
				<input placeholder="Amount" type="number" min="1" step=".01" wire:model="amount"
					class="input input-bordered input-primary">
				@error('amount')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('amount') }}
						</span>
					</div>
				@enderror
			</div>

			<div class="form-control">
				<label class="label uppercase">Description</label>
				<input placeholder="Description" wire:model="description" class="input input-bordered input-primary">
				@error('description')
					<div class="label uppercase">
						<span class="text-error label-text">
							{{ $errors->first('description') }}
						</span>
					</div>
				@enderror
			</div>
		</div>

		<div class="mt-8 mb-4 divider">Remark</div>

		<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
			<div class="form-control">
				{!! Form::label('remark', 'Remark', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::textarea('remark', old('remark'), [
				    'class' => 'textarea textarea-bordered	textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
				    'wire:model' => 'remark',
				]) !!}
				@error('remark')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class='grid grid-flow-row grid-cols-1 md:grid-cols-2 gap-4 mt-4 w-1/2'>
			<button type="submit" class='btn btn-accent'>Create</button>
			<a href={{ route('expense.index') }} class="btn">Cancel</a>
		</div>
	</form>
</div>

@push('scripts')
	<script>
		window.addEventListener('entry-type-updated', event => {
			let obj = event.detail.newTypeList;

			var selectElement = document.getElementById('entry_type_id');
			selectElement.innerHTML = ''; // clear the current options

			let options = "";

			for (const key in obj) {
				options += `<option value="${key}">${obj[key]}</option>`;
			}

			selectElement.innerHTML = options;

			Livewire.emit('entryValueUpdate');
		})
	</script>
@endpush
