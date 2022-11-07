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
					{{-- <th>GP</th>
					<th>Discount</th>
					<th>Profit</th> --}}
				</tr>
			</thead>
			<tbody>


				@foreach ($invoices->groupBy('causer_id') as $invoice)
					{{-- @dd($invoice->first()->subject) --}}
					{{-- @dd($invoice->map(fn($invoice) => $invoice->subject->items->sum('service.total_cost'))->sum()) --}}
					<tr class="hover">
						<td>{{ $invoice->first()->causer->name }}</td>
						<td>{{ count($invoice) }}</td>
						<td>{{ $invoice->sum('subject.total_amount') }}</td>
						<td>
							{{ $invoice->map(fn($invoice) => $invoice->subject->items->sum('service.total_cost'))->sum() }}
						</td>
						{{-- <td>
							{{ $invoice->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($invoice->cost_one + $invoice->cost_two) * $invoice->invoice_items->sum('qty') }}
						</td>
						<td>{{ $invoice->invoice_items->sum('discount') }}</td>
						<td>
							{{ $invoice->invoice_items->map(fn($item) => $item->unit_price * $item->qty)->sum() - ($invoice->cost_one + $invoice->cost_two) * $invoice->invoice_items->sum('qty') - $invoice->invoice_items->sum('discount') }}
						</td> --}}
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
