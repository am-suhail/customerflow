<div>
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr class="border-1">
					<th>Country</th>
					<th>No of Companies</th>
					<th>Total</th>
					<th>Total Percentage</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($companiesByCountry as $countryName => $countryCompanies)
					<tr class="hover">
						<td>{{ $countryName }}</td>
						<td>{{ $countryCompanies->count() }}</td>
						<td class="text-right">{{ $totalInvoices[$countryName] }}</td>
					</tr>
				@endforeach

				@forelse ($companies->groupBy(fn ($company) => $company->country->name) as $key => $company)
					<tr class="hover">
						<td>{{ $key }}</td>
						<td>{{ count($company) }}</td>
						<td class="text-right">
							{{ $company->map(fn($company) => $company->branches->map(fn($branch) => $branch->invoices->map(fn($invoice) => $invoice->total_amount)->sum())->sum())->sum() }}
						</td>
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
				<tr>
					<td></td>
					<td>
						<h6 class="font-bold">
							<span class="">
								Total:
							</span>
							<span class="text-xl">
								{{ count($companies) }}
							</span>
						</h6>
					</td>
					<td>
						<span class="font-bold">
							Total:
						</span> 0
					</td>
					<td>
						<span class="font-bold">
							Total:
						</span> 0
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
