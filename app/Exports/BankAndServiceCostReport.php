<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BankAndServiceCostReport implements FromCollection, WithHeadings, WithMapping
{
    protected $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function headings(): array
    {
        return [
            'Employee',
            'Service',
            'Invoiced Amount',
            'Govt Cost',
            'Agent Cost A',
            'Agent Cost B',
            'Additional Charge',
            'Total Charges',
            'Charges Round Off'
        ];
    }

    /**
     * @var InvoiceItems $invoice_item
     */
    public function map($invoice_item): array
    {
        return [
            $invoice_item->activities->last()->causer->name,
            $invoice_item->service->name,
            $invoice_item->total,
            $invoice_item->service->cost_one,
            $invoice_item->service->cost_two,
            $invoice_item->service->cost_three,
            $invoice_item->additional_charge,
            ($invoice_item->service->cost_one ?? 0) +
                ($invoice_item->service->cost_two ?? 0) +
                ($invoice_item->service->cost_three ?? 0) +
                ($invoice_item->additional_charge ?? 0),
            ceil(
                ($invoice_item->service->cost_one ?? 0) +
                    ($invoice_item->service->cost_two ?? 0) +
                    ($invoice_item->service->cost_three ?? 0) +
                    ($invoice_item->additional_charge ?? 0),
            )
        ];
    }

    public function collection()
    {
        return $this->report;
    }
}
