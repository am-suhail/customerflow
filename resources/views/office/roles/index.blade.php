@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<div class="grid grid-rows-1 grid-cols-3 pb-6 mb-4 items-center space-y-0">
			<div class="">
				<a href="{{ route('master.index') }}" class="mr-4 btn btn-primary btn-sm">
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

		<div class="flex flex-col items-start mb-4 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
			<a href="{{ route('roles.create') }}" class="btn btn-outline btn-primary">
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

		<div class="py-4">
			<livewire:tables.master.roles-table>
		</div>

	</main>
@endsection
