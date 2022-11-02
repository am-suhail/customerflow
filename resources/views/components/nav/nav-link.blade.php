@props(['path', 'disabled'])

<li @class([
	'font-normal rounded-md',
	'border-l-8 border-green-500 bg-gray-100' => Request::routeIs($route),
])>
	<a href="{{ route($route) }}" @class(['flex items-center p-2 space-x-2 group']) :class="{ 'justify-center': !isSidebarOpen }">
		<span>
			<svg @class([
				'w-6 h-6 text-gray-300 group-hover:text-green-500',
				'text-green-600' => Request::routeIs($route),
			]) fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
				viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				{{ $path }}
			</svg>
		</span>
		<span :class="{ 'lg:hidden': !isSidebarOpen }" @class([
			'text-gray-100 group-hover:text-green-500',
			'text-green-600 font-bold' => Request::routeIs($route),
		])>
			{{ $slot }}
		</span>
	</a>
</li>
