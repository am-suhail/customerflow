<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Branch;
use App\Models\CustomerFlow;
use Illuminate\Http\Request;

use Auth;

class CustomerFlowController extends BaseController
{
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

    
    $branches = Branch::pluck('name', 'id');
        $this->setPageTitle('Customer Flow', '');
        return view('office.customer-flow.create', compact('branches'));
}

public function store(Request $request)
{
    $validated = $request->validate([
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

    $customer_flow = CustomerFlow::findOrFail($id);

    
    $branches = Branch::pluck('name', 'id');

    $this->setPageTitle('Edit Customer Flow' , '');

    return view('office.customer-flow.edit', compact('customer_flow', 'branches'));
}

    
public function update(Request $request, $id)

{
    $validated = $request->validate([
        'branch_id' => ['required', 'integer', 'exists:branches,id'],

        'date' => ['required' , 'date'],
        'invoices' => ['required' , 'integer'],
        'loyalty_cards' => ['required','integer'],
        'remark' => ['nullable', 'string'],
        
    ]);
      

    $customer_flow = customerFlow::findOrFail($id);
    $updated = $customer_flow->update($validated);

    if (!$updated) {
        return $this->responseRedirectBack('Sorry! Something went wrong', 'warning', true, true);
    }

    return $this->responseRedirect('customer-flow.index', 'Customer Flow updated!', 'success');
}

public function destroy($id)
{
    if (! Auth::user()->can('delete customer flow')) {
        abort(405, '');
    }

    return redirect()->route('customer-flow.index')
        ->with('success', 'Customer Flow deleted successfully.');
}


}
