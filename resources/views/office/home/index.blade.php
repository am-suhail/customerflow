@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Start Content -->

		<div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-4">

			{{-- 
				Invoice Button 
				Total Invoice Today
				Today Amount
				Graph
				Live Service
				Live Product
				--}}

			@can('view products')
				<x-stats-card title="Create Invoice" color="bg-green-300" number="0" route="service.index">
					<x-stats-card.info-icon>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
					</x-stats-card.info-icon>
				</x-stats-card>
			@endcan

			@can('view products')
				<x-stats-card title="Today's Invoice" color="bg-green-300" number="0" route="service.index">
					<x-stats-card.info-icon>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
					</x-stats-card.info-icon>
				</x-stats-card>
			@endcan

			@can('view customers')
				<x-stats-card title="Today's Amount" color="bg-blue-300" number="0" route="vendor.index">
					<x-stats-card.info-icon>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
					</x-stats-card.info-icon>
				</x-stats-card>
			@endcan

			@can('view agents')
				<x-stats-card title="Today's Services" color="bg-yellow-600 bg-opacity-60">
					<x-stats-card.info-icon>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
					</x-stats-card.info-icon>
				</x-stats-card>
			@endcan

			@can('view leads')
				<x-stats-card title="Total Invoices" color="bg-pink-700 bg-opacity-60" number="0" route="leads.index">
					<x-stats-card.info-icon>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
					</x-stats-card.info-icon>
				</x-stats-card>
			@endcan
		</div>

	</main>
@endsection
