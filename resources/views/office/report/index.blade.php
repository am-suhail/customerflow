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
						<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
							<a href="{{ route('report.summary') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-purple-200">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-3xl font-bold text-left">Daily Summary</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="#3B82F6"
												stroke-width="2">
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

							<a href="{{ route('report.serive-summary') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-purple-200">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-3xl font-bold text-left">Service Summary</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="#3B82F6"
												stroke-width="2">
												<path d="M8.5 5.5 12 2l3.5 3.5L12 9 8.5 5.5Z"></path>
												<path d="M15 12.5 18.5 9l3.5 3.5-3.5 3.5-3.5-3.5Z"></path>
												<path d="M8.5 18.5 12 15l3.5 3.5L12 22l-3.5-3.5Z"></path>
												<path d="m2 12 3.5-3.5L9 12l-3.5 3.5L2 12Z"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="#">
								<div class="shadow rounded-lg py-6 px-5 bg-purple-200">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-3xl font-bold text-left">User Summary</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="#3B82F6"
												stroke-width="2">
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
