<?php

namespace App\Exports;

use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchSummaryReportExport implements FromCollection, WithHeadings
{
    public $branches, $total_invoices, $total_invoice_amount;

    public function __construct($branches, $total_invoices, $total_invoice_amount)
    {
        $this->branches = $branches;
        $this->total_invoices = $total_invoices;
        $this->total_invoice_amount = $total_invoice_amount;
    }

    public function headings(): array
    {
        return [
            'Branch',
            'Company',
            'Country',
            'City',
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

        foreach ($this->branches->sortBy('company.name') as $branch) {
            $report->push([
                $branch->name,
                $branch->company->name,
                $branch->country->name,
                $branch->city->name,
                (Arr::exists($this->total_invoices, $branch->name) ? $this->total_invoices[$branch->name] : 0),
                (Arr::exists($this->total_invoice_amount, $branch->name) ? $this->total_invoice_amount[$branch->name] : 0),
                (Arr::exists($this->total_invoice_amount, $branch->name) && $this->total_invoice_amount->sum() > 0 ? number_format((float) ((($total_invoice_amount[$branch->name] ?? 0) / ($this->total_invoice_amount->sum() ?? 0)) * 100), 2, '.', '') : '0.00') . '%',
            ]);
        }

        return $report;
    }
}
