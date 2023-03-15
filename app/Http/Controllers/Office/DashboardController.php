<?php

namespace App\Http\Controllers\Office;

use App\Charts\InvoiceChart;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\Branch;
use App\Models\Company;
use app\Settings\DashboardSettings;
use app\Settings\FinanceSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(DashboardSettings $settings, FinanceSettings $finance_settings)
    {
        if (!Gate::check('dashboard primary')) {
            return redirect()->route('my-profile.index');
        }

        $this->authorize('dashboard primary');
        $category_name = "Direct";
        $secondary_category_name = "Investment";

        // Global Chart Settings
        $bar_chart_yearly = null;
        $bar_chart_monthly_previous_year = null;
        $bar_chart_monthly = null;
        $pie_chart_country = null;
        $pie_chart_state = null;
        $pie_chart_city = null;
        $pie_chart_sub_category = null;
        $pie_chart_category = null;

        // Company & Branch
        $companies = Company::all();

        $branches = Branch::with(['company.sub_category.category'])
            ->whereHas('company.sub_category.category', function ($q) use ($category_name) {
                $q->where('name', $category_name);
            })
            ->get();

        $branches_investment = Branch::with(['company.sub_category.category'])
            ->whereHas('company.sub_category.category', function ($q) use ($secondary_category_name) {
                $q->where('name', $secondary_category_name);
            })
            ->get();

        $total_branches_direct = $branches->count();
        $total_branches_investment = $branches_investment->count();

        $branches = $branches->filter(fn ($data) => !is_null($data->country_id));
        $total_countries = count($branches->groupBy('country_id'));
        $total_companies = count($companies);

        // Date Settings
        $start_month = $finance_settings->year_start;
        $end_month = Carbon::parse($start_month)->subMonth();

        if (Carbon::parse($start_month)->gt(date('M'))) {
            $curr_start_date = Carbon::parse($start_month)->subYear()->startOfMonth();
            $curr_end_date = $end_month->endOfMonth();
        } else {
            $curr_start_date = Carbon::parse($start_month)->startOfMonth();
            $curr_end_date = $end_month->addYear()->endOfMonth();
        }

        $prev_start_date = Carbon::parse($curr_start_date)->subYear();
        $prev_end_date = Carbon::parse($curr_end_date)->subYear();

        // Invoice & Invoice Items
        $invoices = Invoice::with('branch', 'branch.country', 'branch.city', 'branch.city.state')
            ->whereHas('branch', function ($q) use ($category_name) {
                $q->whereHas('company', function ($q) use ($category_name) {
                    $q->whereHas('sub_category', function ($q) use ($category_name) {
                        $q->whereHas('category', function ($q) use ($category_name) {
                            $q->where('name', $category_name);
                        });
                    });
                });
            })
            ->get();

        $current_year = $invoices->whereBetween('date', [$curr_start_date, $curr_end_date]);
        $previous_year = $invoices->whereBetween('date', [$prev_start_date, $prev_end_date]);

        $current_year_items = InvoiceItems::whereHas('invoice', function ($query) use ($curr_start_date, $curr_end_date, $category_name) {
            $query->whereBetween('date', [$curr_start_date, $curr_end_date])
                ->whereHas('branch', function ($q) use ($category_name) {
                    $q->whereHas('company', function ($q) use ($category_name) {
                        $q->whereHas('sub_category', function ($q) use ($category_name) {
                            $q->whereHas('category', function ($q) use ($category_name) {
                                $q->where('name', $category_name);
                            });
                        });
                    });
                });
        })
            ->get();

        $previous_year_items = InvoiceItems::whereHas('invoice', function ($query) use ($prev_start_date, $prev_end_date, $category_name) {
            $query->whereBetween('date',  [$prev_start_date, $prev_end_date])
                ->whereHas('branch', function ($q) use ($category_name) {
                    $q->whereHas('company', function ($q) use ($category_name) {
                        $q->whereHas('sub_category', function ($q) use ($category_name) {
                            $q->whereHas('category', function ($q) use ($category_name) {
                                $q->where('name', $category_name);
                            });
                        });
                    });
                });
        })
            ->get();

        $current_year_revenue = $current_year->sum('total_amount');
        $previous_year_revenue = $previous_year->sum('total_amount');

        $current_year_invoices =  $current_year_items->map(fn ($item) => $item->tax)->sum();
        $previous_year_invoices = $previous_year_items->map(fn ($item) => $item->tax)->sum();

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

        // Previous Year Revenue Chart
        if ($settings->bar_chart_monthly) {
            $previous_year_monthly = $previous_year
                ->sortBy(function ($data) {
                    return Carbon::parse($data->date)->format('m');
                })
                ->groupBy(function ($data) {
                    return Carbon::parse($data->date)->format('M');
                });

            $bar_chart_monthly_previous_year = new InvoiceChart;
            $bar_chart_monthly_previous_year->labels($previous_year_monthly->keys());
            $bar_chart_monthly_previous_year->dataset('Previous Year Revenue', 'bar', $previous_year_monthly->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum()))->color("#0AA674");
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
                    return $data->branch->country->name ?? "Others";
                });

            $pie_chart_country = new InvoiceChart;
            $pie_chart_country->labels($country_wise_invoices->keys());

            $pie_chart_country->dataset('Revenue %', 'pie', $country_wise_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // State Wise Sales Chart
        if ($settings->pie_chart_state) {
            $state_wise_invoices = $current_year
                ->groupBy(function ($data) {
                    return $data->branch->city->state->name ?? "Others";
                });

            $pie_chart_state = new InvoiceChart;
            $pie_chart_state->labels($state_wise_invoices->keys());

            $pie_chart_state->dataset('Revenue %', 'pie', $state_wise_invoices->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // City Wise Sales Chart
        if ($settings->pie_chart_city) {
            $city_wise_chart = $current_year
                ->groupBy(function ($data) {
                    return $data->branch->city->name ?? "Others";
                });

            $pie_chart_city = new InvoiceChart;
            $pie_chart_city->labels($city_wise_chart->keys());

            $pie_chart_city->dataset('Revenue %', 'pie', $city_wise_chart->values()->map(fn ($data) => $data->map(fn ($invoice) => $invoice->total_amount)->sum() / $current_year->sum('total_amount') * 100))->backgroundColor($this->colorGenerator());
        }

        // Category Wise Sales Chart
        if ($settings->pie_chart_category) {
            $category_wise_chart = $current_year_items
                ->groupBy(function ($data) {
                    return $data->subcategory->category->name ?? "Generic";
                });

            $pie_chart_category = new InvoiceChart;
            $pie_chart_category->labels($category_wise_chart->keys());

            $pie_chart_category->dataset('Revenue %', 'pie', $category_wise_chart->values()->map(fn ($data) => round($data->map(fn ($invoice_item) => $invoice_item->total)->sum() / $current_year_items->sum('total') * 100, 2)))->backgroundColor($this->colorGenerator());
        }

        // Sub Category Wise Sales Chart
        if ($settings->pie_chart_sub_category) {
            $sub_category_wise_chart = $current_year_items
                ->groupBy(function ($data) {
                    return $data->subcategory->name ?? "Generic";
                });

            $pie_chart_sub_category = new InvoiceChart;
            $pie_chart_sub_category->labels($sub_category_wise_chart->keys());

            $pie_chart_sub_category->dataset('Revenue %', 'pie', $sub_category_wise_chart->values()->map(fn ($data) => round($data->map(fn ($invoice_item) => $invoice_item->total)->sum() / $current_year_items->sum('total') * 100, 2)))->backgroundColor($this->colorGenerator());
        }

        return view('office.home.index', compact(
            'bar_chart_monthly_previous_year',
            'bar_chart_monthly',
            'bar_chart_yearly',
            'pie_chart_country',
            'pie_chart_state',
            'pie_chart_city',
            'pie_chart_category',
            'pie_chart_sub_category',
            'current_year_revenue',
            'current_year_invoices',
            'previous_year_revenue',
            'previous_year_invoices',
            'total_countries',
            'total_companies',
            'total_branches_direct',
            'total_branches_investment'
        ));
    }

    public function trouble(FinanceSettings $finance_settings)
    {
        $category_name = "Direct";

        $start_month = $finance_settings->year_start;
        $end_month = Carbon::parse($start_month)->subMonth();

        if (Carbon::parse($start_month)->gt(date('M'))) {
            $curr_start_date = Carbon::parse($start_month)->subYear()->startOfMonth();
            $curr_end_date = $end_month->endOfMonth();
        } else {
            $curr_start_date = Carbon::parse($start_month)->startOfMonth();
            $curr_end_date = $end_month->addYear()->endOfMonth();
        }

        $prev_start_date = Carbon::parse($curr_start_date)->subYear();
        $prev_end_date = Carbon::parse($curr_end_date)->subYear();

        // Invoice & Invoice Items
        $invoices = Invoice::with('branch', 'branch.country', 'branch.city', 'branch.city.state')
            ->whereHas('branch', function ($q) use ($category_name) {
                $q->whereHas('company', function ($q) use ($category_name) {
                    $q->whereHas('sub_category', function ($q) use ($category_name) {
                        $q->whereHas('category', function ($q) use ($category_name) {
                            $q->where('name', $category_name);
                        });
                    });
                });
            })
            ->get();

        $previous_year = $invoices->whereBetween('date', [$prev_start_date, $prev_end_date]);

        $previous_year_items = InvoiceItems::whereHas('invoice', function ($query) use ($prev_start_date, $prev_end_date, $category_name) {
            $query->whereBetween('date',  [$prev_start_date, $prev_end_date])
                ->whereHas('branch', function ($q) use ($category_name) {
                    $q->whereHas('company', function ($q) use ($category_name) {
                        $q->whereHas('sub_category', function ($q) use ($category_name) {
                            $q->whereHas('category', function ($q) use ($category_name) {
                                $q->where('name', $category_name);
                            });
                        });
                    });
                });
        })
            ->get();

        return view('office.home.trouble', compact('previous_year'));
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
