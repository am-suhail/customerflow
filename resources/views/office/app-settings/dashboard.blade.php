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
			<form action="{{ route('app-settings.update-dashboard') }}" method="POST">
				@csrf
				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Bar Chart: Current Year - Monthly
					</label>
					<input type="checkbox" name="bar_chart_monthly" class="checkbox checkbox-success" @checked($dashboard_settings->bar_chart_monthly) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Bar Chart: Yearly
					</label>
					<input type="checkbox" name="bar_chart_yearly" class="checkbox checkbox-success" @checked($dashboard_settings->bar_chart_yearly) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Pie Chart: Country Wise
					</label>
					<input type="checkbox" name="pie_chart_country" class="checkbox checkbox-success" @checked($dashboard_settings->pie_chart_country) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Pie Chart: State Wise
					</label>
					<input type="checkbox" name="pie_chart_state" class="checkbox checkbox-success" @checked($dashboard_settings->pie_chart_state) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Pie Chart: City Wise
					</label>
					<input type="checkbox" name="pie_chart_city" class="checkbox checkbox-success" @checked($dashboard_settings->pie_chart_city) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Pie Chart: Category Wise
					</label>
					<input type="checkbox" name="pie_chart_category" class="checkbox checkbox-success" @checked($dashboard_settings->pie_chart_category) />
				</div>

				<div class="flex flex-col md:flex-row md:items-center mb-5">
					<label for="name" class="label mr-6 inline-block font-semibold md:text-right basis-1/3">
						Pie Chart: Sub Category Wise
					</label>
					<input type="checkbox" name="pie_chart_sub_category" class="checkbox checkbox-success"
						@checked($dashboard_settings->pie_chart_sub_category) />
				</div>

				<div class="text-right">
					<button class="btn btn-accent">Save</button>
				</div>
			</form>
		</div>
	</main>
@endsection
