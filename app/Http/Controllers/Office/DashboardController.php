<?php

namespace App\Http\Controllers\Office;

use App\Charts\InvoiceChart;
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

        // Charts
        // Current Year Sales Chart
        $year_invoices = Invoice::whereYear('created_at', date('Y'))
            ->get()
            ->groupBy(function ($data) {
                return Carbon::parse($data->created_at)->format('M');
            });

        $year_invoices_chart = new InvoiceChart;
        $year_invoices_chart->labels($year_invoices->keys());
        $year_invoices_chart->dataset('Current Year Invoices - ' . date('Y'), 'bar', $year_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#3B82F6");

        // Current Month Sales Chart
        $month_invoices = Invoice::whereMonth('created_at', date('m'))
            ->get()
            ->groupBy(function ($data) {
                return Carbon::parse($data->created_at)->format('d');
            });

        $month_invoices_chart = new InvoiceChart;
        $month_invoices_chart->labels($month_invoices->keys());
        $month_invoices_chart->dataset('Current Month Invoices - ' . date('M'), 'bar', $month_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");


        // Reports: 

        // User Base,
        // Services, Invoices, Amount

        // Service Base,

        // Daily Summary,
        // Date, No of Invoices, Services Count, Invoice Amount, Cost, GP, Discount, Actual Profit

        // $daily_summary = Invoice::all()
        //     ->groupBy(function ($data) {
        //         return Carbon::parse($data->created_at)->format('d-m-Y');
        //     });

        // dd($daily_summary);


        return view('office.home.index', compact(
            'year_invoices_chart',
            'month_invoices_chart',
            'invoice_today',
            'amount_today',
            'service_today',
            'total_invoices'
        ));
    }
}
