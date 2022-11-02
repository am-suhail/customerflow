@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
			<a href="{{ route('all-users') }}" class="mr-4 btn btn-primary btn-sm">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
				</svg>
				Go Back
			</a>
			<h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
		</div>

		@include('layouts.app.flash')

		<div class="flex items-start justify-center w-full pt-4">
			<div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
				{!! Form::open([
				    'route' => ['employee.update', $user],
				    'method' => 'PUT',
				]) !!}

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('national_id', 'National ID:', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('national_id', old('national_id', $user->user_detail->national_id), [
						    'class' => 'input input-primary input-bordered' . ($errors->has('national_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('national_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('national_id_expiry', 'ID Expiry', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('national_id_expiry', old('national_id_expiry', $user->user_detail->national_id_expiry), [
						    'step' => '.01',
						    'class' =>
						        'input input-bordered input-primary' . ($errors->has('national_id_expiry') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('national_id_expiry')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('sex', 'Sex', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], old('sex', $user->user_detail->sex), [
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
						{!! Form::label('dob', 'Date of Birth', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('dob', old('dob', $user->user_detail->dob), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('dob') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('dob')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('country_id', 'Nationality', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('country_id', $countries, old('country_id', $user->user_detail->country_id), [
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

				<div class="my-8 divider">Address</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('building_name', 'Building Name', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('building_name', old('building_name', $user->user_detail->building_name), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('building_name') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('building_name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				{{-- <div>
					<livewire:state-city :selectedCity="$errors ? old('city_id', $user->user_detail->city_id) : null">
				</div> --}}

				{{-- <div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('area', 'Area', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('area', old('area', $user->user_detail->area), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('area') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('area')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('street', 'Street', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('street', old('street'), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('street') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('street')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div> --}}

				<div class="mt-8 mb-4 divider">Academics & Career</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('qualification_id', 'Qualification', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::select('qualification_id', $qualifications, old('qualification_id'), [
						    'class' =>
						        'select select-bordered select-primary' . ($errors->has('qualification_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('qualification_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('years_of_exp', 'Years of Experience', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::number('years_of_exp', old('years_of_exp'), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('years_of_exp') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('years_of_exp')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('code', 'Employee Code', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('code', old('code'), [
						    'class' => 'input input-primary input-bordered' . ($errors->has('code') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('code')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('joining_date', 'Joining Date', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('joining_date', old('joining_date'), [
						    'class' => 'input input-primary input-bordered' . ($errors->has('joining_date') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('joining_date')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('designation_id', 'Designation', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('designation_id', $designations, old('designations'), [
						    'placeholder' => '--choose--',
						    'class' =>
						        'select select-bordered select-primary' . ($errors->has('designation_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('designation_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('salary', 'Salary', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::number('salary', old('salary'), [
						    'step' => '.01',
						    'class' =>
						        'input input-bordered
																																																																																																																																																																		                    input-primary' . ($errors->has('salary') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('salary')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 mt-4">
					<div class="fomr-control">
						{!! Form::label('remarks', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::textarea('remarks', old('remarks'), [
						    'class' =>
						        'textarea h-20 textarea-bordered
																																																																																																																																																																		                    textarea-primary' . ($errors->has('remarks') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('remarks')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
					<div>
						<a href={{ route('all-users') }} class="btn">Cancel</a>
						<button type="submit" class='btn btn-accent'>Create</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
