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
				<x-nav.nav-link route="invoice.index">
					<x-slot name="path">
						<path
							d="M9 2.003V2h10.998C20.55 2 21 2.455 21 2.992v18.016a.993.993 0 0 1-.993.992H3.993A1 1 0 0 1 3 20.993V8l6-5.997ZM5.83 8H9V4.83L5.83 8ZM11 4v5a1 1 0 0 1-1 1H5v10h14V4h-8Z">
						</path>
					</x-slot>
					Invoice
				</x-nav.nav-link>
			@endcanany

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			@can('view products')
				<x-nav.nav-link route="service.index">
					<x-slot name="path">
						<path
							d="M4 16h16V5H4v11Zm9 2v2h4v2H7v-2h4v-2H2.992A1 1 0 0 1 2 16.993V4.007C2 3.451 2.455 3 2.992 3h18.016c.548 0 .992.449.992 1.007v12.986c0 .556-.455 1.007-.992 1.007H13Z">
						</path>
					</x-slot>
					Products
				</x-nav.nav-link>
			@endcan

			@can('view users')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="user.index">
					<x-slot name="path">
						<path
							d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5ZM4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25H4.34ZM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5 5.5 6.57 5.5 8.5 7.07 12 9 12Zm0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7Zm7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44ZM15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35Z">
						</path>
					</x-slot>
					All Users
				</x-nav.nav-link>
			@endcan

			@can('view employees')
				<x-nav.nav-link route="employee.index">
					<x-slot name="path">
						<path
							d="M12 3a5.26 5.26 0 0 0-5.25 5.25c0 1.784.908 3.363 2.273 4.313-3.079 1.2-5.273 4.2-5.273 7.687h1.5c0-3.299 2.394-6.056 5.531-6.633L11.25 15h1.5l.469-1.383c3.137.577 5.531 3.334 5.531 6.633h1.5c0-3.486-2.194-6.486-5.273-7.688A5.259 5.259 0 0 0 17.25 8.25 5.26 5.26 0 0 0 12 3Zm0 1.5c2.08 0 3.75 1.67 3.75 3.75S14.08 12 12 12s-3.75-1.67-3.75-3.75S9.92 4.5 12 4.5Zm-.75 11.25-.75 4.5h3l-.75-4.5h-1.5Z">
						</path>
					</x-slot>
					Employees
				</x-nav.nav-link>

				<x-nav.nav-link route="vendor.index">
					<x-slot name="path">
						<path d="M17 2.5H2v2h15v-2Z"></path>
						<path d="M15 15.5h2v-3h1v-2l-1-5H2l-1 5v2h1v6h9v-6h4v3Zm-6 1H4v-4h5v4Zm-5.96-6 .6-3h11.72l.6 3H3.04Z"></path>
						<path d="M23 16.5h-3v-3h-2v3h-3v2h3v3h2v-3h3v-2Z"></path>
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
