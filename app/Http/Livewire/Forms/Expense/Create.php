<?php

namespace App\Http\Livewire\Forms\Expense;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Models\TaxOption;
use App\Models\TransactionEntryType;
use Livewire\Component;
use Auth;

class Create extends Component
{
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
    public $total;
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
        $this->sub_category_id = $this->sub_category_id;
    }

    public function mount()
    {
        $this->number = $this->voucherNumbering();

        $this->accounting_date = date('Y-m-d');

        $this->branches = [];
        $this->companies = Company::pluck('name', 'id');

        $default_branch = Branch::whereIsDefault(1)->first();

        if (!is_null($default_branch)) {
            $this->company_id = $default_branch->company_id;
            $this->branches = Branch::where('company_id', $this->company_id)
                ->pluck('name', 'id');
            $this->branch_id = $default_branch->id;
        }

        // Fetched Category
        $this->category_lists = Category::where('type', Category::TYPE_EXPENSE)
            ->pluck('name', 'id');

        // Fetched SubCategory
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
            ->pluck('name', 'id');

        $this->entry_type_lists = collect();
    }

    public function updatedCompanyId($company)
    {
        if (!is_null($company)) {
            $this->branches = Branch::where('company_id', $company)
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
        $this->total = $value + $this->tax;
    }

    public function updatedTax($value)
    {
        $this->total = $value + $this->amount;
    }

    public function process()
    {
        $this->validate(
            [
                'branch_id'             => ['required', 'not_in:0'],
                'sub_category_id'       => ['required', 'not_in:0'],
                'accounting_date'       => ['required', 'date'],
                'description'           => ['nullable', 'string'],
                'amount'                => ['required', 'numeric'],
                'tax'                   => ['required', 'numeric'],
            ],
            [
                'sub_category_id.required' => 'Please, specify the Category',
            ]
        );

        $created = Expense::create([
            'number'                => $this->voucherNumbering(),
            'accounting_date'       => $this->accounting_date,
            'branch_id'             => empty($this->branch_id) ? NULL : $this->branch_id,
            'sub_category_id'       => empty($this->sub_category_id) ? NULL : $this->sub_category_id,
            'entry_type_id'         => empty($this->entry_type_id) ? NULL : $this->entry_type_id,
            'amount'                => $this->amount,
            'tax'                   => $this->tax,
            'tax_option_id'         => empty($this->tax_option_id) ? NULL : $this->tax_option_id,
            'description'           => $this->description,
            'remark'                => $this->remark,
            'created_by'            => Auth::id(),
        ]);

        if ($created) {
            session()->flash('message', 'Expense Created');

            return redirect()->route('expense.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.expense.create');
    }

    public function voucherNumbering()
    {
        $lastExpense = Expense::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastExpense ? $lastExpense->number : '#EXP-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $number = 'EXP-' . $code;

        return $number;
    }
}
