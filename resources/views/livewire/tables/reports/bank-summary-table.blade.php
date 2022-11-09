<div>
	<div class="flex flex-col mb-10">
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
	<div class="overflow-x-auto">
		<table class="table table-compact w-full">
			<!-- head -->
			<thead>
				<tr>
					<th>Employee</th>
					<th>Service</th>
					<th>Invoiced Amount</th>
					<th>Govt Cost</th>
					<th>Service Agent Cost 1</th>
					<th>Service Agent Cost 2</th>
					<th>Additional Charge</th>
					<th>Total Charges</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($items as $item)
					<tr class="hover">
						<td>{{ $item->activities->last()->causer->name }}</td>
						<td>{{ $item->service->name }}</td>
						<td>{{ $item->total }}</td>
						<td>
							{{ $item->service->cost_one ?? '--' }}
						</td>
						<td>
							{{ $item->service->cost_two ?? '--' }}
						</td>
						<td>{{ $item->service->cost_three ?? '--' }}</td>
						<td>
							{{ $item->additional_charge ?? '--' }}
						</td>
						<td>
							{{ ($item->service->cost_one ?? 0) +
							    ($item->service->cost_two ?? 0) +
							    ($item->service->cost_three ?? 0) +
							    ($item->additional_charge ?? 0) }}
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="8">
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
