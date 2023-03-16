<div>
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr>
					<th>Country</th>
					<th>No of Companies</th>
					<th>Total</th>
					<th>Total Percentage</th>
				</tr>
			</thead>
			<tbody>

				@forelse ($companies->groupBy(function ($data) {
					return $data->country
				}) as $key => $company)
					<tr class="hover">
						<th>{{ $key }}</th>
						<th>{{ $company }}</th>
						{{-- <td>{{ count($summary) }}</td>
						<td>{{ $summary->map(fn($invoice) => count($invoice->items))->sum() }}</td>
						<td>{{ $summary->sum('total_amount') }}</td>
						<td>
							{{ $summary->map(fn($invoice) => $invoice->items->map(fn($item) => $item->service->total_cost)->sum())->sum() }}
						</td>
						<td>
							{{ $summary->sum('total_amount') - $summary->map(fn($invoice) => $invoice->items->map(fn($item) => $item->service->total_cost)->sum())->sum() }}
						</td>
						<td>{{ $summary->sum('total_discount') }}</td>
						<td>
							{{ $summary->sum('total_amount') - $summary->map(fn($invoice) => $invoice->items->map(fn($item) => $item->service->total_cost)->sum())->sum() - $summary->sum('total_discount') }}
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
									No Records Found
								</h1>
							</div>
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
