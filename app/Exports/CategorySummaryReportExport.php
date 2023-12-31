<?php

namespace App\Exports;

use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategorySummaryReportExport implements FromCollection, WithHeadings
{
    public $sub_categories, $total_invoice_amount, $start_date, $end_date;

    public function __construct($sub_categories, $total_invoice_amount, $start_date, $end_date)
    {
        $this->sub_categories = $sub_categories;
        $this->total_invoice_amount = $total_invoice_amount;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function headings(): array
    {
        return [
            'Revenue Type',
            'Category',
            'Sub Category',
            'Total',
            '% of Total Revenue',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $report = collect();

        foreach ($this->sub_categories->sortBy(['category.name', 'name']) as $sub_category) {
            $report->push([
                $sub_category->revenue_type->name ?? '--',
                $sub_category->category->name ?? '--',
                $sub_category->name ?? '--',
                number_format($sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$this->start_date, $this->end_date])->sum('total') ?? 0, 0),
                $sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$this->start_date, $this->end_date])->sum('total') > 0 && $this->total_invoice_amount->sum() > 0 ? number_format((($sub_category->invoice_items->where('invoice.branch.company.sub_category.category.name', 'Direct')->whereBetween('invoice.date', [$this->start_date, $this->end_date])->sum('total') ?? 0) / ($this->total_invoice_amount->sum() ?? 0)) * 100, 2) : '0.00'
            ]);
        }

        return $report;
    }
}
