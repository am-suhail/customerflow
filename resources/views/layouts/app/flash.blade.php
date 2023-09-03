@php
	$errors = Session::get('error');
	$messages = Session::get('success');
	$info = Session::get('info');
	$warnings = Session::get('warning');
@endphp
@if ($errors)
	@foreach ($errors as $key => $value)
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button class="close" type="button" data-dismiss="alert">×</button>
			<strong>Error!</strong> {{ $value }}
		</div>
	@endforeach
@endif

@if ($messages)
	@foreach ($messages as $key => $value)
		<div class="bg-green-400 alert alert-success">
			<div class="flex">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				<label class="text-gray-800"><strong>Success!</strong> {{ $value }}</label>
			</div>
		</div>
	@endforeach
@endif

@if ($info)
	@foreach ($info as $key => $value)
		<div class="bg-blue-400 alert alert-info">
			<div class="flex">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				<label class="text-gray-800"><strong>Info!</strong> {{ $value }}</label>
			</div>
		</div>
	@endforeach
@endif

@if ($warnings)
	@foreach ($warnings as $key => $value)
		<div class="bg-orange-300 alert alert-warning">
			<div class="flex">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				<label class="text-gray-800"><strong>Warning!</strong> {{ $value }}</label>
			</div>
		</div>
	@endforeach
@endif
