<div>
	<div class="md:grid md:grid-cols-4">
		<div class="border border-gray-50 p-2">
			Company
		</div>
		<div class="border border-gray-50 p-2">
			Revenue
		</div>
		<div class="border border-gray-50 p-2">
			Expense
		</div>
		<div class="border border-gray-50 p-2">
			Profit
		</div>
	</div>
	@forelse ($companies as $company)
		<div class="grid md:grid-cols-4 rounded md:rounded-none md:bg-transparent bg-gray-200 my-1 md:my-0">
			<div class="border border-gray-50 p-2 font-bold">
				{{ $company->name ?? '--' }}
			</div>
			<div class="border border-gray-50 p-2">
				<span class="md:hidden">
					Revenue:
				</span>
				00
			</div>
			<div class="border border-gray-50 p-2">
				<span class="md:hidden">
					Expense:
				</span>
				00
			</div>
			<div class="border border-gray-50 p-2">
				<span class="md:hidden">
					Profit:
				</span>
				00
			</div>
		</div>
	@empty
		<div class="grid grid-cols-1">
			<div class="border border-gray-50 p-2">
				Nothing to Show
			</div>
		</div>
	@endforelse
</div>
