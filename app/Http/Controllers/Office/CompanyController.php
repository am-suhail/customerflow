<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Company;
use App\Models\Country;
use App\Models\Industry;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view company');

        $this->setPageTitle('Company', '');
        return view('office.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        $this->setPageTitle('Create Company', 'Add a new company');
        return view('office.company.create', compact('industries', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub_category_id' => ['required', 'not_in:0'],
            'name' => ['required', 'string', 'max:100'],
            'inc_date' => ['required', 'date'],
            'inc_number' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'industry_id' => ['required', 'not_in:0'],
            'tax_number' => ['required', 'string', 'max:20', 'unique:companies,tax_number'],
            'telephone' => ['required', 'unique:companies,telephone'],
            'email' => ['required', 'email'],
            'website' => ['nullable'],
            'remark' => ['nullable', 'string']
        ]);

        $create = Company::create($validated);

        if (!$create) {
            return $this->responseRedirectBack('Something went wrong! Please try later', 'warning', true, true);
        }
        return $this->responseRedirect('company.index', 'Company added Successfully', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO
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

        $company = Company::findOrFail($id);
        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        $this->setPageTitle('Edit ' . $company->name, '');
        return view('office.company.edit', compact('company', 'industries', 'countries'));
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
        $validated = $request->validate([
            'sub_category_id' => ['required', 'not_in:0'],
            'name' => ['required', 'string', 'max:100'],
            'inc_date' => ['required', 'date'],
            'inc_number' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'industry_id' => ['required', 'not_in:0'],
            'tax_number' => ['required', 'string', 'max:20', 'unique:companies,tax_number,' . $id],
            'telephone' => ['required', 'unique:companies,telephone,' . $id],
            'email' => ['required', 'email'],
            'website' => ['nullable'],
            'remark' => ['nullable', 'string']
        ]);

        $company = Company::findOrFail($id);
        $updated = $company->update($validated);

        if (!$updated) {
            return $this->responseRedirectBack('Sorry! Something went wrong', 'warning', true, true);
        }

        return $this->responseRedirect('company.index', 'Company updated!', 'success');
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
}
