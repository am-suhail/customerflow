<div>
	<div class="overflow-x-auto">
		<table class="table table-zebra table-compact w-full">
			<!-- head -->
			<thead>
				<tr class="border-1">
					<th width="50%" class="border-2">Country</th>
					<th class="text-center border-2">Companies</th>
					<th class="text-center border-2">Branches</th>
					<th class="text-center border-2">Total</th>
					<th class="text-center border-2">Percentage</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($companies->groupBy('country.name') as $country_name => $company)
					<tr class="hover">
						<td class="border-2">{{ $country_name }}</td>
						<td class="text-center border-2">{{ count($company) }}</td>
						<td class="text-center border-2">{{ $company->map(fn($company) => count($company->branches))->sum() }}</td>
						<td class="text-right border-2">{{ $total_invoice_amount[$country_name] }}</td>
						<td class="text-center border-2">
							{{ number_format((float) (($total_invoice_amount[$country_name] / $total_invoice_amount->sum()) * 100), 2, '.', '') . '%' }}
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
					<td class="text-center border-2">
						<h6 class="font-bold">
							<span class="text-xl">
								{{ $total_companies }}
							</span>
						</h6>
					</td>
					<td class="text-center border-2">
						<h6 class="font-bold">
							<span class="text-xl">
								{{ $total_branches }}
							</span>
						</h6>
					</td>
					<td class="text-right border-2">
						<h6 class="font-bold">
							<span class="text-xl">
								{{ $total_invoice_amount->sum() }}
							</span>
						</h6>
					</td>
					<td class="text-center border-2">
						<h6 class="font-bold">
							<span class="text-xl">
								{{-- //TODO percentage individual calculation dynamic --}}
								100%
							</span>
						</h6>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
