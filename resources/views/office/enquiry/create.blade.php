@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<x-headers.button-page-heading :title="$pageTitle" :route="'enquiry.index'" />

		@include('layouts.app.flash')

		<div class="flex items-start justify-center w-full pt-4">
			<div class="w-full p-5 bg-white rounded-lg shadow-xl md:w-10/12 lg:w-3/4">
				{!! Form::open([
				    'route' => ['enquiry.store'],
				]) !!}

				<p>
					<span>Product/Service Category - Sub Category</span>
				</p>

				<div class="grid grid-cols-2 gap-4">
					<div class="form-control">
						{!! Form::label('vendor_id', 'Select Customer', [
						    'class' => 'label font-semibold uppercase',
						]) !!}
						{!! Form::select('vendor_id', $vendors, old('vendor_id'), [
						    'placeholder' => '--choose customer--',
						    'class' => 'select select-bordered select-primary' . ($errors->has('vendor_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('vendor_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('category_id', 'Job Type', [
						    'class' => 'label font-semibold
																																				                    uppercase',
						]) !!}
						{!! Form::select('category_id', $categories, old('category_id'), [
						    'placeholder' => '--choose job type--',
						    'class' => 'select select-bordered select-primary' . ($errors->has('category_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('category_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="my-8 divider">Job Site Location</div>

				<div>
					<livewire:state-city :selectedCity="$errors ? old('city_id') : null">
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('area', 'Area', [
						    'class' => 'label font-semibold
																																				                    uppercase',
						]) !!}
						{!! Form::text('area', old('area'), [
						    'class' =>
						        'input
																																				                    input-bordered input-primary' . ($errors->has('area') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('area')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
					<div class="form-control">
						{!! Form::label('street', 'Street', [
						    'class' => 'label font-semibold
																																				                    uppercase',
						]) !!}
						{!! Form::text('street', old('street'), [
						    'class' =>
						        'input
																																				                    input-bordered input-primary' . ($errors->has('street') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('street')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="col-start-1 col-end-2 form-control">
						{!! Form::label('building_name', 'Building Name', [
						    'class' => 'label font-semibold
																																				                    uppercase',
						]) !!}
						{!! Form::text('building_name', old('building_name'), [
						    'class' =>
						        'input
																																				                    input-bordered input-primary' . ($errors->has('building_name') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('building_name')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="my-8 divider">Office</div>

				<div class="form-control mt-4">
					{!! Form::label('name', 'Project Enquiry Name', ['class' => 'label font-semibold uppercase']) !!}
					{!! Form::text('name', old('name'), [
					    'class' => 'input input-primary input-bordered' . ($errors->has('name') ? 'border-2 border-red-600' : ''),
					]) !!}
					@error('name')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
				</div>

				<div class="grid grid-cols-2 mt-4">
					<div class="fomr-control">
						{!! Form::label('requirement', 'Job Description', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::textarea('requirement', old('requirement'), [
						    'class' =>
						        'textarea
																																				                    textarea-bordered textarea-primary' .
						        ($errors->has('requirement') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('requirement')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class="grid grid-cols-2 gap-4 mt-4">
					<div class="form-control">
						{!! Form::label('date', 'Received Date', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::date('date', old('date', now()), [
						    'class' =>
						        'input input-bordered
																																				                    input-primary' . ($errors->has('date') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('date')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>

					<div class="form-control">
						{!! Form::label('assigned_user_id', 'Assign to Team Leader', [
						    'class' => 'label font-semibold
																																				                    uppercase',
						]) !!}
						{!! Form::select('assigned_user_id', $employees, old('assigned_user_id'), [
						    'placeholder' => '--choose--',
						    'class' =>
						        'select select-bordered select-primary' . ($errors->has('assigned_user_id') ? 'border-2 border-red-600' : ''),
						]) !!}
						@error('assigned_user_id')
							<label class="label">
								<span class="text-red-600 label-text-alt">{{ $message }}</span>
							</label>
						@enderror
					</div>
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4'>
					<div>
						<a href={{ route('enquiry.index') }} class="btn">Cancel</a>
						<button type="submit" class='btn btn-accent'>Create</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
