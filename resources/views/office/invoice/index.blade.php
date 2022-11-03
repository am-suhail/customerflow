@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<div class="flex flex-col items-start mb-4 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
			<a href="{{ route('invoice.create') }}" class="btn btn-outline btn-primary">
				<svg class="mr-1" width="25" height="25" fill="currentColor" viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg">
					<path
						d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-1-11H7v2h4v4h2v-4h4v-2h-4V7h-2v4Z">
					</path>
				</svg>
				Add New
			</a>
		</div>

		@include('layouts.app.flash')

		<div class="p-2">
			<hr>
			<div class="py-4">
				<livewire:tables.invoice-table>
			</div>
		</div>

	</main>
@endsection
