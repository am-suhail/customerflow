<header class="flex-shrink-0 border-b shadow-sm">
	<div class="flex items-center justify-between py-2 pr-4">
		<!-- Navbar left -->
		<div class="flex items-center space-x-3">
			<!-- Toggle sidebar button -->
			<button @click="toggleSidbarMenu()"
				class="h-full p-4 transform -translate-x-2 md:-translate-x-1 bg-gray-700 rounded-md">
				<svg class="w-4 h-4 text-white" :class="{ 'transform transition-transform -rotate-180': isSidebarOpen }"
					xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
				</svg>
			</button>
		</div>

		<div class="px-2">
			<img src="{{ asset('img/logo.png') }}" style="width:200px" alt="">
		</div>

		<!-- Navbar right -->
		<div class="relative flex items-center space-x-1">
			<!-- User Menu -->
			<h6 class="font-bold">{{ Str::limit(Auth::user()->name, 10, '..') }}</h6>
			<div class="relative" x-data="{ isOpen: false }">
				<button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</button>
				<!-- green dot -->
				<div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
				<div class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3"></div>

				<div @click.away="isOpen = false" x-show.transition.opacity="isOpen"
					class="absolute z-50 w-48 max-w-md mt-3 transform bg-white rounded-md shadow-lg -translate-x-3/4 min-w-max">
					<div class="flex flex-col p-4 space-y-1 font-medium border-b">
						<span class="text-gray-800">{{ Auth::user()->name }}</span>
						<span class="text-sm text-gray-400">{{ Auth::user()->email }}</span>
					</div>
					<div class="flex justify-center py-2 text-blue-500 border-t ">

						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
							class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
							<button class="btn btn-sm btn-info">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
								</svg>
								Logout
							</button>
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
