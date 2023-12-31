<div>
	<form wire:submit.prevent="process">

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
			<div class="form-control">
				{!! Form::label('number', 'Reference Number', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::text('number', old('number'), [
				    'wire:model' => 'number',
				    'disabled',
				    'class' => 'input input-primary input-bordered',
				]) !!}
			</div>
			<div class="form-control">
				{!! Form::label('date', 'Revenue Date', ['class' => 'label font-semibold uppercase']) !!}
				<input type="date" value="{{ old('date') }}" wire:model="date" @class([
					'input input-primary input-bordered',
					'border-2 border-red-600' => $errors->has('date'),
				])>
				@error('date')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="my-8 divider">Branch Details</div>

		<div class="grid grid-cols-2 mt-4 gap-4 xl:w-3/4">
			<div class="form-control">
				<label for="company_id" class="font-semibold uppercase label">Company</label>
				<select wire:model='company_id' class="select select-primary select-bordered" id="company_id" name="company_id"
					required>
					<option value="" selected>--choose company--</option>
					@foreach ($companies as $id => $name)
						<option value="{{ $id }}">{{ $name }}</option>
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
						<option value="{{ $id }}">{{ $branch }}</option>
					@endforeach
				</select>
				@error('branch_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="mt-8 mb-4 divider">Revenue</div>

		<div>
			<div class="mb-2">
				@foreach ($services as $index => $value)
					<div class="grid grid-cols-6 gap-4 p-2 my-1 bg-base-200 rounded-md">
						<div class="col-span-6">
							<livewire:forms.invoice.invoice-items-repeater :subcategory="$value" :wire:key="'service-key-'.$index"
								:key_id="$index" />
						</div>
						<div class="col-span-6">
							<button type="button" class="float-right bg-red-600 border-0 hover:bg-red-500 btn btn-xs"
								wire:click.prevent="removeField({{ $index }})">
								Remove Revenue
							</button>
						</div>
					</div>
				@endforeach
			</div>

			<div class="flex">
				<button wire:click.prevent="addField" class="btn btn-accent btn-block">
					Add Revenue
					<svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</button>
			</div>
		</div>

		<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 w-1/2'>
			<button type="submit" class='btn btn-accent'>Update</button>
			<a href={{ route('revenue.index') }} class="btn">Cancel</a>
		</div>
	</form>
</div>
