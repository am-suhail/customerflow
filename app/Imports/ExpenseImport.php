<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Expense;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ExpenseImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    private $subcategory_lists, $branches;

    public function __construct()
    {
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
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
        return new Expense([
            'number' => $this->expense_number(),
            'branch_id' => $this->branches[$row['Branch']] ?? null,
            'accounting_date' => Date::dateTimeToExcel($row['Date']),
            'tax' => $row['Tax'],
            'amount' => $row['Amount'],
        ]);
    }

    public function expense_number()
    {
        $lastInvoice = Expense::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#EXP-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = 'EXP-' . $code;

        return $newNumber;
    }
}
