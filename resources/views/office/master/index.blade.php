@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<!-- Start Content -->

		<div class="w-3/4 px-10 py-5 mt-5 overflow-x-auto bg-gray-100 rounded shadow">
			<table class="w-full">
				<tbody>
					<!-- Location -->
					<tr class="border-b border-gray-300">
						<td>
							<div class="py-2 text-black">
								Location Settings
							</div>
						</td>
						<td class="text-gray-400">Add, Edit or Delete location data: State, City, Area</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('master.location') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>

					<!-- Qualification -->
					<tr class="border-b border-gray-300">
						<td>
							<div class="py-2 text-black">
								Qualification
							</div>
						</td>
						<td class="text-gray-400">
							Manage education qualification field for employees and agent
							registration
						</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('master.qualification') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>

					<!-- Designation -->
					<tr class="border-b border-gray-300">
						<td>
							<div class="py-2 text-black">
								Designation
							</div>
						</td>
						<td class="text-gray-400">
							Manage employee's designation data
						</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('master.designation') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>

					<!-- Roles & Permission -->
					<tr class="border-b border-gray-300">
						<td>
							<div class="py-2 text-black">
								Roles & Permissions
							</div>
						</td>
						<td class="text-gray-400">
							Manage user's roles and their permissions
						</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('roles.index') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>

					<!-- Industry -->
					<tr class="border-b border-gray-300">
						<td>
							<div class="py-2 text-black">
								Industry
							</div>
						</td>
						<td class="text-gray-400">
							Manage industries that vendors can belongs to
						</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('master.industry') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>

					<!-- Categories -->
					<tr class="">
						<td>
							<div class="py-2 text-black">
								Categories
							</div>
						</td>
						<td class="text-gray-400">
							Manage service & vendor categories
						</td>
						<td class="float-right">
							<div class="py-2">
								<a href="{{ route('master.category') }}" class="text-blue-600 hover:text-blue-400">
									<span class="flex items-center">
										<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
											<path fill-rule="evenodd"
												d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
												clip-rule="evenodd" />
										</svg>
										Manage
									</span>
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</main>
@endsection
