@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Start Content -->

		@can('view products')
			<button class="btn btn-accent">Button</button>
		@endcan

		<!-- Statistics Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 my-4">
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
					<p class="text-2xl">0</p>
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
					<p class="text-2xl">0</p>
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
					<p class="text-2xl">0</p>
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
					<p class="text-2xl">0</p>
					<p>Total Invoices</p>
				</div>
			</div>
		</div>
		<!-- ./Statistics Cards -->

		<div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">
			{{-- 
				Invoice Button 
				Total Invoice Today
				Today Amount
				Graph
				Live Service
				Live Product
				--}}
		</div>

	</main>
@endsection
