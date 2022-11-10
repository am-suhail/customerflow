<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserSummaryReport implements FromCollection, WithHeadings
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Total Invoices',
            'Total Amount',
            'Cost',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $report = collect();

        foreach ($this->data->groupBy(function ($data) {
            return $data->activities->where('description', 'created')->first()->causer->name;
        }) as $key => $invoice) {
            $report->push([
                $key,
                count($invoice),
                $invoice->sum('total_amount'),
                $invoice->map(fn ($invoice) => $invoice->items->sum('service.total_cost'))->sum()
            ]);
        }

        return $report;
    }
}
