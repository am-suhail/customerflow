<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Invoice;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Invoices', '');
        return view('office.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::pluck('name', 'id');

        $this->setPageTitle('New Invoice', '');
        return view('office.invoice.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : 'INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $validated['code'] = 'INV-' . $code;

        dd($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        $pdf = PDF::loadView('pdf-template.invoice', compact('invoice'));

        return $pdf->stream($invoice->number . ".pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
