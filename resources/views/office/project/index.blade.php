@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		@can('add project')
			<div class="flex flex-col items-start mb-4 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
				<a href="{{ route('project.create') }}" class="btn btn-primary">Add New</a>
			</div>
		@endcan

		<div class="flex flex-col items-start mb-4 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
			<h6>Project Enquiries |</h6>
			<h6>Converted Projects |</h6>
		</div>

		<div class="p-2">
			<hr>
			<div class="py-4">
				<livewire:tables.project-table>
			</div>
		</div>

	</main>
@endsection
