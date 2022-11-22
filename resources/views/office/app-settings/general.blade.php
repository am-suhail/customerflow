@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-3 md:p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 border-b items-center space-y-0">
			<div class="">
				<a href="{{ route('app-settings.index') }}" class="mr-4 btn btn-primary btn-sm md:btn-md">
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

		<!-- Start Content -->
		<div class="px-2 md:px-10 py-5 mt-5 overflow-x-auto bg-gray-100 rounded shadow">
			<form action="{{ route('app-settings.update-general') }}" method="POST">
				@csrf
				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Application/Company Name
					</label>
					<input type="text" id="company_name" name="company_name" placeholder="Company Name"
						class="input input-bordered basis-1/2" value="{{ old('company_name', $general_settings->company_name) }}">
				</div>

				<div class="text-right">
					<button class="btn btn-accent">Save</button>
				</div>
			</form>
		</div>
	</main>
@endsection
