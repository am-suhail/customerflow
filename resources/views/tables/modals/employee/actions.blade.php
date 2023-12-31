<div class="flex justify-around space-x-1">
	<x-user-menu-modal :value="$getRecord()->id">
		<x-slot name="trigger">
			<button class="p-1 text-gray-600 hover:text-blue-500">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
			</button>
		</x-slot>
		<h1 class="mb-2 text-lg text-blue-600">{{ $getRecord()->name }}</h1>
		<hr>
		<ul class="py-4 menu">
			<li class="hover-bordered">
				<a href="{{ route('employee.edit', $getRecord()->user->id) }}" class="text-lg">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
					</svg>
					<span class="text-blue-500">
						Edit Employee
					</span>

				</a>
			</li>
			<li class="hover-bordered">
				<a href="{{ route('user.manage', $getRecord()->user->id) }}" class="text-lg">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</svg>
					<span class="text-blue-500">
						Manage Roles
					</span>
				</a>
			</li>
		</ul>
	</x-user-menu-modal>
</div>
