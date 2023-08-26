<?php

namespace App\Http\Livewire\Tables\Reports;

use App\Exports\CategorySummaryReportExport;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\RevenueType;
use App\Models\SubCategory;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CategorySummaryReportTable extends Component
{
    public
        $categories,
        $sub_categories,
        $total_invoices,
        $total_invoice_amount;

    public
        $revenue_type_list,
        $category_list,
        $sub_category_list,
        $selected_revenue_type,
        $selected_category,
        $selected_sub_category;

    public
        $start_date,
        $selected_start_date,
        $end_date,
        $selected_end_date;

    public $filter_active = false;

    public function mount()
    {
        $this->revenue_type_list = RevenueType::pluck('name', 'id');
        $this->category_list = Category::where('type', Category::TYPE_PRODUCT)->pluck('name', 'id');
        $this->sub_category_list = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
            ->pluck('name', 'id');

        $this->report();
    }

    public function filter()
    {
        $this->validate([
            'selected_start_date' => 'nullable|required_with:selected_end_date|date',
            'selected_end_date'   => 'nullable|required_with:selected_start_date|after_or_equal:selected_start_date',
        ]);

        $this->report($this->selected_start_date, $this->selected_end_date, $this->selected_sub_category);
        $this->filter_active = true;
    }

    public function clearFilter()
    {
        $this->reset(
            'selected_start_date',
            'selected_end_date',
            'selected_sub_category'
        );

        $this->report();
        $this->filter_active = false;
    }

    public function excelExport()
    {
        return Excel::download(new CategorySummaryReportExport($this->sub_categories, $this->total_invoice_amount, $this->start_date, $this->end_date), Carbon::now() . '_category_report.xlsx');
    }

    public function render()
    {
        return view('livewire.tables.reports.category-summary-report-table');
    }

    public function report(
        $start_date = null,
        $end_date = null,
        $sub_category = null,
        $category = null,
        $revenue_type = null,
        $branch = null,
        $company = null,
        $category_name = "Direct",
    ) {

        $earliest_date = Invoice::min('date');
        $latest_date = Invoice::max('date');

        $this->start_date = $start_date ?? $earliest_date;
        $this->end_date = $end_date ?? $latest_date;

        $subCategoryQuery = SubCategory::with(['invoice_items.invoice'])
            ->whereHas('invoice_items.invoice.branch.company.sub_category.category', function ($q) use ($category_name) {
                $q->where('name', $category_name);
            })
            ->whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
            ->when($company, function ($query) use ($company) {
                return $query->whereHas('invoice_items.invoice.branch.company', function ($q) use ($company) {
                    $q->where('id', $company);
                });
            })
            ->when($branch, function ($query) use ($branch) {
                return $query->whereHas('invoice_items.invoice.branch', function ($q) use ($branch) {
                    $q->where('id', $branch);
                });
            })
            ->when($revenue_type, function ($query) use ($revenue_type) {
                return $query->whereHas('revenue_type', function ($q) use ($revenue_type) {
                    $q->where('id', $revenue_type);
                });
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                return $query->whereHas('invoice_items.invoice', function ($q) use ($start_date, $end_date) {
                    $q->whereBetween('date', [$start_date, $end_date]);
                });
            })
            ->when($sub_category, function ($query) use ($sub_category) {
                return $query->where('id', $sub_category);
            });

        $this->sub_categories = $subCategoryQuery->get();

        // $this->sub_categories = $this->sub_categories->filter(function ($sub_category) {
        //     return $sub_category->invoice_items->first()->invoice->branch->company->sub_category->category->name == "Direct";
        // });

        $this->total_invoice_amount = $this->sub_categories
            ->map(
                fn ($sub_category) => $sub_category
                    ->invoice_items
                    ->filter(fn ($item) =>  $item->invoice->branch->company->sub_category->category->name ==  "Direct")
                    ->where('invoice.date', '>=', $this->start_date)
                    ->where('invoice.date', '<=', $this->end_date)
                    ->sum('total')
            );
    }
}
