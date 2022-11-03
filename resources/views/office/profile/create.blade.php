@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div
			class="flex flex-col items-center justify-center pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
			<h1 class="text-2xl font-semibold text-blue-800 font-base whitespace-nowrap">{{ $pageTitle }}</h1>
		</div>

		@include('layouts.app.flash')

		<div class="flex flex-col items-center justify-center w-full pt-4">

			<div class="flex flex-col mb-5 bg-white">
				<div class="m-auto">
					<div class="flex flex-col max-w-md px-10 py-8 bg-gray-100 rounded-md shadow-md md:px-8">
						<div class="flex flex-col items-center justify-center gap-6 md:flex-row md:gap-8">
							<svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 w-28 h-28" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
									d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
							<div class="flex flex-col text-center md:text-left">
								<div class="text-lg font-medium text-gray-800">{{ Auth::user()->name }}</div>
								<div class="text-gray-500 whitespace-nowrap">{{ Auth::user()->mobile }}</div>
								<div class="mb-3 text-gray-500 whitespace-nowrap">{{ Auth::user()->email }}</div>
								<div class="flex flex-row gap-4 mx-auto my-auto text-2xl text-gray-800 md:mx-0">
									<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-linkedin"></i></a>
									<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-facebook-square"></i></a>
									<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-github-square"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
				<form action="{{ route('my-profile.store') }}" method="POST">
					@csrf

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('nid', 'National ID:', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::text('nid', old('nid'), [
							    'class' => 'input input-primary input-bordered' . ($errors->has('nid') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('nid')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
						<div class="form-control">
							{!! Form::label('nid_expiry', 'ID Expiry', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::date('nid_expiry', old('nid_expiry'), [
							    'step' => '.01',
							    'class' => 'input input-bordered input-primary' . ($errors->has('nid_expiry') ? 'border-2 border-red-600' : ''),
							]) !!}
							@error('nid_expiry')
								<label class="label">
									<span class="text-red-600 label-text-alt">{{ $message }}</span>
								</label>
							@enderror
						</div>
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('sex', 'Sex', ['class' => 'label font-semibold uppercase']) !!}
							{!! Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], old('sex'), [
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
							{!! Form::date('dob', old('dob'), [
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
							{!! Form::select('country_id', $countries, old('country_id'), [
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
							{!! Form::text('building_name', old('building_name'), [
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
						<livewire:state-city :selectedCity="$errors ? old('city_id') : null">
					</div>

					<div class="grid grid-cols-2 gap-4 mt-4">
						<div class="form-control">
							{!! Form::label('area_text', 'Area', [
							    'class' => 'label font-semibold uppercase',
							]) !!}
							{!! Form::text('area_text', old('area_text'), [
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
							{!! Form::text('street_text', old('street_text'), [
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

					<div class='grid grid-cols-2 mt-4'>
						<div>
							<button type="submit" class='btn btn-accent btn-block'>Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</main>
@endsection
