<?php

namespace App\Exports;

use App\Models\Invoice;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RevenueTableExport implements FromCollection, WithHeadings, WithMapping
{
    protected $revenue;

    public function __construct($revenue)
    {
        $this->revenue = $revenue;
    }

    public function headings(): array
    {
        return [
            'Ref Number',
            'Revenue Date',
            'Company Type',
            'Company',
            'Branch',
            'Country',
            'Zone/District',
            'City',
            'Revenue Type',
            'Taxable Amount',
            'Tax',
            'Total Amount',
            'No of Invoices',
            'Created By',
            'Created On',
        ];
    }

    /**
     * @var Invoice $invoice
     */
    public function map($invoice): array
    {
        return [
            $invoice->number,
            Carbon::parse($invoice->date)->format('d-m-Y'),
            $invoice->branch->company->sub_category->category->name ?? "--",
            $invoice->branch->company->name,
            $invoice->branch->name,
            $invoice->branch->country->name,
            $invoice->branch->city->state->name,
            $invoice->branch->city->name,
            $invoice->items->first()->revenue_type->name ?? "--",
            number_format($invoice->items->map(fn ($item) => $item->unit_price)->sum(), 0),
            number_format($invoice->items->map(fn ($item) => $item->discount)->sum(), 0),
            $invoice->total_amount ?? "--",
            $invoice->items->map(fn ($item) => $item->tax)->sum() ?? "--",
            $invoice->activities->where('description', 'created')->first()->causer->name ?? "--",
            Carbon::parse($invoice->created_at)->format('d-m-Y | h:i:s A')
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->revenue;
    }
}
