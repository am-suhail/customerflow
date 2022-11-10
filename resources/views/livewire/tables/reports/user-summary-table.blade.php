<div>
	<div class="flex justify-between mb-5">
		<div class="flex flex-col">
			<div class="">
				<label class="label">
					<span class="label-text font-bold">Choose Date</span>
				</label>
			</div>
			<div class="flex">
				<div class="form-control">
					{!! Form::date('date', old('date'), [
					    'class' => 'input input-sm input-bordered w-full max-w-xs',
					    'wire:model' => 'date',
					]) !!}
					@if ($filter_active)
						<a href="javascript:void(0)" wire:click.prevent="clearFilter" class="text-red-600 px-1">clear filter</a>
					@endif
				</div>
				<button class="ml-1 btn btn-sm" wire:click.prevent="filter"
					@if (is_null($date)) disabled @endif>Filter</button>
			</div>
		</div>

		<div class="flex flex-col">
			<div class="">
				<label class="label">
					<span class="label-text font-bold">&nbsp;</span>
				</label>
			</div>
			<div class="flex">
				<div class="form-control">
					<button class="ml-1 btn btn-sm btn-accent btn-outline" wire:click.prevent="excelExport"
						@if (count($invoices) == 0) disabled @endif>
						<svg width="20" height="20" class="mr-1" fill="none" stroke="currentColor" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 7.5V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4.5"></path>
							<path d="M15.5 7.5H17"></path>
							<path d="M14 11.5h3"></path>
							<path d="M14 15.5h3"></path>
							<path d="M11 7.5H2v9h9v-9Z"></path>
							<path d="m5 10.5 3 3"></path>
							<path d="m8 10.5-3 3"></path>
						</svg>
						<span class="hidden lg:block">
							Excel Export
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr>
					<th>Name</th>
					<th>Total Invoices</th>
					<th>Total Amount</th>
					<th>Cost</th>
					{{-- <th>GP</th>
					<th>Discount</th>
					<th>Profit</th> --}}
				</tr>
			</thead>
			<tbody>
				@forelse ($invoices->groupBy(function ($data) {
								return $data->activities->where('description', 'created')->first()->causer->name;
				}) as $key => $invoice)
					<tr class="hover">
						<td>{{ $key }}</td>
						<td>{{ count($invoice) }}</td>
						<td>{{ $invoice->sum('total_amount') }}</td>
						<td>
							{{ $invoice->map(fn($invoice) => $invoice->items->sum('service.total_cost'))->sum() }}
						</td>
						{{-- <td>
							{{ $invoice->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($invoice->cost_one + $invoice->cost_two) * $invoice->invoice_items->sum('qty') }}
						</td>
						<td>{{ $invoice->invoice_items->sum('discount') }}</td>
						<td>
							{{ $invoice->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($invoice->cost_one + $invoice->cost_two) * $invoice->invoice_items->sum('qty') - $invoice->invoice_items->sum('discount') }}
						</td> --}}
					</tr>
				@empty
					<tr>
						<td colspan="4">
							<div class="py-20 w-full flex flex-col items-center">
								<div class="bg-gray-200 rounded-full p-5">
									<svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path d="M19.525 5.31v10.5l1.95 1.95c.03-.15.05-.3.05-.45v-12c0-1.1-.9-2-2-2h-12.5l2 2h10.5Z"></path>
										<path
											d="M3.745 2.63 2.475 3.9l1.05 1.05v12.36c0 1.1.9 2 2 2h12.36l2.06 2.06 1.27-1.27L3.745 2.63Zm1.78 14.68V6.95l10.36 10.36H5.525Z">
										</path>
									</svg>
								</div>
								<h1 class="text-center font-semibold text-xl mt-4">
									No Invoices Created On
									<span class="font-extrabold">
										{{ \Carbon\Carbon::parse($date)->format('d M Y') }}
									</span>
								</h1>
							</div>
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
