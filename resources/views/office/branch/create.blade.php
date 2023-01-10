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
			<div class="w-full p-5 bg-grey-600 rounded-lg shadow-xl xl:w-3/4">
				<form action="{{ route('branch.store') }}" method="POST">
					@csrf

					<div class="mt-8 mb-4 divider">COMPANY DETAILS</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('company_id', 'Choose Company', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::select('company_id', $companies, old('company_id'), [
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

					<div class="mt-8 mb-4 divider">KEY MANAGERIAL PERSON (KMP) DETAILS</div>

					<div class="mt-8 mb-4 divider">BRANCH DETAILS</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" x-data="{ country: {{ old('country_id', '') }} }">
						<div class="form-control">
							{!! Form::label('country_id', 'Country', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::select('country_id', $countries, old('country_id'), [
							    'x-model' => 'country',
							    'placeholder' => '--choose--',
							    'x-on:change' => 'Livewire.emit("countrySelected", country)',
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
						<livewire:state-city :selectedCity="$errors ? old('city_id') : null">
					</div>

					<div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('name', 'Branch Name', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::text('name', old('name'), [
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
							{!! Form::date('inc_date', old('inc_date'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('inc_date') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('inc_date')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('building_size', 'Size of the Building (Sq Ft)', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::number('building_size', old('building_size'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('building_size') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('building_size')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('telephone', 'Telephone', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('telephone', old('telephone'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('telephone') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('telephone')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="mt-8 mb-4 divider uppercase">Investment</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('capital', 'Branch Capital', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('capital', old('capital'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('capital') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('capital')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('total_shares', 'Total No of Shares', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('total_shares', old('total_shares'), [
							    'class' => 'input input-bordered input-primary' . ($errors->has('total_shares') ? 'border-2 border-red-600' : ''),
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
							{!! Form::label('investment_amount', 'Investment Amount', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('investment_amount', old('investment_amount'), [
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
							{!! Form::label('investment_percentage', 'Percentage', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('investment_percentage', old('investment_percentage'), [
							    'class' =>
							        'input input-bordered input-primary' . ($errors->has('investment_percentage') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('investment_percentage')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>

						<div class="form-control">
							{!! Form::label('investment_shares', 'No of Shares', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::number('investment_shares', old('investment_shares'), [
							    'class' =>
							        'input input-bordered input-primary' . ($errors->has('investment_shares') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('investment_shares')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
						<div class="form-control">
							{!! Form::label('remark', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::textarea('remark', old('remark'), [
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
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route('branch.index') }} class="btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>

	</main>
@endsection
