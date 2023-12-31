<?php

namespace App\Http\Livewire\Forms\Expense;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use App\Models\TaxOption;
use App\Models\TransactionEntryType;
use Livewire\Component;

class Edit extends Component
{
    public $expense;

    // Company & Branches List
    public $companies;
    public $branches;

    // Model Form Variables
    public $number;
    public $company_id;
    public $branch_id;
    public $category_id;
    public $sub_category_id;
    public $entry_type_id;
    public $accounting_date;
    public $amount = 0;
    public $tax = 0;
    public $total = 0;
    public $description;
    public $remark;

    public $category_lists;
    public $subcategory_lists;
    public $entry_type_lists;

    protected $listeners = ['transEntryAdded', 'entryValueUpdate'];

    public function transEntryAdded($id, $sub_category_id)
    {
        $this->entry_type_lists = TransactionEntryType::where('sub_category_id', $sub_category_id)
            ->pluck('name', 'id');
        $this->entry_type_id = $id;
        $this->sub_category_id = $sub_category_id;

        $this->dispatchBrowserEvent('entry-type-updated', ['newTypeList' => $this->entry_type_lists]);
    }

    public function entryValueUpdate()
    {
        $this->entry_type_id = $this->entry_type_id;
    }

    public function mount($expense)
    {
        $this->expense = $expense;

        $this->branches = Branch::pluck('name', 'id');
        $this->companies = Company::pluck('name', 'id');

        // Fetched Category
        $this->category_lists = Category::where('type', Category::TYPE_EXPENSE)
            ->pluck('name', 'id');

        // Fetched SubCategory
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
            ->pluck('name', 'id');

        if (!is_null($expense)) {
            $this->number = $expense->number;
            $this->company_id = $expense->branch->company_id;
            $this->branch_id = $expense->branch_id;
            $this->category_id = $expense->sub_category->category_id ?? null;
            $this->sub_category_id = $expense->sub_category_id;
            $this->entry_type_id = $expense->entry_type_id;
            $this->accounting_date = $expense->accounting_date->format('Y-m-d');
            $this->amount = $expense->amount;
            $this->tax = $expense->tax;
            $this->total = $expense->tax + $expense->amount;
            $this->description = $expense->description;
            $this->remark = $expense->remark;
        }

        $this->entry_type_lists = TransactionEntryType::where('sub_category_id', $this->sub_category_id)
            ->pluck('name', 'id');
    }

    public function updatedCompanyId($company)
    {
        if (!is_null($company)) {
            $this->branches = Branch::where('company_id', $company)
                ->get()
                ->pluck('name', 'id');
        }
    }

    public function updatedCategoryId($value)
    {
        $this->subcategory_lists = SubCategory::where('category_id', $value)
            ->pluck('name', 'id');
    }

    public function updatedSubCategoryId($value)
    {
        $this->entry_type_lists = TransactionEntryType::where('sub_category_id', $value)
            ->pluck('name', 'id');
    }

    public function updatedAmount($value)
    {
        $this->total = ($value ?? 0) + $this->tax;
    }

    public function updatedTax($value)
    {
        $this->total = ($value ?? 0) + $this->amount;
    }

    public function process()
    {
        $this->validate(
            [
                'branch_id'             => ['required', 'not_in:0'],
                'entry_type_id'         => ['required', 'not_in:0'],
                'sub_category_id'       => ['required', 'not_in:0'],
                'accounting_date'       => ['required', 'date'],
                'description'           => ['nullable', 'string'],
                'amount'                => ['required', 'numeric'],
            ],
            [
                'sub_category_id.required' => 'Please, specify the Category',
            ]
        );

        $updated = $this->expense->update([
            'branch_id'             => empty($this->branch_id) ? NULL : $this->branch_id,
            'sub_category_id'       => empty($this->sub_category_id) ? NULL : $this->sub_category_id,
            'entry_type_id'         => empty($this->entry_type_id) ? NULL : $this->entry_type_id,
            'document_date'         => null,
            'document_number'       => null,
            'accounting_date'       => $this->accounting_date,
            'amount'                => $this->amount,
            'tax'                   => $this->tax,
            'payment_mode'          => null,
            'description'           => $this->description,
            'remark'                => $this->remark
        ]);

        if ($updated) {
            session()->flash('message', 'Expense Updated');

            return redirect()->route('expense.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.expense.edit');
    }
}
