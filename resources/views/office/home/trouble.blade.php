@extends('layouts.app')

@section('content')
	<!-- Main content -->
	<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
		@foreach ($previous_year as $invoice)
			<div class="my-2 bg-blue-300 rounded border-2">
				<h1>
					{{ $invoice->id }}
				</h1>
				<h1>
					{{ $invoice->number }}
				</h1>
				<h1>
					{{ $invoice->total_amount }}
				</h1>
			</div>
			@foreach ($invoice->items as $item)
				<div class="my-2 border-2">
					<h1>
						{{ $item->id }}
					</h1>
					<h1>
						{{ $item->selling_price * $item->qty -
						    $item->discount +
						    ($item->additional_charge ?? 0) +
						    ($item->non_trade_revenue ?? 0) }}
					</h1>
				</div>
			@endforeach
		@endforeach
		<div class="mt-2">
			<h1 class="font-bold">
				Total: {{ $previous_year->sum('total_amount') }}
			</h1>
		</div>
	</main>
@endsection
