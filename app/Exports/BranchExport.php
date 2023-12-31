<?php

namespace App\Exports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BranchExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'KMP Name',
            'Sex',
            'KMP Nationality',
            'KMP Mobile',
            'KMP Email',
            'Company Name',
            'Country',
            'State/Zone/Region',
            'City',
            'VAT/GST',
            'Website',
            'Telephone',
        ];
    }

    /**
     * @var InvoiceItems $branch
     */
    public function map($branch): array
    {
        return [
            $branch->name,
            $branch->sex,
            $branch->country->name,
            $branch->mobile,
            $branch->email,
            $branch->company_name,
            'Country',
            $branch->city->state->name,
            $branch->city->name,
            $branch->vat,
            $branch->url,
            $branch->telephone,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Vendor::all();
    }
}
