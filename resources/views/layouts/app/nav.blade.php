<!-- Loading screen -->
<div x-ref="loading" class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-50"
	style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
	Loading.....
</div>
<!-- Sidebar backdrop -->
<div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
	style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
<!-- Sidebar -->
<aside id="sidebar" x-transition:enter="transition transform duration-300"
	x-transition:enter-start="-translate-x-full opacity-30  ease-in"
	x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300"
	x-transition:leave-start="translate-x-0 opacity-100 ease-out"
	x-transition:leave-end="-translate-x-full opacity-0 ease-in"
	class="fixed inset-y-0 z-50 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white shadow-lg lg:z-auto lg:static lg:shadow-none"
	:class="{ '-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen }">
	<!-- sidebar header -->
	<div class="flex items-center justify-between flex-shrink-0 p-2 bg-gray-700"
		:class="{ 'lg:justify-center': !isSidebarOpen }">
		<span class="p-2 md:text-xl font-semibold leading-8 tracking-wider text-gray-200 uppercase whitespace-nowrap">
			<span :class="{ 'lg:hidden': !isSidebarOpen }">{{ Str::limit($general_settings->company_name, 15, '..') }}</span>
		</span>
		<button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
			<svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
				stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
	</div>
	<!-- Sidebar links -->
	<nav class="flex-1 overflow-y-scroll bg-gray-700 sidebar-nav-custom hover:overflow-y-auto" id="sidebarNav">
		<ul class="p-2 overflow-hidden menu" x-data="{ selected: 1 }">
			@can('dashboard primary')
				<x-nav.nav-link route="home">
					<x-slot name="path">
						<path d="M5 12H3l9-9 9 9h-2"></path>
						<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7"></path>
						<path d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6"></path>
					</x-slot>
					Dashboard
				</x-nav.nav-link>
			@endcan


			@canany(['view revenue', 'add revenue', 'edit revenue', 'delete revenue'])
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="revenue.index">
					<x-slot name="path">
						<path d="M20 6H9"></path>
						<path d="M20 12h-7"></path>
						<path d="M20 18H9"></path>
						<path d="m4 8 4 4-4 4"></path>
					</x-slot>
					Revenue
				</x-nav.nav-link>
			@endcanany

			@canany(['view expense', 'add expense', 'edit expense', 'delete expense'])
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M18 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z"></path>
						<path d="m4.6 19.402 14.8-14.8"></path>
						<path d="M9 7v4M7 9h4-4Z"></path>
						<path d="M13 16h4"></path>
					</x-slot>
					Expense
				</x-nav.nav-link>
			@endcanany

			@canany(['view expense', 'add expense', 'edit expense', 'delete expense'])
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M18 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z"></path>
						<path d="m4.6 19.402 14.8-14.8"></path>
						<path d="M9 7v4M7 9h4-4Z"></path>
						<path d="M13 16h4"></path>
					</x-slot>
					Payment
				</x-nav.nav-link>
			@endcanany

			@canany(['view asset', 'add asset', 'edit asset', 'delete asset'])
				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M19 7H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"></path>
						<path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
						<path d="M12 12v.01"></path>
						<path d="M3 13a20 20 0 0 0 18 0"></path>
					</x-slot>
					Asset
				</x-nav.nav-link>
			@endcanany

			@canany(['view liability', 'add liability', 'edit liability', 'delete liability'])
				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M17 10h4v4"></path>
						<path d="M3 12.001c.887-1.284 2.48-2.033 4-2 1.52-.033 3.113.716 4 2s2.48 2.033 4 2c1.52.033 3-1 4-2l2-2"></path>
					</x-slot>
					Liability
				</x-nav.nav-link>
			@endcanany

			@canany(['view liability', 'add liability', 'edit liability', 'delete liability'])
				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M17 10h4v4"></path>
						<path d="M3 12.001c.887-1.284 2.48-2.033 4-2 1.52-.033 3.113.716 4 2s2.48 2.033 4 2c1.52.033 3-1 4-2l2-2"></path>
					</x-slot>
					Investment Cost
				</x-nav.nav-link>
			@endcanany

			@canany(['view budget', 'add budget', 'edit budget', 'delete budget'])
				<x-nav.nav-link route="dummy">
					<x-slot name="path">
						<path d="M16 9c2.761 0 5-1.343 5-3s-2.239-3-5-3-5 1.343-5 3 2.239 3 5 3Z"></path>
						<path d="M11 6v4c0 1.657 2.239 3 5 3s5-1.343 5-3V6"></path>
						<path d="M11 10v4c0 1.657 2.239 3 5 3s5-1.343 5-3v-4"></path>
						<path d="M11 14v4c0 1.657 2.239 3 5 3s5-1.343 5-3v-4"></path>
						<path d="M7 9H4.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 1 1 0 3H3"></path>
						<path d="M5 8v1m0 6v1-1Z"></path>
					</x-slot>
					Budget
				</x-nav.nav-link>
			@endcanany

			@canany(['view users', 'manage user'])
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>

				<x-nav.nav-link route="user.index">
					<x-slot name="path">
						<path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
						<path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
						<path d="M16 3.133a4 4 0 0 1 0 7.75"></path>
						<path d="M21 20.998v-2a4 4 0 0 0-3-3.85"></path>
					</x-slot>
					All Users
				</x-nav.nav-link>
			@endcanany

			@canany(['view employees', 'manage employee'])
				<x-nav.nav-link route="employee.index">
					<x-slot name="path">
						<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
						<path d="M8.5 3a4 4 0 1 0 0 8 4 4 0 1 0 0-8z"></path>
						<path d="m17 11 2 2 4-4"></path>
					</x-slot>
					Employees
				</x-nav.nav-link>
			@endcanany

			@canany(['view branches', 'add branch', 'edit branch', 'delete branch'])
				<x-nav.nav-link route="company.index">
					<x-slot name="path">
						<path d="M3 21h18"></path>
						<path d="M5 21V7l8-4v18"></path>
						<path d="M19 21V11l-6-4"></path>
						<path d="M9 9v.01"></path>
						<path d="M9 12v.01"></path>
						<path d="M9 15v.01"></path>
						<path d="M9 18v.01"></path>
					</x-slot>
					Company
				</x-nav.nav-link>
			@endcanany

			@canany(['view branches', 'add branch', 'edit branch', 'delete branch'])
				<x-nav.nav-link route="branch.index">
					<x-slot name="path">
						<path d="M3 21h18"></path>
						<path d="M5 21V7l8-4v18"></path>
						<path d="M19 21V11l-6-4"></path>
						<path d="M9 9v.01"></path>
						<path d="M9 12v.01"></path>
						<path d="M9 15v.01"></path>
						<path d="M9 18v.01"></path>
					</x-slot>
					Branches
				</x-nav.nav-link>
			@endcanany

			@can('view reports')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="report.index">
					<x-slot name="path">
						<path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
						<path d="M13 3h-2a2 2 0 1 0 0 4h2a2 2 0 1 0 0-4Z"></path>
						<path d="M9 17v-5"></path>
						<path d="M12 17v-1"></path>
						<path d="M15 17v-3"></path>
					</x-slot>
					Reports
				</x-nav.nav-link>
			@endcan

			@can('modify master data')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="master.index">
					<x-slot name="path">
						<path d="M4 6v6s0 3 7 3 7-3 7-3V6"></path>
						<path d="M11 3c7 0 7 3 7 3s0 3-7 3-7-3-7-3 0-3 7-3Z"></path>
						<path d="M11 21c-7 0-7-3-7-3v-6"></path>
						<path d="M19 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"></path>
						<path stroke-dasharray="0.3 2" d="M19 22a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
					</x-slot>
					Data Settings
				</x-nav.nav-link>
			@endcan

			@can('modify app settings')
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="app-settings.index">
					<x-slot name="path">
						<path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"></path>
						<path d="m12 12.002-3 5.197m9-5.197h-6 6ZM9 6.805l3 5.197-3-5.197Z"></path>
						<path stroke-dasharray="1 3" d="M12 19a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"></path>
						<path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10Z"></path>
						<path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
					</x-slot>
					App Settings
				</x-nav.nav-link>
			@endcan


			@if (Auth::user()->profile !== 1991)
				<li class="p-1 mt-4 mb-2 text-xs border-t-2 border-gray-600" :class="{ 'lg:p-0': !isSidebarOpen }"></li>
				<x-nav.nav-link route="my-profile.index">
					<x-slot name="path">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</x-slot>
					My Profile
				</x-nav.nav-link>
			@endif
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

@push('scripts')
	<script>
		let sidebar = document.getElementById('sidebarNav');
		let pagePoint = sessionStorage.getItem('sidebar-scroll');

		if (pagePoint !== null) {
			sidebar.scrollTop = parseInt(pagePoint, 10);
		}

		window.addEventListener('beforeunload', () => {
			sessionStorage.setItem('sidebar-scroll', sidebar.scrollTop);
		})
	</script>
@endpush
