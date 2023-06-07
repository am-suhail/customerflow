<?php

namespace App\Http\Controllers\Office;

use App\Exports\BranchExport;
use App\Http\Controllers\BaseController;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Country;

class BranchController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view branches');

        $this->setPageTitle('Branches', '');
        return view('office.branch.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add branch');

        $countries = Country::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        $this->setPageTitle('Add Branch', '');
        return view('office.branch.create', compact('countries', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        $this->authorize('add branch');

        $validated = $request->validated();

        $lastBranch = Branch::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastBranch ? $lastBranch->code : 'BR-000000');
        $digits = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $code = 'BR-' . $digits;

        $validated['code'] = $code;

        $create = Branch::create($validated);

        if (!$create) {
            return $this->responseRedirectBack('Something went wrong! Please try later', 'warning', true, true);
        }
        return $this->responseRedirect('branch.index', 'Branch added Successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit branch');

        $branch = Branch::findOrFail($id);
        $countries = Country::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        $this->setPageTitle('Edit ' . $branch->company_name, '');
        return view('office.branch.edit', compact('branch', 'countries', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        $this->authorize('edit branch');

        $validated = $request->validated();

        $branch = Branch::findOrFail($id);
        $updated = $branch->update($validated);

        if (!$updated) {
            return $this->responseRedirectBack('Sorry! Something went wrong', 'warning', true, true);
        }

        return $this->responseRedirect('branch.index', 'Branch updated!', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $this->authorize('export branches');

        return Excel::download(new BranchExport(Vendor::all()), 'branches_' . now() . '.xlsx');
    }
}
