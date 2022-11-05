<div>
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr>
					<th>Name</th>
					<th>Total Invoices</th>
					<th>Total Amount</th>
					<th>Cost</th>
					<th>GP</th>
					<th>Discount</th>
					<th>Profit</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($services as $service)
					<tr class="hover">
						<td>{{ $service->name }}</td>
						<td>{{ $service->invoice_items->sum('qty') }}</td>
						<td>{{ $service->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() }}</td>
						<td>
							{{ ($service->cost_one + $service->cost_two) * $service->invoice_items->sum('qty') }}
						</td>
						<td>
							{{ $service->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($service->cost_one + $service->cost_two) * $service->invoice_items->sum('qty') }}
						</td>
						<td>{{ $service->invoice_items->sum('discount') }}</td>
						<td>
							{{ $service->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($service->cost_one + $service->cost_two) * $service->invoice_items->sum('qty') - $service->invoice_items->sum('discount') }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
