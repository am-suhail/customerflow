<?php

namespace App\Http\Livewire\Forms\CustomerFlow;

use Auth;
use App\Models\Branch;
use App\Models\Company;
use Livewire\Component;
use App\Models\CustomerFlow;

class Create extends Component
{
    public $company_id;
    public $branch_id;

    public $companies;
    public $branches;

    public $date;
    public $invoices;
    public $loyalty_cards;
    public $remark;

    public function mount()
    {
        $this->companies=Company::pluck('name','id');
        $this->branches=collect();
    }

    public function updatedCompanyId($company_id)
    {
        if($company_id){
            $this->branches=Branch::where('company_id',$company_id)->pluck('name','id');
        }
    }

    public function submit()
{
    $validated = $this->validate([
        'company_id' => ['required', 'not_in:0'],
        'branch_id' => ['required', 'not_in:0'],
        'date' => ['required', 'date'],
        'invoices' => ['required', 'integer'],
        'loyalty_cards' => ['required', 'integer'],
        'remark' => ['required', 'string'],
    ]);

    $validated['created_by_id'] = Auth::user()->id;

    $created = CustomerFlow::create($validated);

    if ($created) {
        session()->flash('message', 'Customer Flow Created');

        return redirect()->route('customer-flow.index');
    }
}

    public function render()
    {
        return view('livewire.forms.customer-flow.create');
    }
}
