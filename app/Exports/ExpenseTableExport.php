<?php

namespace App\Exports;

use App\Models\Expense;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExpenseTableExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $expenses;

    public function __construct($expenses)
    {
        $this->expenses = $expenses;
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
            'Ref Number',
            'Accounting Date',
            'Company',
            'Branch',
            'Category',
            'Sub Category',
            'Expense Type',
            'Invoice Number',
            'Amount',
            'VAT',
            'Total Amount',
            'Payment Mode',
            'Entry By',
            'Entry On',
            'Description',
            'Remark',
        ];
    }

    /**
     * @var Expense $expense
     */
    public function map($expense): array
    {
        $expense_tax = $expense->tax_calc ?? 0;
        $expense_amount = $expense->amount ?? 0;
        $total_amount = $expense_tax + $expense_amount;

        return [
            $expense->number ?? "--",
            Carbon::parse($expense->accounting_date)->format('d-m-Y') ?? "--",
            $expense->branch->company->name ?? "--",
            $expense->branch->name ?? "--",
            $expense->sub_category->category->name ?? "--",
            $expense->sub_category->name ?? "--",
            $expense->entry_type->name ?? "--",
            $expense->document_number ?? "--",
            $expense->amount ?? "--",
            $expense->tax_calc ?? "--",
            $total_amount,
            $expense->payment_mode ?? "--",
            $expense->creator->name ?? "--",
            Carbon::parse($expense->created_at)->format('d-m-Y | h:i:s A') ?? "--",
            $expense->description ?? "--",
            $expense->remark ?? "--"
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->expenses;
    }
}
