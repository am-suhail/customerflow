<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyTableExport implements FromCollection
{
    protected $companies;

    public function __construct($companies)
    {
        $this->companies = $companies;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
        $sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle(1)->getFill()->getStartColor()->setARGB('EFEFEF');
        $sheet->getStyle(1)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }

    public function headings(): array
    {
        return [
            'Category',
            'Sub Category',
            'Company Name',
            'Country',
            'Branches',
            'Incorporation Date',
            'Incorporation Number',
            'Industry',
            'VAT/GST',
            'Telephone',
            'Email',
            'Website',
            'Remarks',
        ];
    }

    /**
     * @var Company $company
     */
    public function map($company): array
    {
        return [
            $company->sub_category->category->name,
            $company->sub_category->name,
            $company->name,
            $company->country->name,
            count($company->branches),
            $company->inc_date,
            $company->inc_number,
            $company->industry->name,
            $company->tax_number,
            $company->telephone,
            $company->email,
            $company->website,
            $company->remark,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->companies;
    }
}
