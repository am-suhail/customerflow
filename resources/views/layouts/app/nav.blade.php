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
	<div class="flex items-center justify-between flex-shrink-0 p-2 bg-gray-800"
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
	<nav class="flex-1 overflow-y-scroll bg-gray-800 sidebar-nav-custom hover:overflow-y-auto">
		<ul class="p-2 overflow-hidden">

			<x-nav.nav-link route="home">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
				</x-slot>
				Dashboard
			</x-nav.nav-link>

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			{{-- <x-nav.nav-link route="dummy">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Project System *
			</x-nav.nav-link>

			<x-nav.nav-link route="enquiry.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
				</x-slot>
				Enquiries
			</x-nav.nav-link> --}}

			{{-- <x-nav.nav-link route="enquiry.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
				</x-slot>
				Survey
			</x-nav.nav-link> --}}

			{{-- @canany(['view projects', 'add project', 'edit project', 'delete project', 'modify project status'])
				<x-nav.nav-link route="project.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
					</x-slot>
					Projects
				</x-nav.nav-link>
			@endcanany --}}

			{{-- @canany(['view projects', 'add project', 'edit project', 'delete project', 'modify project status'])
				<x-nav.nav-link route="project.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
					</x-slot>
					Documentation
				</x-nav.nav-link>
			@endcanany --}}

			@canany(['view projects', 'add project', 'edit project', 'delete project', 'modify project status'])
				<x-nav.nav-link route="project.create">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
					</x-slot>
					Invoice
				</x-nav.nav-link>

				{{-- <x-nav.nav-link route="project.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
					</x-slot>
					Receipt
				</x-nav.nav-link> --}}
			@endcanany

			{{-- <li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			<x-nav.nav-link route="dummy">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
				</x-slot>
				My Projects
			</x-nav.nav-link>

			<x-nav.nav-link route="employees">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
				</x-slot>
				Team
			</x-nav.nav-link> --}}

			{{-- @canany(['view customers', 'add customer', 'edit customer', 'delete customer', 'view customer-info'])
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="vendor.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
					</x-slot>
					Vendors
				</x-nav.nav-link>
			@endcanany --}}

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

			@can('view products')
				<x-nav.nav-link route="service.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
					</x-slot>
					Products
				</x-nav.nav-link>
			@endcan

			{{-- @can('view products')
				<x-nav.nav-link route="service.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
					</x-slot>
					Purchase
				</x-nav.nav-link>
			@endcan --}}

			@can('view users')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				{{-- <x-nav.nav-link route="all-users">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
					</x-slot>
					HRM System *
				</x-nav.nav-link> --}}

				<x-nav.nav-link route="all-users">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
					</x-slot>
					All Users
				</x-nav.nav-link>
			@endcan

			@can('view employees')
				{{-- <x-nav.nav-link route="employees">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
					</x-slot>
					Agents
				</x-nav.nav-link> --}}

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

			{{-- @can('view employees')
				<x-nav.nav-link route="employees">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
					</x-slot>
					Investors
				</x-nav.nav-link>
			@endcan --}}

			{{-- <li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li> --}}

			{{-- <x-nav.nav-link route="leads.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Accounts *
			</x-nav.nav-link>

			<x-nav.nav-link route="leads.index">
				<x-slot name="path">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
				</x-slot>
				Payment
			</x-nav.nav-link> --}}

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Reports
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Data Settings
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master-data">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
					</x-slot>
					Company Settings
				</x-nav.nav-link>
			@endcan


			@if (Auth::user()->profile !== 'super_admin')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="my-profile.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</x-slot>
					My Profile
				</x-nav.nav-link>
			@endif

			<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-blue-800" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

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
