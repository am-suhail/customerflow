<?php

namespace App\Http\Controllers\Office;

use Auth;
use App\Models\Branch;
use App\Models\Company;
use App\Models\CustomerFlow;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class CustomerFlowController extends BaseController
{
    public $customerId;
    
    public function index()
    {
        if (! Auth::user()->can('view cutomer flow')) {
            abort(405, '');
        }

        $this->setPageTitle('Customer Flow', '');
        return view('office.customer-flow.index');
    }

public function create()
{
    if (! Auth::user()->can('add customer flow')) {
        abort(405, '');
    }

    $companies = Company::pluck('name', 'id');
    $branches = Branch::pluck('name', 'id');
        $this->setPageTitle('Customer Flow', '');
        return view('office.customer-flow.create', compact('companies' , 'branches'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'company_id' => ['required', 'not_in:0'],
        'branch_id' => ['required', 'not_in:0'],
        'date' => ['required', 'date'],
        'invoices' => ['required' , 'integer'],
        'loyalty_cards' => ['required' , 'integer'],
        'remark' => ['nullable', 'string'],
        
    ]);
    $validated['created_by_id'] = Auth::user()->id;

    $create = CustomerFlow::create($validated);

    if (!$create) {
        return $this->responseRedirectBack('Something went wrong! Please try later', 'warning', true, true);
    }
    return $this->responseRedirect('customer-flow.index', 'Customer  added Successfully', 'success');
}



public function edit($id)
{
    if (!Auth::user()->can('edit customer flow')) {
        abort(405, '');
    }

    $customerFlow = CustomerFlow::findOrFail($id);

    
    $companies = Company::pluck('name', 'id');
    $branches = Branch::where('company_id', $customerFlow->company_id)->pluck('name', 'id');

    $this->setPageTitle('Edit Customer Flow' , '');

    return view('office.customer-flow.edit', compact('customerFlow','companies', 'branches'));
}

    
public function update(Request $request, $customerId)

{
    $validated = $request->validate([

        'branch_id' => ['required', 'integer', 'exists:branches,id'],

        'date' => ['required' , 'date'],
        'invoices' => ['required' , 'integer'],
        'loyalty_cards' => ['required','integer'],
        'remark' => ['nullable', 'string'],
        
    ]);
      

    $customerFlow = customerFlow::findOrFail($customerId);
    $updated = $customerFlow->update($validated);

    if (!$updated) {
        return $this->responseRedirectBack('Sorry! Something went wrong', 'warning', true, true);
    }

    return $this->responseRedirect('customer-flow.index', 'Customer Flow updated!', 'success');
}

public function destroy($customerId)
{
    if (! Auth::user()->can('delete customer flow')) {
        abort(405, '');
    }

    return redirect()->route('customer-flow.index')
        ->with('success', 'Customer Flow deleted ');
}


}
