@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('branch.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
					</svg>
					<span class="hidden sm:block">
						Go Back
					</span>
				</a>
			</div>
			<div class="col-start-2 col-end-3">
				<h1 class="text-lg sm:text-2xl text-center font-semibold text-blue-800 font-base whitespace-nowrap uppercase">
					{{ $pageTitle }}</h1>
			</div>
		</div>

		@include('layouts.app.flash')

		<div class="flex items-start justify-center w-full pt-4">
			<div class="w-full p-5 bg-white rounded-lg shadow-xl xl:w-3/4">
				{!! Form::open([
				    'route' => ['branch.update', $branch],
				    'method' => 'PUT',
				]) !!}

				<div class="mt-8 mb-4 divider">COMPANY DETAILS</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('company_id', 'Choose Company', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('company_id', $companies, old('company_id', $branch->company_id), [
						    'placeholder' => '--choose--',
						    'class' => 'select select-bordered select-primary' . ($errors->has('company_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('company_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="mt-8 mb-4 divider">BRANCH DETAILS</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('type', 'Type', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('type', [1 => 'Physical', 2 => 'Virtual'], old('type', $branch->type), [
						    'placeholder' => '--choose--',
						    'class' => 'select select-bordered select-primary' . ($errors->has('type') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('type')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('country_id', 'Country', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('country_id', $countries, old('country_id', $branch->country_id), [
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

				<div>
					<livewire:state-city :selectedCity="$errors ? old('city_id', $branch->city_id) : null">
				</div>

				<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('name', 'Branch Name', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('name', old('name', $branch->name), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('inc_date', 'Branch Commencement Date', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('inc_date', old('inc_date', $branch->inc_date), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('inc_date') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('inc_date')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('telephone', 'Telephone', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::number('telephone', old('telephone', $branch->telephone), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('telephone') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('telephone')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('building_size', 'Size of the Showroom (Sq Ft)', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('building_size', old('building_size', $branch->building_size), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('building_size') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('building_size')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('rent', 'Showroom Rent', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('rent', old('rent', $branch->rent), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('rent') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('rent')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('total_accomodation', 'No of Accomodation', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('total_accomodation', old('total_accomodation', $branch->total_accomodation), [
						    'class' =>
						        'input input-bordered input-primary' . ($errors->has('total_accomodation') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('total_accomodation')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('accomodation_rent', 'Accomodation Rent', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('accomodation_rent', old('accomodation_rent', $branch->accomodation_rent), [
						    'class' =>
						        'input input-bordered input-primary' . ($errors->has('accomodation_rent') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('accomodation_rent')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('total_warehouse', 'No of Warehouse', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('total_warehouse', old('total_warehouse', $branch->total_warehouse), [
						    'class' =>
						        'input input-bordered input-primary' . ($errors->has('total_warehouse') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('total_warehouse')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('warehouse_rent', 'Warehouse Rent', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('warehouse_rent', old('warehouse_rent', $branch->warehouse_rent), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('warehouse_rent') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('warehouse_rent')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="mt-8 mb-4 divider uppercase">Human Resource</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('emp_male', 'Male Employees', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::number('emp_male', old('emp_male', $branch->emp_male), [
						    'min' => 0,
						    'class' => 'input input-bordered input-primary' . ($errors->has('emp_male') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('emp_male')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('emp_female', 'Female Employees', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::number('emp_female', old('emp_female', $branch->emp_female), [
						    'min' => 0,
						    'class' => 'input input-bordered input-primary' . ($errors->has('emp_female') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('emp_female')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('kmp', 'Key Management Person (KMP)', ['class' => 'label font-semibold uppercase text-red-500']) !!}
						{!! Form::text('kmp', old('kmp'), [
						    'disabled',
						    'class' => 'input input-bordered input-primary' . ($errors->has('kmp') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('kmp')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="mt-8 mb-4 divider uppercase">Investment</div>

				<div x-data="calc()">
					<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('capital', 'Branch Capital', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('capital', old('capital', $branch->capital), [
							    'x-on:input' => 'calc_values',
							    'x-model.number' => 'capital',
							    'class' => 'input input-bordered input-primary' . ($errors->has('capital') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('capital')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('share_value', 'Value of Share', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('share_value', old('share_value', $branch->share_value), [
							    'x-on:input' => 'calc_values',
							    'x-model.number' => 'share_value',
							    'class' => 'input input-bordered input-primary' . ($errors->has('share_value') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('share_value')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('total_shares', 'Total No of Shares', [
							    'class' => 'label font-semibold uppercase text-green-500',
							]) !!}
							{!! Form::number('total_shares', old('total_shares', $branch->total_shares), [
							    'readonly',
							    'x-model' => 'total_shares',
							    'class' => 'input input-bordered input-success' . ($errors->has('total_shares') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('total_shares')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('investment_amount', 'Investment', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('investment_amount', old('investment_amount', $branch->investment_amount), [
							    'x-on:input' => 'calc_values',
							    'x-model' => 'investment_amount',
							    'class' =>
							        'input input-bordered input-primary' . ($errors->has('investment_amount') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('investment_amount')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('investment_percentage', 'Percentage %', [
							    'class' => 'label font-semibold uppercase text-green-500',
							]) !!}
							{!! Form::number('investment_percentage', old('investment_percentage', $branch->investment_percentage), [
							    'readonly',
							    'x-model' => 'investment_percentage',
							    'class' =>
							        'input input-bordered input-success' . ($errors->has('investment_percentage') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('investment_percentage')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('investment_shares', 'No of Share Units', [
							    'class' => 'label font-semibold uppercase text-green-500',
							]) !!}
							{!! Form::number('investment_shares', old('investment_shares', $branch->investment_shares), [
							    'readonly',
							    'x-model' => 'investment_shares',
							    'class' =>
							        'input input-bordered input-success' . ($errors->has('investment_shares') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('investment_shares')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>
				</div>

				{{-- //TODO : Something needs to be added here --}}
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('roi_percentage', 'Return of Investment (ROI) %', [
						    'class' => 'label font-semibold uppercase text-red-500',
						]) !!}
						{!! Form::number('roi_percentage', old('roi_percentage'), [
						    'disabled',
						    'min' => 0,
						    'class' => 'input input-bordered input-primary' . ($errors->has('roi_percentage') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('roi_percentage')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('roi_amount', 'ROI Amount', [
						    'class' => 'label font-semibold uppercase text-red-500',
						]) !!}
						{!! Form::number('roi_amount', old('roi_amount'), [
						    'disabled',
						    'min' => 0,
						    'class' => 'input input-bordered input-primary' . ($errors->has('roi_amount') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('roi_amount')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('roi_period', 'ROI Period (In Months)', [
						    'class' => 'label font-semibold uppercase text-red-500',
						]) !!}
						{!! Form::number('roi_period', old('roi_period'), [
						    'disabled',
						    'min' => 0,
						    'class' => 'input input-bordered input-primary' . ($errors->has('roi_period') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('roi_period')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
					<div class="form-control">
						{!! Form::label('remark', 'Remark', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::textarea('remark', old('remark', $branch->remark), [
						    'class' => 'textarea textarea-bordered	textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('remark')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 md:w-1/2'>
					<button type="submit" class='btn btn-accent'>Update</button>
					<a href={{ route('branch.index') }} class="btn">Cancel</a>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection

@push('scripts')
	<script>
		function calc() {
			return {
				capital: {{ old('capital', $branch->capital ?? 0) }},
				share_value: {{ old('share_value', $branch->share_value ?? 0) }},
				total_shares: {{ old('total_shares', $branch->total_shares ?? 0) }},
				investment_amount: {{ old('investment_amount', $branch->investment_amount ?? 0) }},
				investment_percentage: {{ old('investment_percentage', $branch->investment_percentage ?? 0) }},
				investment_shares: {{ old('investment_shares', $branch->investment_shares ?? 0) }},

				calc_values() {
					this.total_shares = parseFloat((this.capital / this.share_value).toFixed(2));
					this.investment_percentage = ((this.investment_amount / this.capital) * 100).toFixed(2);
					this.investment_shares = parseFloat((this.investment_amount / this.share_value).toFixed(2));
				}
			}
		}
	</script>
@endpush
