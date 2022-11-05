@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll bg-gray-50">
		<!-- Main content header -->
		<div class="flex flex-col items-start pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
			<a href="{{ route('roles.index') }}" class="mr-4 btn btn-primary btn-sm">
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
				    'route' => ['roles.store'],
				    'method' => 'POST',
				]) !!}

				<div class="form-control">
					{!! Form::label('name', 'Role', ['class' => 'label font-semibold uppercase']) !!}
					{!! Form::text('name', old('name'), [
					    'required',
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

				<div class="grid grid-cols-3 gap-4 my-4">
					@foreach ($permissions as $permission)
						<div class="p-2 rounded-lg form-control bg-base-200">
							<label class="cursor-pointer label">
								{!! Form::label('permissions', $permission->name, ['class' => 'label-text']) !!}
								{!! Form::checkbox('permissions[]', $permission->id, old('permissions'), [
								    'class' => 'checkbox
								                        checkbox-accent',
								]) !!}
								{{-- <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        class="checkbox checkbox-accent"> --}}
							</label>
						</div>
					@endforeach
				</div>

				<div class='grid grid-flow-row grid-cols-2 gap-4 mt-4 md:w-1/2'>
					<a href={{ route('roles.index') }} class="btn">Cancel</a>
					<button type="submit" class='btn btn-accent'>Create</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>

	</main>
@endsection
