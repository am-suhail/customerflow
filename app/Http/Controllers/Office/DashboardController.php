<?php

namespace App\Http\Controllers\Office;

use App\Charts\InvoiceChart;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Vendor;
use app\Settings\DashboardSettings;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function index(DashboardSettings $settings)
    {
        $this->authorize('dashboard primary');

        $invoices = Invoice::with('vendor', 'vendor.country', 'vendor.city', 'vendor.city.state', 'items', 'items.subcategory')->get();
        $vendors = Vendor::all();

        $current_year = $invoices->filter(fn ($data) => Carbon::parse($data->date)->format('Y') == date('Y'));
        $previous_year = $invoices->filter(fn ($data) => Carbon::parse($data->date)->format('Y') == date('Y', strtotime("-1 year")));

        $current_year_revenue = $current_year->sum('total_amount');

        $previous_year_revenue = $previous_year->sum('total_amount');

        $total_branches = count($vendors);

        $branches = $vendors->filter(fn ($data) => !is_null($data->country_id));
        $total_countries = count($branches->groupBy('country_id'));

        // Charts
        $bar_chart_yearly = null;
        $bar_chart_monthly = null;
        $pie_chart_country = null;

        // Yearly Revenue Chart
        if ($settings->bar_chart_yearly) {
            $year_invoices = $invoices
                ->sortBy(function ($data) {
                    return Carbon::parse($data->date)->format('Y');
                })
                ->groupBy(function ($data) {
                    return Carbon::parse($data->date)->format('Y');
                });

            $bar_chart_yearly = new InvoiceChart;
            $bar_chart_yearly->labels($year_invoices->keys());
            $bar_chart_yearly->dataset('Yearly Revenue', 'bar', $year_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#3B82F6");
        }

        // Current Year Revenue Chart
        if ($settings->bar_chart_monthly) {
            $month_invoices = $current_year
                ->sortBy(function ($data) {
                    return Carbon::parse($data->date)->format('m');
                })
                ->groupBy(function ($data) {
                    return Carbon::parse($data->date)->format('M');
                });

            $bar_chart_monthly = new InvoiceChart;
            $bar_chart_monthly->labels($month_invoices->keys());
            $bar_chart_monthly->dataset('Current Year Revenue', 'bar', $month_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");
        }

        // Country Wise Sales Chart
        if ($settings->pie_chart_country) {
            $country_wise_invoices = $current_year
                ->groupBy(function ($data) {
                    return $data->vendor->country->name ?? "Others";
                });

            $pie_chart_country = new InvoiceChart;
            $pie_chart_country->labels($country_wise_invoices->keys());

            $pie_chart_country->dataset('Revenue %', 'pie', $country_wise_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // State Wise Sales Chart
        if ($settings->pie_chart_state) {
            $state_wise_invoices = $current_year
                ->groupBy(function ($data) {
                    return $data->vendor->city->state->name ?? "Others";
                });

            $pie_chart_state = new InvoiceChart;
            $pie_chart_state->labels($state_wise_invoices->keys());

            $pie_chart_state->dataset('Revenue %', 'pie', $state_wise_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // City Wise Sales Chart
        if ($settings->pie_chart_city) {
            $city_wise_chart = $current_year
                ->groupBy(function ($data) {
                    return $data->vendor->city->name ?? "Others";
                });

            $pie_chart_city = new InvoiceChart;
            $pie_chart_city->labels($city_wise_chart->keys());

            $pie_chart_city->dataset('Revenue %', 'pie', $city_wise_chart->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // Category Wise Sales Chart
        if ($settings->pie_chart_category) {
            $category_wise_chart = $current_year
                ->groupBy(function ($data) {
                    return $data->items->first()->subcategory->category->name ?? "Generic";
                });

            $pie_chart_category = new InvoiceChart;
            $pie_chart_category->labels($category_wise_chart->keys());

            $pie_chart_category->dataset('Revenue %', 'pie', $category_wise_chart->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // Sub Category Wise Sales Chart
        if ($settings->pie_chart_sub_category) {
            $sub_category_wise_chart = $current_year
                ->groupBy(function ($data) {
                    return $data->items->first()->subcategory->name ?? "Generic";
                });

            $pie_chart_sub_category = new InvoiceChart;
            $pie_chart_sub_category->labels($sub_category_wise_chart->keys());

            $pie_chart_sub_category->dataset('Revenue %', 'pie', $sub_category_wise_chart->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        return view('office.home.index', compact(
            'bar_chart_monthly',
            'bar_chart_yearly',
            'pie_chart_country',
            'pie_chart_state',
            'pie_chart_city',
            'pie_chart_category',
            'pie_chart_sub_category',
            'current_year_revenue',
            'previous_year_revenue',
            'total_countries',
            'total_branches'
        ));
    }

    private function colorGenerator()
    {
        $color_palette = [
            "#e75874",
            "#be1558",
            "#fbcbc9",
            "#5dac98",
            "#1B73B1",
            "#1D7EC3",
            "#ef9d10",
            "#3b4d61",
            "#6b7b8c",
            "#835D7C",
            "#1e3d59",
            "#ff6e40",
            "#ffc13b",
            "#ecc19c",
            "#1e847f",
            "#408ec6",
            "#7a2048",
            "#1e2761"
        ];

        return $color_palette;

        // $chars = "ABCDEF0123456789";
        // $size = strlen($chars);
        // $colors = array();
        // for ($i = 0; $i < $numbers; $i++) {
        //     $hex = array();
        //     for ($j = 0; $j < 6; $j++) {
        //         array_push($hex, $chars[rand(0, $size - 1)]);
        //     }
        //     $colors[$i] = implode(Arr::prepend($hex, "#"));
        // }

        // return $colors;
    }
}
