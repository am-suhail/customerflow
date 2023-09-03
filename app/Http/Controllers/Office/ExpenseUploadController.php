<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Models\TransactionEntryType;
use App\Imports\ExpenseImport;
use App\Exceptions\ProductTypeNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ExpenseUploadController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Expense - Import', 'Easily import expense using Excel Format');
        return view('office.expense.import');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_file' => 'required|file',
        ]);

        try {
            $subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
                ->get()
                ->pluck('id', 'name');
            $branches = Branch::all(['id', 'name'])->pluck('id', 'name');
            $expense_types = TransactionEntryType::all(['id', 'name'])->pluck('id', 'name');

            $expenses = Excel::toCollection(new ExpenseImport, $request->file('expense_file'));
        } catch (\Throwable $th) {
            return $this->responseRedirectBack($th->getMessage(), 'warning', false, true);
        }

        DB::beginTransaction();

        try {
            $iteration_count = 0;

            foreach ($expenses as $expense) {
                foreach ($expense as $single_expense) {
                    $iteration_count++;

                    try {
                        $branch_id = $branches[$single_expense['branch']];
                        if (!$branch_id) {
                            throw new ProductTypeNotFoundException("Branch Not Found: " . $single_expense['branch']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Branch: " . $single_expense['branch'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    try {
                        $entry_type_id = $expense_types[$single_expense['expense']];
                        if (!$entry_type_id) {
                            throw new ProductTypeNotFoundException("Expense Type Not Found: " . $single_expense['expense']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Expense Type: " . $single_expense['expense'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    try {
                        $subcategory_id = $subcategory_lists[$single_expense['sub_category']];
                        if (!$subcategory_id) {
                            throw new ProductTypeNotFoundException("Sub Category Not Found: " . $single_expense['sub_category']);
                        }
                    } catch (\Exception $e) {
                        if ($e instanceof ProductTypeNotFoundException) {
                            return $this->responseRedirectBack($e->getMessage() . ' on row ' . $iteration_count, 'warning', false, true);
                        } else {
                            return $this->responseRedirectBack("An error occurred while processing Sub Category: " . $single_expense['sub_category'] . ' on row ' . $iteration_count, 'warning', false, true);
                        }
                    }

                    $expense_data = [
                        'number' => $this->expense_number(),
                        'branch_id' => $branch_id,
                        'sub_category_id' => $subcategory_id,
                        'entry_type_id' => $entry_type_id,
                        'accounting_date' => Date::excelToDateTimeObject($single_expense['date']),
                        'amount' => $single_expense['amount'],
                        'tax' => $single_expense['tax'],
                        'description' => $single_expense['description'],
                        'created_by' => Auth::id()
                    ];

                    $expense = Expense::create($expense_data);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseRedirectBack("Something went wrong! while processing your request on row " . ($iteration_count ?? "--"), 'warning', false, true);
        }

        return $this->responseRedirectBack('Expense Data Uploaded!', 'success');
    }

    private function expense_number()
    {
        $lastExpense = Expense::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastExpense ? $lastExpense->number : '#EXP-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = 'EXP-' . $code;

        return $newNumber;
    }
}
