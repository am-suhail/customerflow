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

        $branches = Vendor::all()->filter(fn ($data) => !is_null($data->country_id));

        $total_countries = count($branches->groupBy('country_id'));

        // Charts
        // Yearly Revenue Chart
        $year_invoices = Invoice::all()
            ->sortBy(function ($data) {
                return Carbon::parse($data->date)->format('Y');
            })
            ->groupBy(function ($data) {
                return Carbon::parse($data->date)->format('Y');
            });

        $year_invoices_chart = new InvoiceChart;
        $year_invoices_chart->labels($year_invoices->keys());
        $year_invoices_chart->dataset('Yearly Revenue', 'bar', $year_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#3B82F6");

        // Current Year Revenue Chart
        $month_invoices = Invoice::whereYear('date', date('Y'))
            ->get()
            ->sortBy(function ($data) {
                return Carbon::parse($data->date)->format('m');
            })
            ->groupBy(function ($data) {
                return Carbon::parse($data->date)->format('M');
            });

        $month_invoices_chart = new InvoiceChart;
        $month_invoices_chart->labels($month_invoices->keys());
        $month_invoices_chart->dataset('Current Year Revenue - ' . date('Y'), 'bar', $month_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");

        // Country Wise Sales Chart
        $country_wise_invoices = Invoice::all()
            ->groupBy(function ($data) {
                return Carbon::parse($data)->format('m');
            });

        $country_wise_invoices_chart = new InvoiceChart;
        $country_wise_invoices_chart->labels($country_wise_invoices->keys());
        $country_wise_invoices_chart->dataset('Current Year Revenue - ' . date('Y'), 'pie', $country_wise_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");
        $country_wise_invoices_chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        return view('office.home.index', compact(
            'year_invoices_chart',
            'month_invoices_chart',
            'country_wise_invoices_chart',
            'current_year_revenue',
            'previous_year_revenue',
            'total_countries',
            'total_branches'
        ));
    }
}
