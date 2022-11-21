@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-3 md:p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

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
