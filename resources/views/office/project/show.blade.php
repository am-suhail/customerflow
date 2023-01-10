@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		@include('layouts.app.flash')

		<div class="p-2">
			<div class="py-4">
				<div class="grid grid-cols-4">
					<div class="flex flex-col">
						<span class="font-bold">
							Project
						</span>
						{{ $project->name }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							Project Code
						</span>
						{{ $project->code }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							Date
						</span>
						{{ $project->inward->format('d-m-Y') }}
					</div>
				</div>

				<div class="grid grid-cols-4 mt-5">
					<div class="flex flex-col">
						<span class="font-bold">
							Vendor
						</span>
						{{ $project->vendor->name }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							Referral No
						</span>
						{{ $project->referral_no }}
					</div>
				</div>

				<div class="grid grid-cols-4 mt-5">
					<div class="flex flex-col">
						<span class="font-bold">
							Building Name
						</span>
						{{ $project->building_name }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							State
						</span>
						{{ $project->city->state->name ?? '' }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							City
						</span>
						{{ $project->city->name ?? '' }}
					</div>
				</div>

				<div class="grid grid-cols-4 mt-5">
					<div class="flex flex-col">
						<span class="font-bold">
							Area
						</span>
						{{ $project->area ?? '' }}
					</div>

					<div class="flex flex-col">
						<span class="font-bold">
							Street
						</span>
						{{ $project->street ?? '' }}
					</div>
				</div>

				<div class="grid grid-cols-4 mt-5">
					<div class="flex flex-col">
						<span class="font-bold">
							Remarks/Comments
						</span>
						{{ $project->remarks ?? '' }}
					</div>
				</div>
			</div>

			<div class="divider">Services</div>

			<div class="py-4">
				@forelse ($project->services as $service)
					<div class="grid grid-cols-3 gap-4 p-2 my-2 bg-gray-200 rounded">
						<div class="flex flex-col">
							<span class="font-bold">
								Service
							</span>
							{{ $service->service->name ?? 'NA' }}
						</div>

						<div class="flex flex-col">
							<span class="font-bold">
								Quantity
							</span>
							{{ $service->qty }}
						</div>

						<div class="flex flex-col">
							<span class="font-bold">
								Total Price
							</span>
							{{ $service->price }}
						</div>
					</div>
				@empty
					<div class="font-bold text-center">
						No Services Added.
					</div>
				@endforelse
				<div class="grid grid-cols-3 gap-4 p-2 my-2 bg-gray-200 rounded">
					<div class="flex flex-col">
						<span class="font-bold">
							Project Total
						</span>
						<span class="text-3xl font-bold text-blue-800">
							{{ $project->services->sum('price') ?? '0' }} /-
						</span>
					</div>
				</div>
			</div>

			<div class="divider">Status</div>

			<div class="py-4">
				<div class="grid grid-cols-3 gap-4 my-2">
					<div class="flex flex-col p-2 bg-green-200 rounded">
						<span class="font-bold text-gray-600">
							Current Status
						</span>
						<span class="text-3xl font-bold text-gray-800">
							{{ Str::upper($project->current_status->badge ?? 'NA') }}
						</span>
					</div>
				</div>
				@forelse ($project->status as $status)
					<div class="grid grid-cols-4 gap-4 p-2 my-2 bg-gray-200 rounded">
						<div class="flex flex-col">
							<span class="font-bold">
								Status
							</span>
							{{ $status->badge ?? '' }}
						</div>

						<div class="flex flex-col">
							<span class="font-bold">
								User
							</span>
							{{ $status->user->name ?? '' }}
						</div>

						<div class="flex flex-col">
							<span class="font-bold">
								Role
							</span>
							--
						</div>

						<div class="flex flex-col">
							<span class="font-bold">
								Date
							</span>
							{{ $status->created_at->format('d-m-Y h:i:s A') ?? '' }}
						</div>
					</div>
				@empty
					<div class="font-bold text-center">
						No status info found.
					</div>
				@endforelse
			</div>
		</div>

		<div class="p-2">
			<a class="btn" href="{{ route('project.index') }}">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
				</svg>
				Back
			</a>
		</div>

	</main>
@endsection
