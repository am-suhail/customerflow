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
			<div class="w-full p-5 bg-white rounded-lg shadow-xl xl:w-3/4">
				{!! Form::open([
				    'route' => ['employee.appoint-process', $user],
				    'method' => 'PUT',
				]) !!}

				<div class="grid grid-cols-2 gap-4 mt-4">
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
				</div>

				<div class="grid grid-cols-2 mt-4">
					<div class="fomr-control">
						{!! Form::label('remarks', 'Remarks', ['class' => 'label font-semibold uppercase']) !!}
						{!! Form::textarea('remarks', old('remarks'), [
						    'class' =>
						        'textarea h-20 textarea-bordered textarea-primary' . ($errors->has('remarks') ? 'border-2 border-red-600' : ''),
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
						<button type="submit" class='btn btn-accent'>Create</button>
						<a href={{ route('user.index') }} class="btn">Cancel</a>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
