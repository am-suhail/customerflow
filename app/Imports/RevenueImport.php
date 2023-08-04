<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class RevenueImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    private $subcategory_lists, $branches;

    public function __construct()
    {
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
            ->get()
            ->pluck('id', 'name');
        $this->branches = Branch::all(['id', 'name'])->pluck('id', 'name');
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Invoice([
            'number' => $this->invoice_number(),
            'branch_id' => $this->branches[$row['Branch']] ?? null,
            'date' => Date::dateTimeToExcel($row['Date']),
            'total_tax' => $row['Tax'],
            'total_amount' => $row['Total'],
        ]);
    }

    public function invoice_number()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = '#INV-' . $code;

        return $newNumber;
    }
}
