@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-3 md:p-5 overflow-hidden overflow-y-scroll">
		<!-- Main content header -->
		<x-headers.page-heading :title="$pageTitle" />

		<!-- Start Content -->

		<div class="px-2 md:px-10 py-5 mt-5 overflow-x-auto bg-gray-100 rounded shadow">
			<table class="w-full">
				<tbody>
					<!-- Location -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Location Settings
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Add, Edit or Delete location data: State, City, Area
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.location') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Qualification -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Qualification
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage education qualification
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.qualification') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Designation -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Designation
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage designations
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.designation') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Roles & Permission -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Roles & Permissions
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage user's roles and their permissions
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('roles.index') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Industry -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Industry
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage industries
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.industry') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Categories -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Revenue Categories
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage revenue categories
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.category') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Categories -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Expense Categories
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage expense categories
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.expense-category') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Revenue Type -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Revenue Type
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage Revenue Type
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.revenue-type') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Categories -->
					<div class="border-b border-gray-300 grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Company Categories
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage company categories
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.company-category') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>

					<!-- Tax Settings -->
					<div class="grid grid-cols-3 py-2">
						<div class="text-black col-span-3 md:col-span-1">
							Tax Type
						</div>
						<div class="text-gray-400 col-span-3 md:col-span-1">
							Manage tax settings
						</div>
						<div class="col-span-3 md:col-span-1 mt-2 md:mt-0">
							<a href="{{ route('master.tax-settings') }}" class="md:float-right text-blue-600 hover:text-blue-400">
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
					</div>
				</tbody>
			</table>
		</div>
	</main>
@endsection
