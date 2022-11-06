<div class="flex flex-col items-start justify-center w-full p-4">
	<div class="py-4 w-full">
		<h1 class="text-center text-blue-600 uppercase font-bold text-lg">Add New Customer</h1>
	</div>

	<form wire:submit.prevent>

		<div class="form-control">
			{!! Form::label('name', 'Customer Name', ['class' => 'label font-semibold uppercase']) !!}
			{!! Form::text('name', old('name'), [
			    'wire:model.defer' => 'name',
			    'class' => 'input input-primary input-bordered' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
			]) !!}
			@error('name')
				<label class="label">
					<span class="text-red-600 label-text-alt">{{ $message }}</span>
				</label>
			@enderror
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
			<div class="form-control">
				{!! Form::label('sex', 'Sex', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], old('sex'), [
				    'wire:model.defer' => 'sex',
				    'placeholder' => '--choose--',
				    'class' => 'select select-bordered select-primary' . ($errors->has('sex') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('sex')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
			<div class="form-control">
				{!! Form::label('country_id', 'Nationality', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::select('country_id', $countries, old('country_id'), [
				    'wire:model.defer' => 'country_id',
				    'placeholder' => '--choose--',
				    'class' => 'select select-bordered select-primary' . ($errors->has('country_id') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('country_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
			<div class="form-control">
				{!! Form::label('mobile', 'Mobile', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::number('mobile', old('mobile'), [
				    'wire:model.defer' => 'mobile',
				    'class' => 'input input-bordered input-primary' . ($errors->has('mobile') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('mobile')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
			<div class="form-control">
				{!! Form::label('email', 'Email', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::email('email', old('email'), [
				    'wire:model.defer' => 'email',
				    'class' => 'input input-bordered input-primary' . ($errors->has('email') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('email')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="mt-8 mb-4 divider">COMPANY DETAILS</div>

		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
			<div class="form-control">
				{!! Form::label('company_name', 'Company Name', [
				    'class' => 'label font-semibold uppercase',
				]) !!}
				{!! Form::text('company_name', old('company_name'), [
				    'wire:model.defer' => 'company_name',
				    'class' => 'input input-bordered input-primary' . ($errors->has('company_name') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('company_name')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
			<div class="form-control">
				{!! Form::label('industry_id', 'Industry', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::select('industry_id', $industries, old('industry_id'), [
				    'wire:model.defer' => 'industry_id',
				    'class' => 'select select-bordered select-primary' . ($errors->has('industry_id') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('industry_id')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
			<div class="form-control">
				{!! Form::label('vat', 'VAT', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::text('vat', old('vat'), [
				    'wire:model.defer' => 'vat',
				    'class' => 'input input-bordered input-primary' . ($errors->has('vat') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('vat')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
			<div class="form-control">
				{!! Form::label('url', 'Website (if any)', [
				    'class' => 'label font-semibold uppercase',
				]) !!}
				{!! Form::text('url', old('url'), [
				    'wire:model.defer' => 'url',
				    'class' => 'input input-bordered input-primary' . ($errors->has('url') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('url')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>

			<div class="form-control">
				{!! Form::label('telephone', 'Telephone', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::number('telephone', old('telephone'), [
				    'wire:model.defer' => 'telephone',
				    'class' => 'input input-bordered input-primary' . ($errors->has('telephone') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('telephone')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>

		{{-- <div>
			<livewire:state-city :selectedCity="$errors ? old('city_id') : null">
		</div> --}}

		<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
			<div class="form-control">
				{!! Form::label('remark', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
				{!! Form::textarea('remark', old('remark'), [
				    'wire:model.defer' => 'remark',
				    'rows' => 3,
				    'class' => 'textarea textarea-bordered	textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
				]) !!}
				@error('remark')
					<label class="label">
						<span class="text-red-600 label-text-alt">{{ $message }}</span>
					</label>
				@enderror
			</div>
		</div>
	</form>
	<div class='grid grid-flow-row grid-cols-2 gap-2 mt-4 md:w-1/2'>
		<button wire:click.prevent="addVendor" class="mx-1 bg-green-500 hover:bg-green-700 btn">Save</button>
		<button wire:click.prevent="$emit('closeModal')" class="mx-1 btn">Cancel</button>
	</div>
</div>
