<div>
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr>
					<th>Date</th>
					<th>Total Invoices</th>
					<th>Total Services</th>
					<th>Total Amount</th>
					<th>Cost</th>
					<th>GP</th>
					<th>Discount</th>
					<th>Profit</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($daily_summary->groupBy(function ($data) {
								return \Carbon\Carbon::parse($data->created_at)->format('d-m-Y');
				}) as $key => $summary)
					<tr class="hover">
						<th>{{ $key }}</th>
						<td>{{ count($summary) }}</td>
						<td>{{ $summary->map(fn($invoice) => count($invoice->items))->sum() }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
