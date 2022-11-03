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
				<a href="{{ route('service.edit', $getRecord()->id) }}" class="text-lg">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current">
						<path
							d="M9.243 19.002H21v2H3v-4.243l9.9-9.9 4.242 4.244-7.9 7.899h.001Zm5.07-13.556 2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242h-.001Z">
						</path>
					</svg>
					<span class="text-blue-500">
						Edit
					</span>

				</a>
			</li>
			{{-- <li class="hover-bordered">
				<a href="{{ route('user.manage', $getRecord()->id) }}" class="text-lg">
					<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</svg>
					<span class="text-blue-500">
						View
					</span>
				</a>
			</li> --}}
		</ul>
	</x-user-menu-modal>
</div>
