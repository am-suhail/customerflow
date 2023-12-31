@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		@include('layouts.app.flash')

		<div class="p-2">
			<div class="py-4">
				<!-- component -->
				<div class="flex">
					<div class="mx-auto container align-middle">
						<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
							<a href="{{ route('admin.roles-management') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">
												Permission Management
											</h4>
										</div>
										<div>
											<svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round"
												stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M20.75 5h-3"></path>
												<path d="M13.75 3v4"></path>
												<path d="M13.75 5h-11"></path>
												<path d="M6.75 12h-4"></path>
												<path d="M10.75 10v4"></path>
												<path d="M21.75 12h-11"></path>
												<path d="M20.75 19h-3"></path>
												<path d="M13.75 17v4"></path>
												<path d="M13.75 19h-11"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('app-settings.dashboard') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Dashboard Settings</h4>
										</div>
										<div>
											<svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round"
												stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M4.222 20.778A10.966 10.966 0 0 1 1 13C1 6.925 5.925 2 12 2s11 4.925 11 11c0 3.038-1.231 5.788-3.222 7.778">
												</path>
												<path d="M7.05 17.95A7 7 0 0 1 12 6"></path>
												<path d="M12 13V9"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>

							<a href="{{ route('app-settings.finance') }}">
								<div class="shadow rounded-lg py-6 px-5 bg-gray-100">
									<div class="flex flex-row justify-between items-center">
										<div>
											<h4 class="text-black text-lg md:text-sm xl:text-xl font-bold text-left">Finance Settings</h4>
										</div>
										<div>
											<svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round"
												stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="M8.991 5.984 15.892 2 18.2 5.994l-9.208-.01Z" clip-rule="evenodd"></path>
												<path d="M2 7a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7Z"></path>
												<path d="M17.625 16.5H22v-5h-4.375C16.175 11.5 15 12.62 15 14s1.175 2.5 2.625 2.5Z"></path>
												<path d="M22 8.25v12"></path>
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
