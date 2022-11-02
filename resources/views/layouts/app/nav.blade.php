<!-- Loading screen -->
<div x-ref="loading" class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-50"
	style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
	Loading.....
</div>
<!-- Sidebar backdrop -->
<div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
	style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
<!-- Sidebar -->
<aside x-transition:enter="transition transform duration-300"
	x-transition:enter-start="-translate-x-full opacity-30  ease-in"
	x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300"
	x-transition:leave-start="translate-x-0 opacity-100 ease-out"
	x-transition:leave-end="-translate-x-full opacity-0 ease-in"
	class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white shadow-lg lg:z-auto lg:static lg:shadow-none"
	:class="{ '-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen }">
	<!-- sidebar header -->
	<div class="flex items-center justify-between flex-shrink-0 p-2 bg-gray-700"
		:class="{ 'lg:justify-center': !isSidebarOpen }">
		<span class="p-2 text-xl font-semibold leading-8 tracking-wider text-gray-200 uppercase whitespace-nowrap">
			K<span :class="{ 'lg:hidden': !isSidebarOpen }">HULOOD - U.A.E</span>
		</span>
		<button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
			<svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
				stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
	</div>
	<!-- Sidebar links -->
	<nav class="flex-1 overflow-y-scroll bg-gray-700 sidebar-nav-custom hover:overflow-y-auto">

		<ul class="p-2 overflow-hidden menu" x-data="{ selected: 1 }">
			<!-- dropdown -->
			{{-- <li class="font-normal rounded-md" :class="{ 'border-l-4 border-red-500 bg-gray-200': selected == 3 }">
				<a @click="selected !== 3 ? selected = 3 : selected = null" :class="{ 'text-cyan-500 bg-slate-700': selected == 3 }"
					class="block py-2.5 px-6 rounded hover:bg-slate-700 hover:text-cyan-500" href="javascript:void(0)">

					<svg class="mr-1 w-6 h-6 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor"
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg">
						<path d="M9 4H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z"></path>
						<path d="M9 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1Z"></path>
						<path d="M19 14h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1Z"></path>
						<path d="M14 7h6"></path>
						<path d="M17 4v6"></path>
					</svg>
					<span class="text-white sidebar-small-text">Apps</span>
					<!-- caret -->
					<svg class="transform transition duration-300 bx bx-chevron-down -rotate-90 inline-block float-right"
						:class="{ 'rotate-0': selected == 3, '-rotate-90': !(selected == 3) }" width="25" height="25"
						fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg">
						<path d="m6 9 6 6 6-6"></path>
					</svg>
				</a>

				<!-- dropdown menu -->
				<ul x-show="selected == 3" x-transition:enter="transition-all duration-200 ease-out"
					x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
					class="block rounded rounded-t-none top-full z-50 pl-2 py-0.5 text-left mb-1 font-normal" style="display: none;">
					<li class="relative">
						<a class="text-white block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-cyan-500"
							href="app-calendar.html">Calendar</a>
					</li>
					<li class="relative">
						<a class="text-white block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-cyan-500"
							href="app-kanban.html">Kanban</a>
					</li>
					<li class="relative">
						<a class="text-white block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-cyan-500"
							href="app-invoice.html">Invoice</a>
					</li>
					<li class="relative">
						<a
							class="flex flex-row justify-between items-center w-full py-2 px-6 clear-both whitespace-nowrap hover:text-cyan-500"
							href="ilustration.html">Ilustrations <i class="text-xs px-0.5 rounded text-cyan-700 bg-cyan-100">Bonus</i></a>
					</li>
				</ul>
			</li> --}}

			<x-nav.nav-link route="home">
				<x-slot name="path">
					<path
						d="M12.261 4.745a.375.375 0 0 0-.518 0l-8.63 8.244a.374.374 0 0 0-.115.271l-.002 7.737a1.5 1.5 0 0 0 1.5 1.5h4.505a.75.75 0 0 0 .75-.75v-6.375a.375.375 0 0 1 .375-.375h3.75a.375.375 0 0 1 .375.375v6.375a.75.75 0 0 0 .75.75h4.503a1.5 1.5 0 0 0 1.5-1.5V13.26a.374.374 0 0 0-.116-.271L12.26 4.745Z">
					</path>
					<path
						d="M23.011 11.444 19.505 8.09V3a.75.75 0 0 0-.75-.75h-2.25a.75.75 0 0 0-.75.75v1.5L13.04 1.904c-.254-.257-.632-.404-1.04-.404-.407 0-.784.147-1.038.405l-9.97 9.539a.765.765 0 0 0-.063 1.048.749.749 0 0 0 1.087.05l9.726-9.294a.375.375 0 0 1 .519 0l9.727 9.294a.75.75 0 0 0 1.059-.02c.288-.299.264-.791-.036-1.078Z">
					</path>
				</x-slot>
				Dashboard
			</x-nav.nav-link>

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			@canany(['view projects', 'add project', 'edit project', 'delete project', 'modify project status'])
				<x-nav.nav-link route="project.create">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
					</x-slot>
					Invoice
				</x-nav.nav-link>
			@endcanany

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			@can('view products')
				<x-nav.nav-link route="service.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
					</x-slot>
					Products
				</x-nav.nav-link>
			@endcan

			@can('view users')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="all-users">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
					</x-slot>
					All Users
				</x-nav.nav-link>
			@endcan

			@can('view employees')
				<x-nav.nav-link route="employees">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
					</x-slot>
					Employees
				</x-nav.nav-link>

				<x-nav.nav-link route="vendor.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
					</x-slot>
					Customers
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Reports
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Data Settings
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Company Settings
				</x-nav.nav-link>
			@endcan


			@if (Auth::user()->profile !== 'super_admin')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="my-profile.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</x-slot>
					My Profile
				</x-nav.nav-link>
			@endif

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			<x-nav.nav-link route="dummy">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				CRM System *
			</x-nav.nav-link>
			<x-nav.nav-link route="leads.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Market Leads
			</x-nav.nav-link>

			<x-nav.nav-link route="leads.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Follow Ups
			</x-nav.nav-link>

			<x-nav.nav-link route="leads.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Email Templates
			</x-nav.nav-link>
		</ul>
	</nav>

	<!-- Sidebar footer -->
	<div class="flex-shrink-0 p-1 border-t max-h-14">
		<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
			class="p-1 btn btn-block btn-accent">
			<span>
				<svg class="w-6 h-6 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
				</svg>
			</span>
			<span :class="{ 'lg:hidden': !isSidebarOpen }">
				Logout
			</span>
		</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	</div>
</aside>
