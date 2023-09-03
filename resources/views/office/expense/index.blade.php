@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<div class="mb-1 flex flex-col-reverse gap-2 md:flex-row justify-between">
			<div class="bg-base-200 md:bg-white py-2 px-5 md:px-2 rounded-3xl md:rounded-none flex gap-3">
				<div class="border border-gray-300 bg-gray-100 px-4 py-2 rounded">
					<div class="flex items-center">
						<div class="mr-5">
							<svg class="text-blue-600" width="30" height="30" fill="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2Zm.002 16H5V8h14l.002 12Z">
								</path>
								<path d="m11 17.418 5.707-5.707-1.414-1.414L11 14.59l-2.293-2.293-1.414 1.414L11 17.418Z"></path>
							</svg>
						</div>
						<div>
							<h1 class="text-xs font-semibold">
								Current Month Expense ({{ date('M') }})
							</h1>
							<h1 class="text-2xl font-bold">
								{{ number_format($current_month_expense) }}
							</h1>
						</div>
					</div>
				</div>
				<div class="border border-gray-300 bg-gray-100 px-4 py-2 rounded">
					<div class="flex items-center">
						<div class="mr-5">
							<svg class="text-green-600" width="30" height="30" fill="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M7 11h2v2H7v-2Zm0 4h2v2H7v-2Zm4-4h2v2h-2v-2Zm0 4h2v2h-2v-2Zm4-4h2v2h-2v-2Zm0 4h2v2h-2v-2Z"></path>
								<path
									d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2ZM19 8l.001 12H5V8h14Z">
								</path>
							</svg>
						</div>
						<div>
							<h1 class="text-xs font-semibold">
								Current Year Expense ({{ date('Y') }})
							</h1>
							<h1 class="text-2xl font-bold">
								{{ number_format($current_year_expense) }}
							</h1>
						</div>
					</div>
				</div>
			</div>

			<div class="">
				<div class="bg-base-200 p-2 rounded-3xl flex gap-2 overflow-x-auto">
					<a href="{{ route('expense.create') }}" class="btn btn-outline btn-sm btn-primary rounded-3xl">
						<svg class="mr-1" width="25" height="25" fill="currentColor" viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-1-11H7v2h4v4h2v-4h4v-2h-4V7h-2v4Z">
							</path>
						</svg>
						Add New
					</a>

					<a href="{{ route('expense.import.index') }}"
						class="btn btn-outline btn-sm border-emerald-700 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-transparent rounded-3xl">
						<svg class="mr-1" width="25" height="25" fill="currentColor" viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M13 19v-4h3l-4-5-4 5h3v4h2Z"></path>
							<path
								d="M7 19h2v-2H7c-1.654 0-3-1.346-3-3 0-1.404 1.199-2.756 2.673-3.015l.581-.102.192-.558C8.149 8.274 9.895 7 12 7c2.757 0 5 2.243 5 5v1h1c1.103 0 2 .897 2 2s-.897 2-2 2h-3v2h3c2.206 0 4-1.794 4-4a4.01 4.01 0 0 0-3.056-3.888C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.611 5.757 9.15 3.609 9.792 2 11.82 2 14c0 2.757 2.243 5 5 5Z">
							</path>
						</svg>
						Import
					</a>

					<a href="{{ route('expense.export') }}" class="btn btn-outline btn-sm btn-accent rounded-3xl">
						<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
							stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

							<path d="M4 7.5V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4.5"></path>
							<path d="M15.5 7.5H17"></path>
							<path d="M14 11.5h3"></path>
							<path d="M14 15.5h3"></path>
							<path d="M11 7.5H2v9h9v-9Z"></path>
							<path d="m5 10.5 3 3"></path>
							<path d="m8 10.5-3 3"></path>
						</svg>
						Export
					</a>

					<a href="{{ route('entry-type.index', 'expense') }}" class="btn btn-outline btn-sm rounded-3xl btn-info">
						<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M13 5h8"></path>
							<path d="M13 9h5"></path>
							<path d="M13 15h8"></path>
							<path d="M13 19h5"></path>
							<path d="M8 4H4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z"></path>
							<path d="M8 14H4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1Z"></path>
						</svg>
						Expense Type
					</a>
				</div>
			</div>
		</div>

		<div>
			@if (session()->has('message'))
				<div class="bg-green-400 alert alert-success">
					<div class="flex">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<label class="text-gray-800"><strong>Success!</strong> {{ session('message') }}</label>
					</div>
				</div>
			@endif
		</div>


		<div class="p-2">
			<hr>
			<div class="py-4">
				<livewire:tables.expense-table>
			</div>
		</div>

	</main>
@endsection
