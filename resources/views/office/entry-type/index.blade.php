@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<div class="flex flex-col items-start mb-4 space-y-4 space-x-2 lg:items-center lg:space-y-0 lg:flex-row">
			{{-- <a href="{{ route('expense.create') }}" class="btn btn-sm md:btn-md btn-outline btn-primary">
				<svg class="mr-1" width="25" height="25" fill="currentColor" viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg">
					<path
						d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-1-11H7v2h4v4h2v-4h4v-2h-4V7h-2v4Z">
					</path>
				</svg>
				Add New
			</a> --}}

			{{-- <a href="{{ route('expense.export') }}" class="btn btn-sm md:btn-md btn-outline btn-accent">
				<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
					stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 7.5V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4.5"></path>
					<path d="M15.5 7.5H17"></path>
					<path d="M14 11.5h3"></path>
					<path d="M14 15.5h3"></path>
					<path d="M11 7.5H2v9h9v-9Z"></path>
					<path d="m5 10.5 3 3"></path>
					<path d="m8 10.5-3 3"></path>
				</svg>
				Export
			</a> --}}

			<a href="{{ route('expense.index') }}" class="btn btn-sm md:btn-md btn-outline btn-info">
				<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
					stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M22 20.418c-2.447-2.986-4.62-4.681-6.518-5.084-1.898-.403-3.706-.464-5.423-.182V20.5L2 11.773 10.06 3.5v5.084c3.173.025 5.872 1.163 8.095 3.416 2.223 2.253 3.504 5.059 3.845 8.418Z"
						clip-rule="evenodd"></path>
				</svg>
				Go Back
			</a>
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
				<livewire:tables.entry-type-table />
			</div>
		</div>

	</main>
@endsection
