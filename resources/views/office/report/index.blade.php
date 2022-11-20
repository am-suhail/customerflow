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
				<!-- component -->
				<div class="flex">
					<div class="mx-auto container align-middle">
						<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
							<a href="{{ route('report.country') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Country Report</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M2 5a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5Z"></path>
												<path d="M2 8h20"></path>
												<path d="M13.5 16H18"></path>
												<path d="M22 5v8"></path>
												<path d="M2 5v8"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('report.category') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Category Report</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M3 3v18h18"></path>
												<path d="M7 15v2"></path>
												<path d="M11 11v6"></path>
												<path d="M15 3v14"></path>
												<path d="M19 7v10"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('report.company') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Company Report</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M8.5 5.5 12 2l3.5 3.5L12 9 8.5 5.5Z"></path>
												<path d="M15 12.5 18.5 9l3.5 3.5-3.5 3.5-3.5-3.5Z"></path>
												<path d="M8.5 18.5 12 15l3.5 3.5L12 22l-3.5-3.5Z"></path>
												<path d="m2 12 3.5-3.5L9 12l-3.5 3.5L2 12Z"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('report.company') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">User Summary</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M12 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
												<path d="M21 22a9 9 0 1 0-18 0"></path>
												<path d="m15 18-4 4-2-2"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
