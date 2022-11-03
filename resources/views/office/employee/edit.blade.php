@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('employee.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
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

				<div>
					<livewire:state-city :selectedCity="$errors ? old('city_id', $user->user_detail->city_id) : null">
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('area_text', 'Area', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('area_text', old('area_text', $user->user_detail->area_text), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('area_text') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('area_text')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('street_text', 'Street', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('street_text', old('street_text', $user->user_detail->area_text), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('street_text') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('street_text')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="mt-8 mb-4 divider">Academics & Career</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('qualification_id', 'Qualification', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::select(
						    'qualification_id',
						    $qualifications,
						    old('qualification_id', $user->user_detail->qualification_id),
						    [
						        'placeholder' => '--choose--',
						        'class' =>
						            'select select-bordered select-primary' .
						            ($errors->has('qualification_id') ? 'border-2 border-red-600' : ''),
						    ],
						) !!}
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
						{!! Form::number('years_of_exp', old('years_of_exp', $user->user_detail->years_of_exp), [
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
						{!! Form::label('joining_date', 'Joining Date', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('joining_date', old('joining_date', $user->employee_detail->joining_date), [
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
						{!! Form::select('designation_id', $designations, old('designations', $user->employee_detail->designation_id), [
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
						{!! Form::number('salary', old('salary', $user->employee_detail->salary), [
						    'step' => '.01',
						    'class' => 'input input-bordered input-primary' . ($errors->has('salary') ? 'border-2 border-red-600' : ''),
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
						{!! Form::label('remark', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::textarea('remark', old('remark'), [
						    'class' =>
						        'textarea h-20 textarea-bordered textarea-primary' . ($errors->has('remark') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('remark')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
					<div>
						<a href={{ route('employee.index') }} class="btn">Cancel</a>
						<button type="submit" class='btn btn-accent'>Update</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
