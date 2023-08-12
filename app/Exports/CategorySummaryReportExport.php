<?php

namespace App\Exports;

use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategorySummaryReportExport implements FromCollection, WithHeadings
{
    public $sub_categories, $total_invoices, $total_invoice_amount;

    public function __construct($sub_categories, $total_invoices, $total_invoice_amount)
    {
        $this->sub_categories = $sub_categories;
        $this->total_invoices = $total_invoices;
        $this->total_invoice_amount = $total_invoice_amount;
    }

    public function headings(): array
    {
        return [
            'Type',
            'Category',
            'Sub Category',
            'Invoices',
            'Total',
            'Percentage',
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
                Arr::exists($this->total_invoices, $sub_category->name) ? $this->total_invoices[$sub_category->name] : 0,
                Arr::exists($this->total_invoice_amount, $sub_category->name) ? $this->total_invoice_amount[$sub_category->name] : 0,
                (Arr::exists($this->total_invoice_amount, $sub_category->name) && $this->total_invoice_amount->sum() > 0 ?
                    number_format((float) ((($total_invoice_amount[$sub_category->name] ?? 0) / ($this->total_invoice_amount->sum() ?? 0)) * 100), 2, '.', '') : '0.00') . '%',
            ]);
        }

        return $report;
    }
}
