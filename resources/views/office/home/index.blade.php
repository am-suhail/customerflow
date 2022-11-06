@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Start Content -->

		@can('view products')
			<a href="{{ route('invoice.create') }}"
				class="text-white uppercase bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm xl:text-lg px-5 py-3 text-center mb-10 hover:shadow-md">
				<svg width="25" height="25" class="inline mb-1" fill="none" stroke="currentColor" stroke-linecap="round"
					stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10Z"></path>
					<path d="M12 8v8"></path>
					<path d="M8 12h8"></path>
				</svg>
				Create
				New Invoice
			</a>
		@endcan

		<!-- Statistics Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mt-10 mb-4">
			<div
				class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
						<path d="M18.75 21H5.25a.75.75 0 0 1-.75-.75V3.75A.75.75 0 0 1 5.25 3h9l5.25 5.25v12a.75.75 0 0 1-.75.75Z"></path>
						<path d="M13.875 3v5.625H19.5"></path>
						<path d="M9 12.375h6"></path>
						<path d="M9 16.125h6"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $invoice_today }}</p>
					<p>Today's Invoices</p>
				</div>
			</div>

			<div
				class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
						<path
							d="M23 12v2c0 3.314-4.925 6-11 6-5.967 0-10.824-2.591-10.995-5.823L1 14v-2c0 3.314 4.925 6 11 6s11-2.686 11-6ZM12 4c6.075 0 11 2.686 11 6s-4.925 6-11 6-11-2.686-11-6 4.925-6 11-6Z">
						</path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $amount_today }}</p>
					<p>Today's Amount</p>
				</div>
			</div>

			<div
				class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
						<path
							d="M4.5 17.625h15a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5h-15A1.5 1.5 0 0 0 3 6v10.125a1.5 1.5 0 0 0 1.5 1.5Z">
						</path>
						<path d="M15 21H9"></path>
						<path d="M3 13.875h18"></path>
						<path d="M12 18v3"></path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $service_today }}</p>
					<p>Today's Services</p>
				</div>
			</div>

			<div
				class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
				<div
					class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
					<svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
						class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
						<path
							d="m20.034 6.216-3.75-3.75a.76.76 0 0 0-.534-.216h-7.5a1.5 1.5 0 0 0-1.5 1.5v1.5h-1.5a1.5 1.5 0 0 0-1.5 1.5v13.5a1.5 1.5 0 0 0 1.5 1.5h10.5a1.5 1.5 0 0 0 1.5-1.5v-1.5h1.5a1.5 1.5 0 0 0 1.5-1.5V6.75a.76.76 0 0 0-.216-.534ZM12.75 18h-4.5a.75.75 0 1 1 0-1.5h4.5a.75.75 0 1 1 0 1.5Zm0-3h-4.5a.75.75 0 1 1 0-1.5h4.5a.75.75 0 1 1 0 1.5Zm6 2.25h-1.5v-7.5a.76.76 0 0 0-.216-.534l-3.75-3.75a.76.76 0 0 0-.534-.216h-4.5v-1.5h7.19l3.31 3.31v10.19Z">
						</path>
					</svg>
				</div>
				<div class="text-right">
					<p class="text-2xl">{{ $total_invoices }}</p>
					<p>Total Invoices</p>
				</div>
			</div>
		</div>
		<!-- ./Statistics Cards -->

		<div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-2">
			<div class="bg-base-200 rounded my-2 p-2 shadow-md">
				{!! $month_invoices_chart->container() !!}
			</div>

			<div class="bg-base-200 rounded my-2 p-2 shadow-md">
				{!! $year_invoices_chart->container() !!}
			</div>
		</div>

	</main>
@endsection

@once
	@push('scripts')
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		{!! $year_invoices_chart->script() !!}
		{!! $month_invoices_chart->script() !!}
	@endpush
@endonce
