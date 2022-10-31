<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Country;
use App\Models\Industry;
use App\Models\Qualification;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->setPageTitle('Customer Data', '');
        return view('office.vendor.index');
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

        $this->setPageTitle('Add Customer', '');
        return view('office.vendor.create', compact('industries', 'countries'));
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
            'name' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'mobile' => ['required', 'phone:AE'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string', 'max:100'],
            'industry_id' => ['required', 'not_in:0'],
            'vat' => ['required', 'string', 'max:20', 'unique:vendors,vat'],
            'url' => ['nullable', 'url'],
            'city_id' => ['required', 'not_in:0'],
            'telephone' => ['required', 'phone:AE', 'unique:vendors,telephone'],
            'remarks' => ['nullable', 'string']
        ]);

        $code = 'CUST-' . mt_rand(111111111, 999999999);
        $validated['code'] = $code;

        $create = Vendor::create($validated);

        if (!$create) {
            return $this->responseRedirectBack('Something went wrong! Please try later', 'warning', true, true);
        }
        return $this->responseRedirect('vendor.index', 'Customer added Successfully', 'success');
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
        $vendor = Vendor::findOrFail($id);
        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        $this->setPageTitle('Edit Customer' . $vendor->name, '');
        return view('office.vendor.edit', compact('vendor', 'industries', 'countries'));
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
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'mobile' => ['required', 'phone:AE'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string', 'max:100'],
            'industry_id' => ['required', 'not_in:0'],
            'vat' => ['required', 'string', 'max:20'],
            'url' => ['nullable', 'url'],
            'city_id' => ['required', 'not_in:0'],
            'telephone' => ['required', 'phone:AE'],
            'remarks' => ['nullable', 'string']
        ]);

        $vendor = Vendor::findOrFail($id);
        $updated = $vendor->update($validated);

        if (!$updated) {
            return $this->responseRedirectBack('Sorry! Something went wrong', 'warning', true, true);
        }

        return $this->responseRedirect('vendor.index', 'Customer updated!', 'success');
    }
}
