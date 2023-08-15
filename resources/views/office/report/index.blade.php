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
											<svg class="w-10 h-10 xl:w-12 xl:h-12" fill="none" stroke="#3B82F6" stroke-linecap="round"
												stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M3 21h18"></path>
												<path d="M9 8h1"></path>
												<path d="M9 12h1"></path>
												<path d="M9 16h1"></path>
												<path d="M14 8h1"></path>
												<path d="M14 12h1"></path>
												<path d="M14 16h1"></path>
												<path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('report.branch') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Branch Report</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M12 7 9.5 9.5 12 12l2.5-2.5L12 7Z"></path>
												<path d="m12 14-2.5 2.5L12 19l2.5-2.5L12 14Z"></path>
												<path d="m19 7-2.5 2.5L19 12l2.5-2.5L19 7Z"></path>
												<path d="M5 7 2.5 9.5 5 12l2.5-2.5L5 7Z"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="#">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Income Statement</h4>
										</div>
										<div>
											<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 xl:w-12 xl:h-12" fill="none" viewBox="0 0 24 24"
												stroke="#3B82F6" stroke-width="2">
												<path d="M12 7 9.5 9.5 12 12l2.5-2.5L12 7Z"></path>
												<path d="m12 14-2.5 2.5L12 19l2.5-2.5L12 14Z"></path>
												<path d="m19 7-2.5 2.5L19 12l2.5-2.5L19 7Z"></path>
												<path d="M5 7 2.5 9.5 5 12l2.5-2.5L5 7Z"></path>
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
