<div class="flex justify-around space-x-1">
	<x-user-menu-modal :value="$getRecord()->id">
		<x-slot name="trigger">
			<button class="p-1 text-gray-600 hover:text-blue-500">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
			</button>
		</x-slot>
		<h1 class="mb-2 text-lg text-blue-600">{{ $getRecord()->number }}</h1>
		<hr>
		<ul class="py-4 menu">
			<li class="hover-bordered">
				<a href="{{ route('invoice.edit', $getRecord()->id) }}" class="text-lg">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current">
						<path d="M5 2h10l5 5v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1Z"></path>
						<path d="M9 9h6v3.996L9.004 13 9 9Z" clip-rule="evenodd"></path>
						<path d="M9 9v8"></path>
					</svg>
					<span class="text-blue-500">
						Edit Invoice
					</span>

				</a>
			</li>
			<li class="hover-bordered">
				<a href="{{ route('invoice.show', $getRecord()->id) }}" class="text-lg" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
						class="inline-block w-6 h-6 mr-2 text-blue-500 stroke-current">
						<path d="M5 19v3h14v-3"></path>
						<path d="M19 10V7l-4-5H5v8"></path>
						<path d="M14 2v5h5"></path>
						<path d="M21 10H3a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1Z"></path>
						<path d="M10.5 12.5v4"></path>
						<path d="M5 12.5v4"></path>
						<path d="M16 16.5v-4h2.5"></path>
						<path d="M16 15h2.5"></path>
						<path d="M5 12.5h1.75a1.25 1.25 0 0 1 0 2.5H5"></path>
						<path d="M10.5 12.5h1a2 2 0 1 1 0 4h-1"></path>
						<path d="M8 6h2"></path>
					</svg>
					<span class="text-blue-500">
						Open Pdf
					</span>

				</a>
			</li>
		</ul>
	</x-user-menu-modal>
</div>
