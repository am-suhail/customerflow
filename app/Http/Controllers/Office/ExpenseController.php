<?php

namespace App\Http\Controllers\Office;

use App\Exports\ExpenseTableExport;
use App\Http\Controllers\BaseController;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view expense');

        $expense = Expense::with('tax')->get();

        // Current Month
        $current_month_expense = $expense
            ->whereBetween(
                'accounting_date',
                [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]
            );
        $current_month_expense = $current_month_expense->map(fn ($expense) => $expense->amount + $expense->tax_calc);
        $current_month_expense = $current_month_expense->sum();

        // Current Year
        $current_year_expense = $expense
            ->whereBetween(
                'accounting_date',
                [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ]
            );
        $current_year_expense = $current_year_expense->map(fn ($expense) => $expense->amount + $expense->tax_calc);
        $current_year_expense = $current_year_expense->sum();

        $this->setPageTitle('Expense', '');
        return view('office.expense.index', compact('current_month_expense', 'current_year_expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add revenue');

        $this->setPageTitle('New Expense Entry', '');
        return view('office.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit revenue');

        $expense = Expense::findOrFail($id);

        $this->setPageTitle('Edit Expense Entry ' . $expense->number, '');
        return view('office.expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $this->authorize('export expense');

        return Excel::download(new ExpenseTableExport(Expense::all()), 'expense_' . now() . '.xlsx');
    }
}
