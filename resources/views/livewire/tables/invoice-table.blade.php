<div>
	<div class="flex flex-col items-start mb-4 space-y-4 space-x-2 lg:items-center lg:space-y-0 lg:flex-row">
		<a href="{{ route('revenue.create') }}" class="btn btn-outline btn-primary">
			<svg class="mr-1" width="25" height="25" fill="currentColor" viewBox="0 0 24 24"
				xmlns="http://www.w3.org/2000/svg">
				<path
					d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-1-11H7v2h4v4h2v-4h4v-2h-4V7h-2v4Z">
				</path>
			</svg>
			Add New
		</a>

		<a href="{{ route('revenue.import.index') }}" class="btn btn-outline btn-warning">
			<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
				stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M7 18.003a4.815 4.815 0 0 1-3.326-1.318 4.403 4.403 0 0 1-1.378-3.182c0-1.193.496-2.338 1.378-3.182A4.815 4.815 0 0 1 7 9.003c.295-1.313 1.157-2.466 2.397-3.207a5.971 5.971 0 0 1 2.025-.749 6.223 6.223 0 0 1 2.19.006c.722.131 1.408.39 2.02.76a5.36 5.36 0 0 1 1.543 1.397c.408.553.69 1.172.832 1.823.142.65.14 1.32-.007 1.97h1a3.5 3.5 0 0 1 0 7h-1">
				</path>
				<path d="m9 15 3-3 3 3"></path>
				<path d="M12 12v9"></path>
			</svg>
			Import
		</a>

		<button wire:click='export' class="btn btn-outline btn-accent">
			<svg width="25" height="25" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
				stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

				<path d="M4 7.5V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4.5"></path>
				<path d="M15.5 7.5H17"></path>
				<path d="M14 11.5h3"></path>
				<path d="M14 15.5h3"></path>
				<path d="M11 7.5H2v9h9v-9Z"></path>
				<path d="m5 10.5 3 3"></path>
				<path d="m8 10.5-3 3"></path>
			</svg>
			Export
		</button>
	</div>

	<div class="p-2">
		<hr>
		<div class="py-4">
			{{ $this->table }}
		</div>
	</div>
</div>
