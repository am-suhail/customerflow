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
    public $document_date;
    public $document_number;
    public $accounting_date;
    public $amount = 0;
    public $tax_option_id;
    public $payment_mode;
    public $description;
    public $remark;

    public $subcategory_lists;
    public $entry_type_lists;
    public $tax_lists;

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

        // Fetched SubCategory
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
            ->pluck('name', 'id');

        $this->tax_lists = TaxOption::pluck('name', 'id');

        if (!is_null($expense)) {
            $this->number = $expense->number;
            $this->company_id = $expense->branch->company_id;
            $this->branch_id = $expense->branch_id;
            $this->category_id = $expense->sub_category->category_id;
            $this->sub_category_id = $expense->sub_category_id;
            $this->entry_type_id = $expense->entry_type_id;
            $this->document_date = $expense->document_date;
            $this->document_number = $expense->document_number;
            $this->accounting_date = $expense->accounting_date;
            $this->amount = $expense->amount;
            $this->tax_option_id = $expense->tax_option_id;
            $this->payment_mode = $expense->payment_mode;
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

    public function updatedSubCategoryId($value)
    {
        $this->entry_type_lists = TransactionEntryType::where('sub_category_id', $value)
            ->pluck('name', 'id');
    }

    public function process()
    {
        $this->validate(
            [
                'branch_id'             => ['required', 'not_in:0'],
                'entry_type_id'         => ['required', 'not_in:0'],
                'sub_category_id'       => ['required', 'not_in:0'],
                'tax_option_id'         => ['required', 'not_in:0'],
                'document_date'         => ['required', 'date'],
                'document_number'       => ['nullable', 'string'],
                'accounting_date'       => ['required', 'date'],
                'description'           => ['nullable', 'string'],
                'payment_mode'          => ['required', 'string'],
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
            'document_date'         => $this->document_date,
            'document_number'       => $this->document_number,
            'accounting_date'       => $this->accounting_date,
            'amount'                => $this->amount,
            'tax_option_id'         => empty($this->tax_option_id) ? NULL : $this->tax_option_id,
            'payment_mode'          => $this->payment_mode,
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
