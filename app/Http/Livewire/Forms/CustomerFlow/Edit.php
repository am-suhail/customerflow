<?php

namespace App\Http\Livewire\Forms\CustomerFlow;

use Livewire\Component;
use App\Models\CustomerFlow;
use App\Models\Company;
use App\Models\Branch;

class Edit extends Component
{
    public $customerFlowId; 
    public $company_id;
    public $branch_id;
    public $date;
    public $invoices;
    public $loyalty_cards;
    public $remark;

    public $companies;
    public $branches;

    public function mount($customerFlowId)
    {
        $customerFlow = CustomerFlow::findOrFail($this->customerFlowId);
        $this->company_id = $customerFlow->branch->company->id;
        $this->branch_id = $customerFlow->branch_id;
        $this->date = $customerFlow->date;
        $this->invoices = $customerFlow->invoices;
        $this->loyalty_cards = $customerFlow->loyalty_cards;
        $this->remark = $customerFlow->remark;
    
        $this->companies = Company::pluck('name', 'id');
        $this->branches = Branch::where('company_id', $this->company_id)->pluck('name', 'id');
    }
    public function updatedCompany_id($value)
    {
        
        if ($value) {
            $this->branches = Branch::where('company_id', $value)->pluck('name', 'id');
        } else {
            $this->branches = [];
        }
    }
    
      public function update()
    {
        $validated = $this->validate([
            'company_id' => ['required', 'not_in:0'],
            'branch_id' => ['required', 'not_in:0'],
            'date' => ['required', 'date'],
            'invoices' => ['required', 'integer'],
            'loyalty_cards' => ['required', 'integer'],
            'remark' => ['nullable', 'string'],
        ]);

    
        $customerFlow = CustomerFlow::findOrFail($this->customerFlowId);
        $customerFlow->update($validated);

        session()->flash('message', 'Customer Flow Updated');

        return redirect()->route('customer-flow.index');
    }

        public function render()
    {
        return view('livewire.forms.customer-flow.edit');
    }

}
