<div class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
	<!-- Main content header -->
	<x-headers.button-page-heading :title="'Create Project'" :route="'project.index'" />

	<div class="flex items-start justify-center w-full pt-4">
		<div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">

			<form wire:submit.prevent="process">

				<div class="my-8 divider">Customer Details</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					@if ($fromEnquiry)
						<div class="form-control">
							<label for="referral_no" class="font-semibold uppercase label">Customer</label>
							<input class="input input-bordered input-primary" type="text" value="{{ $enquiry->vendor->name }}" disabled>
						</div>
					@else
						<div class="form-control">
							<label for="vendor_id" class="font-semibold uppercase label">Customer</label>
							<x-select-search :data="$vendors" wire:model.lazy="vendor_id" placeholder="--choose customer--" />
							@error('vendor_id')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					@endif
				</div>

				{{-- <div class="my-8 divider">Project Details</div>

				<div class="form-control">
					<label for="name" class="font-semibold uppercase label">Project Name</label>
					<input type="text" wire:model.lazy="name" id="name"
						class="input input-primary input-bordered 
                    @error('name') border-2 border-red-600 @enderror"
						{{ $fromEnquiry ? 'disabled' : '' }}>
					@error('name')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						<label for="inward" class="font-semibold uppercase label">Received Date</label>
						<input wire:model.lazy="inward" type="date" id="inward"
							class="input input-bordered input-primary
                        @error('inward') border-2 border-red-600 @enderror"
							{{ $fromEnquiry ? 'disabled' : '' }}>
						@error('inward')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						<label for="referral_no" class="font-semibold uppercase label">Project Referral
							Number</label>
						<input class="input input-bordered input-primary @error('referral_no') border-2 border-red-600 @enderror"
							wire:model.lazy="referral_no" type="text" id="referral_no">
						@error('referral_no')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="my-8 divider">Location</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						<label for="building_name" class="font-semibold uppercase label">Building/Site Name</label>
						<input class="input input-bordered input-primary @error('building_name') border-2 border-red-600 @enderror"
							wire:model.lazy="building_name" type="text" id="building_name" {{ $fromEnquiry ? 'disabled' : '' }}>
						@error('building_name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						<label for="building_name" class="font-semibold uppercase label">Site Telephone No</label>
						<input class="input input-bordered input-primary @error('building_name') border-2 border-red-600 @enderror"
							wire:model.lazy="building_name" type="text" id="building_name" {{ $fromEnquiry ? 'disabled' : '' }}>
						@error('building_name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				@if ($fromEnquiry)
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							<label class="font-semibold uppercase label">State</label>
							<input class="input input-bordered input-primary" type="text" value="{{ $enquiry->city->state->name }}"
								disabled>
						</div>
						<div class="form-control">
							<label class="font-semibold uppercase label">City</label>
							<input class="input input-bordered input-primary" type="text" value="{{ $enquiry->city->name }}" disabled>
						</div>
					</div>
				@else
					<div>
						<livewire:state-city :selectedCity="$errors ? old('city_id', $city_id) : null">
					</div>
				@endif

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						<label for="area" class="font-semibold uppercase label">Area</label>
						<input class="input input-bordered input-primary @error('area') border-2 border-red-600 @enderror"
							wire:model.lazy="area" type="text" id="area" {{ $fromEnquiry ? 'disabled' : '' }}>
						@error('area')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						<label for="street" class="font-semibold uppercase label">Street</label>
						<input class="input input-bordered input-primary @error('street') border-2 border-red-600 @enderror"
							wire:model.lazy="street" type="text" id="street" {{ $fromEnquiry ? 'disabled' : '' }}>
						@error('street')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div> --}}

				<div class="mt-8 mb-4 divider">Services</div>

				<div>
					<div class="mb-2">
						@foreach ($services as $index => $value)
							<div class="grid grid-cols-6 gap-4 p-2 my-1 bg-base-200 rounded-md">
								<div class="col-span-6">
									<livewire:project.product-input :wire:key="'service-key-'.$index" :key_id="$index" />
								</div>
								<div class="col-span-6">
									<button type="button" class="float-right bg-red-600 border-0 hover:bg-red-500 btn btn-xs"
										wire:click.prevent="removeField({{ $index }})">
										Remove Service
									</button>
								</div>
							</div>
						@endforeach
					</div>

					<div class="flex">
						<button wire:click.prevent="addField" class="btn btn-accent btn-block">
							Add Service
							<svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>
					</div>
				</div>

				<div class="grid grid-cols-2 mt-4">
					<div class="fomr-control">
						<label for="remarks" class="font-semibold uppercase label">Remarks</label>
						<textarea
						 class="textarea textarea-bordered textarea-primary @error(' remarks') border-2
                            border-red-600 @enderror"
						 wire:model.lazy="remarks" cols="50" rows="10" id="remarks">
                            </textarea>
						@error('remarks')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
					<div>
						<a href={{ route('project.index') }} class="btn">Cancel</a>
						<button type="submit" class='btn btn-accent'>Create</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
