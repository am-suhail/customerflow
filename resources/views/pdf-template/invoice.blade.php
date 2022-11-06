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
			background-color: #003f88;
		}

		.invoice table thead tr th {
			color: #fff;
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
			<td align="center" width="100%">
				{{-- <img src="{{ asset('img/settings/logo.png') }}" alt="DASBAZAR" width="250" class="logo" /> --}}
				<h1 style="color:#003f88;font-family: Verdana, sans-serif; font-size: 30px;">
					AL KHELOUD TYPING & DOCUM COPYING
				</h1>
			</td>
		</tr>
		<tr style="background-color:#003f88">
			<td align="center" width="100%">
				<h3 style="margin:2px 0px;color: #fff">
					P.O BOX NO 23558, SHARJAH - UAE &nbsp; &nbsp; TEL: 065322790 | MOB: 0545993740
				</h3>
			</td>
		</tr>
		<tr>
			<td align="center" width="100%">
				<h3 style="margin:2px 0px; color:#003f88;">
					EMAIL: aktyping786@gmail.com
				</h3>
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
			<td width="25%">
				&nbsp;
			</td>
			<td align="right" width="40%">
				<h3>
					CASH MEMO
				</h3>
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
				@if (!is_null($invoice->vendor))
					<h3 style="font-weight: bold; margin: 0 0 2px 0;">Billing Address:</h3>
					<h3 style="font-weight: light; margin: 0 0 2px 0;">
						{{ $invoice->vendor->name }}
					</h3>
					<h3 style="font-weight: light; margin: 0">
						{{ $invoice->vendor->company_name }}
					</h3>
				@endif
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
					<th width="5%" style="padding: 5px 0">#</th>
					<th width="40%" style="padding: 5px 0">Description</th>
					<th width="15%" style="padding: 5px 0">Unit Price</th>
					<th width="5%" style="padding: 5px 0">Qty</th>
					{{-- <th width="5%">Tax Rate</th> --}}
					<th width="10%">Discount</th>
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
						<td width="40%">
							<h4>
								{{ $item->service->name }}
							</h4>
						</td>
						<td width="15%">
							<h4>
								<span style="font-family: DejaVu Sans; sans-serif;">
									{{ $item->unit_price }}
								</span>
							</h4>
						</td>
						<td width="5%">
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
						<td width="10%">
							<h4>
								<span style="font-family: DejaVu Sans; sans-serif;">
									{{ $item->discount }}
								</span>
							</h4>
						</td>
						<td width="15%">
							<h4>
								<span style="font-family: DejaVu Sans; sans-serif;">{{ $item->total }}</span>
							</h4>
						</td>
					</tr>
				@endforeach
			</tbody>

			<tfoot>
				<tr>
					<td align="left" colspan="5">
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
