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

			<div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
				{!! Form::open([
				    'route' => ['my-profile.update', Auth::user()],
				    'method' => 'PUT',
				]) !!}

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('name', 'Name', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('name', old('name', Auth::user()->name), [
						    'class' =>
						        'input input-primary
																																																																														                    input-bordered' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
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
						{!! Form::label('mobile', 'Mobile', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('mobile', old('mobile', Auth::user()->mobile), [
						    'class' =>
						        'input input-primary
																																																																														                    input-bordered' . ($errors->has('mobile') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('mobile')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('email', 'Email', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::email('email', old('email', Auth::user()->email), [
						    'class' =>
						        'input input-primary
																																																																														                    input-bordered' . ($errors->has('email') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('email')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('national_id', 'National ID:', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('national_id', old('national_id', Auth::user()->user_detail->national_id), [
						    'class' =>
						        'input
																																																																														                    input-primary input-bordered' . ($errors->has('national_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('national_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('national_id_expiry', 'ID Expiry', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('national_id_expiry', old('national_id_expiry', Auth::user()->user_detail->national_id_expiry), [
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

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('sex', 'Sex', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], old('sex', Auth::user()->user_detail->sex), [
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
						{!! Form::date('dob', old('dob', Auth::user()->user_detail->dob), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('dob') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('dob')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('country_id', 'Nationality', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::select('country_id', $countries, old('country_id', Auth::user()->user_detail->country_id), [
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

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('building_name', 'Building Name', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::text('building_name', old('building_name', Auth::user()->user_detail->building_name), [
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
					<livewire:state-city :selectedCity="$errors ? old('city_id', Auth::user()->user_detail->city_id) : null">
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('area_text', 'Area', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::text('area_text', old('area_text', Auth::user()->user_detail->area_text), [
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
						{!! Form::text('street_text', old('street_text', Auth::user()->user_detail->street_text), [
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

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('qualification_id', 'Qualification', [
						    'placeholder' => '--choose--',
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::select(
						    'qualification_id',
						    $qualifications,
						    old('qualification_id', Auth::user()->user_detail->qualification_id),
						    [
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
						{!! Form::number('years_of_exp', old('years_of_exp', Auth::user()->user_detail->years_of_exp), [
						    'class' => 'input input-bordered input-primary' . ($errors->has('years_of_exp') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('years_of_exp')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-cols-1 md:grid-cols-2 mt-4'>
					<div>
						<button type="submit" class='btn btn-accent btn-block'>Update</button>
					</div>
				</div>

				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
