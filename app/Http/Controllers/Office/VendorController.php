<?php

namespace App\Http\Controllers\Office;

use App\Exports\BranchExport;
use App\Http\Controllers\BaseController;
use App\Models\Company;
use App\Models\Country;
use App\Models\Industry;
use App\Models\Qualification;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends BaseController
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

        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        $this->setPageTitle('Add Branch', '');
        return view('office.branch.create', compact('industries', 'countries', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('add branch');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string'],
            'nationality_id' => ['required', 'not_in:0'],
            'country_id' => ['required', 'not_in:0'],
            'industry_id' => ['nullable'],
            'mobile' => ['required'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string', 'max:100'],
            'inc_date' => ['required', 'date'],
            'url' => ['nullable'],
            'city_id' => ['required', 'not_in:0'],
            'telephone' => ['required', 'unique:branches,telephone'],
            'remark' => ['nullable', 'string']
        ]);

        $code = 'CUST-' . mt_rand(111111111, 999999999);
        $validated['code'] = $code;

        $create = Vendor::create($validated);

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
        $this->authorize('edit branch');

        $branch = Branch::findOrFail($id);
        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        $this->setPageTitle('Edit ' . $branch->company_name, '');
        return view('office.branch.edit', compact('branch', 'industries', 'countries', 'companies'));
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
        $this->authorize('edit branch');

        $validated = request()->validate([
            'name' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string'],
            'nationality_id' => ['required', 'not_in:0'],
            'country_id' => ['required', 'not_in:0'],
            'industry_id' => ['nullable'],
            'mobile' => ['required'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string', 'max:100'],
            'inc_date' => ['required', 'date'],
            'vat' => ['required', 'string', 'max:20'],
            'url' => ['nullable'],
            'city_id' => ['required', 'not_in:0'],
            'telephone' => ['required'],
            'remark' => ['nullable', 'string']
        ]);

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

        return Excel::download(new BranchExport(Vendor::all()), 'branches_abc_mercantile_' . now() . '.xlsx');
    }
}
