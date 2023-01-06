@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Statistics Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mt-10 mb-4">
			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path fill-rule="evenodd"
							d="M4.5 20.5 3 22V2l1.5 1.5L6 2l1.5 1.5L9 2l1.5 1.5L12 2l1.5 1.5L15 2l1.5 1.5L18 2l1.5 1.5L21 2v20l-1.5-1.5L18 22l-1.5-1.5L15 22l-1.5-1.5L12 22l-1.5-1.5L9 22l-1.5-1.5L6 22l-1.5-1.5ZM18 7v2H6V7h12ZM6 11v2h12v-2H6Zm0 4v2h12v-2H6Z"
							clip-rule="evenodd"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $current_year_revenue }}</p>
					<p>Current Year Revenue</p>
				</div>
			</div>

			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path d="M20.5 7 12 2 3.5 7v10l8.5 5 8.5-5V7Z"></path>
						<path d="M12 11v4"></path>
						<path d="M16 9v6"></path>
						<path d="M8 13v2"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $current_year_invoices }}</p>
					<p>Current Year Invoices</p>
				</div>
			</div>

			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path d="M20.5 7 12 2 3.5 7v10l8.5 5 8.5-5V7Z"></path>
						<path d="M12 11v4"></path>
						<path d="M16 9v6"></path>
						<path d="M8 13v2"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $previous_year_revenue }}</p>
					<p>Last Year Revenue</p>
				</div>
			</div>

			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path d="M20.5 7 12 2 3.5 7v10l8.5 5 8.5-5V7Z"></path>
						<path d="M12 11v4"></path>
						<path d="M16 9v6"></path>
						<path d="M8 13v2"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $previous_year_invoices }}</p>
					<p>Last Year Invoices</p>
				</div>
			</div>

			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10Z"></path>
						<path
							d="M2 10.42c1.507-.712 2.622-.811 3.345-.297 1.083.77 1.22 3.909 3.684 2.409 2.464-1.5-1.056-2.112-.291-4.285.764-2.174 3.266-.485 3.515-2.866.166-1.587-1.733-2.194-5.695-1.822">
						</path>
						<path
							d="M18 4c-2.857 2.494-3.855 4-2.994 4.519 1.292.777 1.84-.317 3.417 0 1.577.317 1.236 2.454.406 2.454-.829 0-5.124-.547-4.908 1.96.217 2.506 2.8 2.877 2.8 4.278 0 .933-.572 2.362-1.715 4.286">
						</path>
						<path
							d="M3.052 16.463c.456-.198.799-.344 1.028-.437 1.924-.777 3.35-.96 4.282-.55 1.646.727 1.013 2.194 1.529 2.735.515.54 1.803.383 1.803 1.411 0 .686-.23 1.46-.69 2.323">
						</path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $total_countries }}</p>
					<p>Total Countries</p>
				</div>
			</div>

			<div
				class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out">
						<path d="M17 2.5H2v2h15v-2Z"></path>
						<path d="M15 15.5h2v-3h1v-2l-1-5H2l-1 5v2h1v6h9v-6h4v3Zm-6 1H4v-4h5v4Zm-5.96-6 .6-3h11.72l.6 3H3.04Z"></path>
						<path d="M23 16.5h-3v-3h-2v3h-3v2h3v3h2v-3h3v-2Z"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $total_branches }}</p>
					<p>Total Branches</p>
				</div>
			</div>
		</div>
		<!-- ./Statistics Cards -->

		<div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-2">
			@if (!is_null($bar_chart_monthly))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $bar_chart_monthly_previous_year->container() !!}
				</div>
			@endif

			@if (!is_null($bar_chart_monthly))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $bar_chart_monthly->container() !!}
				</div>
			@endif

			@if (!is_null($bar_chart_yearly))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $bar_chart_yearly->container() !!}
				</div>
			@endif

			@if (!is_null($pie_chart_country))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $pie_chart_country->container() !!}
				</div>
			@endif

			@if (!is_null($pie_chart_state))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $pie_chart_state->container() !!}
				</div>
			@endif

			@if (!is_null($pie_chart_city))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $pie_chart_city->container() !!}
				</div>
			@endif

			@if (!is_null($pie_chart_category))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $pie_chart_category->container() !!}
				</div>
			@endif

			@if (!is_null($pie_chart_sub_category))
				<div class="bg-base-200 rounded my-2 p-2 shadow-md">
					{!! $pie_chart_sub_category->container() !!}
				</div>
			@endif
		</div>

	</main>
@endsection

@once
	@push('scripts')
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		@if (!is_null($bar_chart_monthly))
			{!! $bar_chart_monthly_previous_year->script() !!}
		@endif

		@if (!is_null($bar_chart_monthly))
			{!! $bar_chart_monthly->script() !!}
		@endif

		@if (!is_null($bar_chart_yearly))
			{!! $bar_chart_yearly->script() !!}
		@endif

		@if (!is_null($pie_chart_country))
			{!! $pie_chart_country->script() !!}
		@endif

		@if (!is_null($pie_chart_state))
			{!! $pie_chart_state->script() !!}
		@endif

		@if (!is_null($pie_chart_city))
			{!! $pie_chart_city->script() !!}
		@endif

		@if (!is_null($pie_chart_category))
			{!! $pie_chart_category->script() !!}
		@endif

		@if (!is_null($pie_chart_sub_category))
			{!! $pie_chart_sub_category->script() !!}
		@endif
	@endpush
@endonce
