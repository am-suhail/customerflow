<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Invoice - {{ $invoice->number }}</title>

	<style type="text/css">
		@page {
			margin: 15px;
		}

		body {
			margin: 0px;
		}

		* {
			font-family: Verdana, Arial, sans-serif;
		}

		.page-break {
			page-break-after: always;
		}

		table {
			font-size: x-small;
		}

		.invoice table thead tr {
			background-color: #aaa;
		}

		.invoice table tbody tr {
			background-color: #eee;
		}

		.invoice table tfoot tr {
			background-color: #ccc;
		}

		.invoice h3,
		h4 {
			margin: 2px 5px;
		}
	</style>

</head>

<body>
	<table width="100%" id="header-table">
		<tr>
			<td align="left" width="50%">
				{{-- <img src="{{ asset('img/settings/logo.png') }}" alt="DASBAZAR" width="250" class="logo" /> --}}
				<h1>Al Khulood</h1>
			</td>
			<td align="right" width="50%">
				<h2>
					Tax Invoice/Bill of Supply/Cash Memo
				</h2>
			</td>
		</tr>
	</table>

	<br />

	<table width="100%">
		<tr>
			<td align="left" width="35%">
				<h3 style="font-weight: light; margin: 0 0 4px 0;">
					<span style="font-weight: bold">INVOICE:</span>
					{{ $invoice->number }}
				</h3>
				<h3 style="font-weight: light; margin: 0;">
					<span style="font-weight: bold">DATE:</span>
					{{ \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') }}
				</h3>
			</td>
			<td width="30%">
				&nbsp;
			</td>
			<td align="right" width="35%">
				{{-- <h3 style="font-weight: light; margin: 0 0 4px 0;">
						<span style="font-weight: bold">Order No:</span>
						{{ $order_details->order->order_no }}
					</h3>
					<h3 style="font-weight: light; margin: 0;">
						<span style="font-weight: bold">Order Date:</span>
						{{ $order_details->order->created_at->format('d-m-Y') }}
					</h3> --}}
			</td>
		</tr>
	</table>

	<br />

	<table width="100%">
		<tr>
			<td align="left" width="35%">
				{{-- <h3 style="font-weight: bold; margin: 0 0 2px 0;">SOLD BY:</h3>
					<h3 style="font-weight: light; margin: 0 0 2px 0;">
						{{ $order_details->seller->settings->legal_name }}
					</h3>
					<h3 style="font-weight: light; margin: 0;">
						{{ $order_details->seller->shop->full_address }}
					</h3>
					<br />

					<h3 style="font-weight: light; margin: 0 0 4px 0;">
						<span style="font-weight: bold">PAN NO:</span>
						{{ $order_details->seller->pan }}
					</h3>
					<h3 style="font-weight: light; margin: 0;">
						<span style="font-weight: bold">GST:</span>
						{{ $order_details->seller->gst }}
					</h3> --}}

			</td>
			<td width="30%">
				&nbsp;
			</td>
			<td align="right" width="35%">
				<h3 style="font-weight: bold; margin: 0 0 2px 0;">Billing Address:</h3>
				<h3 style="font-weight: light; margin: 0 0 2px 0;">
					{{ $invoice->vendor->name }}
				</h3>
				<h3 style="font-weight: light; margin: 0">
					{{-- {{ $order_details->order->full_address }} --}}
				</h3>

				<br />
			</td>
		</tr>
	</table>

	<br />

	{{-- <table width="100%">
			<tr>
				<td align="left" width="35%">
				</td>
				<td width="30%">
					&nbsp;
				</td>
				<td align="right" width="35%">
					<h3 style="font-weight: bold; margin: 0 0 2px 0;">Payment Method:</h3>
					<h3 style="font-weight: light; margin: 0 0 2px 0;">
						{{ $order_details->order->payment_method == 'payu' ? 'Online Payment' : 'Pay on Delivery' }}
					</h3>
				</td>
			</tr>
		</table> --}}

	<br />

	<div class="invoice">
		<table width="100%">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th width="50%">Description</th>
					<th width="10%">Unit Price</th>
					<th width="5%">Qty</th>
					{{-- <th width="5%">Tax Rate</th> --}}
					{{-- <th width="5%">Tax Type</th> --}}
					{{-- <th width="5%">Tax Amount</th> --}}
					<th width="15%">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($invoice->items as $item)
					<tr>
						<td width="5%">
							<h4>
								{{ $loop->iteration }}
							</h4>
						</td>
						<td width="50%">
							<h4>
								{{ $item->service->name }}
							</h4>
						</td>
						<td width="10%">
							<h4>
								<span style="font-family: DejaVu Sans; sans-serif;">
									{{ $item->unit_price }}
								</span>
							</h4>
						</td>
						<td width="10%">
							<h4>
								{{ $item->qty }}
							</h4>
						</td>
						{{-- <td width="5%">
								<h4>
									{{ $item->product->tax . '%' }}
								</h4>
							</td>
							<td width="5%">
								<h4>
									IGST
								</h4>
							</td> --}}
						{{-- <td width="10%">
								<h4>
									<span style="font-family: DejaVu Sans; sans-serif;">
										&#8377;{{ invoice_tax_amount($item->total_amount / $item->qty, $item->product->tax) }}
									</span>
								</h4>
							</td> --}}
						<td width="25%">
							<h4>
								<span style="font-family: DejaVu Sans; sans-serif;">&#8377;{{ $item->total }}</span>
							</h4>
						</td>
					</tr>
				@endforeach
			</tbody>

			<tfoot>
				<tr>
					<td align="left" colspan="4">
						<h3>
							Total:
						</h3>
					</td>
					{{-- <td align="center">
							<h3>
								<span style="font-family: DejaVu Sans; sans-serif;">
									&#8377;{{ invoice_total_tax($order_details) }}
								</span>
							</h3>
						</td> --}}
					<td align="center">
						<h3>
							<span style="font-family: DejaVu Sans; sans-serif;">
								{{ $invoice->total_amount . '/-' }}
							</span>
						</h3>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>

	<br>

	{{-- @if ($loop->remaining > 0)
		<div class="page-break"></div>
	@endif --}}

	<table width="100%">
		<tr>
			<td>
				<h6 style="color: #ccc; text-align: center; margin: 10px 0;">This is a computer generated invoice.</h6>
			</td>
		</tr>
	</table>

	<br>
</body>

</html>
