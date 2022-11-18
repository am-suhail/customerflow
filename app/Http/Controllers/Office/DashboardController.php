<?php

namespace App\Http\Controllers\Office;

use App\Charts\InvoiceChart;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Vendor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $current_year = Invoice::whereYear('date', date('Y'))
            ->get();

        $current_year_revenue = $current_year->sum('total_amount');

        $previous_year = Invoice::whereYear('date', date("Y", strtotime("-1 year")))
            ->get();

        $previous_year_revenue = $previous_year->sum('total_amount');

        $total_branches = count(Vendor::all());

        // Charts
        // Current Year Sales Chart
        $year_invoices = Invoice::all()
            ->sortBy(function ($data) {
                return Carbon::parse($data->date)->format('Y');
            })
            ->groupBy(function ($data) {
                return Carbon::parse($data->date)->format('Y');
            });

        $year_invoices_chart = new InvoiceChart;
        $year_invoices_chart->labels($year_invoices->keys());
        $year_invoices_chart->dataset('Yearly Revenue - ' . date('Y'), 'bar', $year_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#3B82F6");

        // Current Month Sales Chart
        $month_invoices = Invoice::whereYear('date', date('Y'))
            ->get()
            ->sortBy(function ($data) {
                return Carbon::parse($data->date)->format('m');
            })
            ->groupBy(function ($data) {
                return Carbon::parse($data->date)->format('m');
            });

        $month_invoices_chart = new InvoiceChart;
        $month_invoices_chart->labels($month_invoices->keys());
        $month_invoices_chart->dataset('Current Year Revenue - ' . date('Y'), 'bar', $month_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");

        return view('office.home.index', compact(
            'year_invoices_chart',
            'month_invoices_chart',
            'current_year_revenue',
            'previous_year_revenue',
            'total_branches'
        ));
    }
}
