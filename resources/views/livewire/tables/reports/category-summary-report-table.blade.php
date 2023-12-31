<div>
	<div class="flex justify-between mb-5">
		<div class="flex flex-col">
			<div class="flex">
				<div class="form-control">
					<label class="label">
						<span class="label-text font-bold">Choose Start Date</span>
					</label>
					{!! Form::date('selected_start_date', old('selected_start_date'), [
					    'class' =>
					        'input input-bordered w-full max-w-xs' . ($errors->has('selected_start_date') ? 'border-2 border-red-600' : ''),
					    'wire:model' => 'selected_start_date',
					]) !!}
					@error('selected_start_date')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
					@if ($filter_active)
						<a href="javascript:void(0)" wire:click.prevent="clearFilter" class="text-red-600 px-1">clear filter</a>
					@endif
				</div>
				<div class="form-control">
					<label class="label">
						<span class="label-text font-bold">Choose End Date</span>
					</label>
					{!! Form::date('selected_end_date', old('selected_end_date'), [
					    'class' =>
					        'ml-1 input input-bordered w-full max-w-xs' .
					        ($errors->has('selected_end_date') ? 'border-2 border-red-600' : ''),
					    'wire:model' => 'selected_end_date',
					]) !!}
					@error('selected_end_date')
						<label class="label">
							<span class="text-red-600 label-text-alt">{{ $message }}</span>
						</label>
					@enderror
				</div>
				<div class="ml-1 form-control">
					<label class="label">
						<span class="label-text font-bold">Choose Sub Category</span>
					</label>
					{!! Form::select('sub_category_id', $sub_category_list, old('sub_category_id'), [
					    'class' => 'ml-1 select select-bordered w-full max-w-xs',
					    'placeholder' => '--all sub category--',
					    'wire:model' => 'selected_sub_category',
					]) !!}
				</div>
				<div class="form-control ml-2">
					<label class="label">
						<span class="label-text font-bold">&nbsp;</span>
					</label>
					<button class="btn" wire:click.prevent="filter">Filter</button>
				</div>
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
						@if (count($sub_categories) == 0) disabled @endif>
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
		@if ($filter_active)
			<h6 class="text-center font-semibold mb-2">
				Showing results for the Date Range:
				{{ \Carbon\Carbon::parse($start_date)->format('d M Y') }}
				to
				{{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}
			</h6>
		@endif
		<table class="table table-zebra table-compact w-full">
			<!-- head -->
			<thead>
				<tr class="border-1">
					<th class="border-2">#</th>
					<th width="40%" class="border-2">Revenue Type</th>
					<th width="40%" class="border-2">Category</th>
					<th width="40%" class="border-2">Sub Category</th>
					<th class="text-center border-2">Total</th>
					<th class="text-center border-2">% of Total Revenue</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($sub_categories->sortBy(['category.name', 'name']) as $sub_category)
					<tr class="hover">
						<td class="border-2">{{ $loop->iteration }}</td>
						<td class="border-2">{{ $sub_category->revenue_type->name ?? '--' }}</td>
						<td class="border-2">{{ $sub_category->category->name ?? '--' }}</td>
						<td class="border-2">{{ $sub_category->name ?? '--' }}</td>
						<td class="text-right border-2">
							{{ number_format(
							    $sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$start_date, $end_date])->sum('total'),
							    0,
							) }}
						</td>
						<td class="text-center border-2">
							{{ $sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$start_date, $end_date])->sum('total') > 0 && $total_invoice_amount->sum() > 0? number_format((($sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$start_date, $end_date])->sum('total') ??0) /($total_invoice_amount->sum() ?? 0)) *100,2): '0.00' }}
							%
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
					<td></td>
					<td></td>
					<td></td>
					<td class="text-right border-2">
						<h6 class="font-bold">
							<span class="text-xl">
								{{ number_format($total_invoice_amount->sum(), 0) }}
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
