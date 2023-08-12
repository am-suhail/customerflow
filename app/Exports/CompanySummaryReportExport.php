<?php

namespace App\Exports;

use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanySummaryReportExport implements FromCollection, WithHeadings
{
    public $companies, $total_invoices, $total_invoice_amount;

    public function __construct($companies, $total_invoices, $total_invoice_amount)
    {
        $this->companies = $companies;
        $this->total_invoices = $total_invoices;
        $this->total_invoice_amount = $total_invoice_amount;
    }

    public function headings(): array
    {
        return [
            'Company',
            'Country',
            'Branches',
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

        foreach ($this->companies->sortBy('name') as $company) {
            $report->push([
                $company->name,
                $company->country->name ?? '--',
                count($company->branches),
                Arr::exists($this->total_invoices, $company->name) ? $this->total_invoices[$company->name] : 0,
                Arr::exists($this->total_invoice_amount, $company->name) ? $this->total_invoice_amount[$company->name] : 0,
                (Arr::exists($this->total_invoice_amount, $company->name) ? number_format((float) (($this->total_invoice_amount[$company->name] / $this->total_invoice_amount->sum()) * 100), 2, '.', '') : '0.00') . '%',
            ]);
        }

        return $report;
    }
}
