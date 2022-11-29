<?php

namespace App\Http\Controllers\Office;

use App\Exports\RevenueTableExport;
use App\Http\Controllers\BaseController;
use App\Models\Invoice;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view revenue');

        $this->setPageTitle('Revenue', '');
        return view('office.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add revenue');

        $vendors = Vendor::pluck('name', 'id');

        $this->setPageTitle('New Revenue Input', '');
        return view('office.invoice.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize('add revenue');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view revenue');

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
        $this->authorize('edit revenue');

        $invoice = Invoice::findOrFail($id);

        $this->setPageTitle('Edit Revenue Input ' . $invoice->number, '');
        return view('office.invoice.edit', compact('invoice'));
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
        $this->authorize('edit revenue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete revenue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $this->authorize('export revenue');

        return Excel::download(new RevenueTableExport(Invoice::all()), 'revenue_' . now() . '.xlsx');
    }
}
