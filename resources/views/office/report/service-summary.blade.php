@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		@include('layouts.app.flash')

		<div class="p-2">
			<hr>
			<div class="py-4">
				<livewire:tables.reports.service-summary-table />
			</div>
		</div>

	</main>
@endsection
