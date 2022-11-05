@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		@include('layouts.app.flash')

		<div class="p-2">
			<div class="py-4">
				<div class="flex flex-col mb-5 bg-white">
					<div class="m-auto">
						<div class="flex flex-col px-10 py-8 bg-gray-100 rounded-md shadow-md md:px-8">
							<div class="flex flex-col items-center justify-center gap-6 md:flex-row md:gap-8">
								<svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 w-28 h-28" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
										d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
								<div class="flex flex-col text-center md:text-left">
									<div class="text-lg font-medium text-gray-800">{{ Auth::user()->name }}</div>
									<div class="text-gray-500 whitespace-nowrap">{{ Auth::user()->mobile }}</div>
									<div class="mb-3 text-gray-500 whitespace-nowrap">{{ Auth::user()->email }}</div>
									<div class="flex flex-row gap-4 mx-auto my-auto text-2xl text-gray-800 md:mx-0">
										<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-linkedin"></i></a>
										<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-facebook-square"></i></a>
										<a class="hover:cursor-pointer hover:text-blue-500"><i class="fab fa-github-square"></i></a>
									</div>
								</div>
							</div>
						</div>

						<div class="flex flex-col px-4 bg-gray-100 rounded-md shadow-md md:px-8">
							<div class="flex flex-col mb-8 gap-4 md:items-center md:flex-row md:gap-8">
								<div class="flex flex-col">
									<span>National ID</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->national_id ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span>National ID Expiry</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->national_id_expiry->format('d/m/Y') }}
									</span>
								</div>
								<div class="flex flex-col">
									<span>Sex</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->sex ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span>Date of Birth</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->dob->format('d/m/Y') }}
									</span>
								</div>
								<div class="flex flex-col">
									<span>Nationality</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->country->name ?? '--' }}
									</span>
								</div>
							</div>
							<div class="flex flex-col mb-8 gap-4 md:items-center md:flex-row md:gap-8">
								<div class="flex flex-col">
									<span>Qualification</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->qualification->name ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span>Experience</span>
									<span class="text-lg font-medium text-gray-800">
										{{ Auth::user()->user_detail->years_of_exp }} years
									</span>
								</div>
							</div>
							<div class="flex items-center mb-2 md:flex-row md:gap-8">
								<div class="flex flex-col">
									<span class="text-lg font-medium text-gray-600">
										{{ Auth::user()->user_detail->building_name ?? '--' }}
									</span>
								</div>
							</div>
							<div class="flex flex-col mb-8 gap-4 md:items-center md:flex-row md:gap-8">
								<div class="flex flex-col">
									<span class="text-lg font-medium text-gray-600">
										{{ Auth::user()->user_detail->city->state->name ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span class="text-lg font-medium text-gray-600">
										{{ Auth::user()->user_detail->city->name ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span class="text-lg font-medium text-gray-600">
										{{ Auth::user()->user_detail->area_text ?? '--' }}
									</span>
								</div>
								<div class="flex flex-col">
									<span class="text-lg font-medium text-gray-600">
										{{ Auth::user()->user_detail->street_text ?? '--' }}
									</span>
								</div>
							</div>

							<div class="flex flex-col py-4">
								<a href="{{ route('my-profile.edit', Auth::id()) }}" class="btn btn-accent">
									Edit
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>
@endsection
