@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<div>
			@if (session()->has('message'))
				<div class="bg-green-400 alert alert-success">
					<div class="flex">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						<label class="text-gray-800"><strong>Success!</strong> {{ session('message') }}</label>
					</div>
				</div>
			@endif
		</div>

		<livewire:tables.invoice-table>

	</main>
@endsection
