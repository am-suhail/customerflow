<div>
	<form wire:submit.prevent="process">

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 w-1/2">
			<div class="form-control">
				{!! Form::label('number', 'Invoice Number', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::text('number', old('number'), [
				    'wire:model' => 'number',
				    'disabled',
				    'class' => 'input input-primary input-bordered',
				]) !!}
			</div>
			<div class="form-control">
				{!! Form::label('date', 'Invoice Date', ['class' => 'label font-semibold uppercase']) !!}
				<input type="text" value="{{ old('date') }}" wire:model="date" @class([
					'input input-primary input-bordered',
					'border-2 border-red-600' => $errors->has('date'),
				]) disabled>
				@error('date')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="my-8 divider">Customer Details</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
			<div class="form-control">
				<label for="vendor_id" class="font-semibold uppercase label">Customer</label>
				<x-select-search :data="$vendors" wire:model.lazy="vendor_id" placeholder="--choose customer--" />
				@error('vendor_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="mt-8 mb-4 divider">Products</div>

		<div>
			<div class="mb-2">
				@foreach ($services as $index => $value)
					<div class="grid grid-cols-1 md:grid-cols-6 gap-4 p-2 my-1 bg-base-200 rounded-md">
						<div class="col-span-6">
							<livewire:forms.invoice.invoice-items-repeater :wire:key="'service-key-'.$index" :key_id="$index" />
						</div>
						<div class="col-span-6">
							<button type="button" class="float-right bg-red-600 border-0 hover:bg-red-500 btn btn-xs"
								wire:click.prevent="removeField({{ $index }})">
								Remove Product
							</button>
						</div>
					</div>
				@endforeach
			</div>

			<div class="flex">
				<button wire:click.prevent="addField" class="btn btn-accent btn-block">
					Add Product
					<svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</button>
			</div>
		</div>

		<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
			<div>
				<button type="submit" class='btn btn-accent'>Create</button>
				<a href={{ route('invoice.index') }} class="btn">Cancel</a>
			</div>
		</div>
	</form>
</div>
