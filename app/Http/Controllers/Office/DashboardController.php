<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Invoice::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();

        $invoice_today = count(
            Invoice::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get()
        );

        $amount_today = $today
            ->map(fn ($invoice) => $invoice->total_amount)
            ->sum();

        $service_today = $today
            ->map(fn ($invoice) => count($invoice->items))
            ->sum();

        $total_invoices = count(Invoice::all());

        return view('office.home.index', compact(
            'invoice_today',
            'amount_today',
            'service_today',
            'total_invoices'
        ));
    }
}
