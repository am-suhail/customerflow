<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Country;
use App\Models\Industry;
use App\Models\MarketLead;
use Illuminate\Http\Request;
use Auth;

class MarketLeadsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Market Leads', '');
        return view('office.leads.index');
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
        $cities = City::pluck('name', 'id');

        $this->setPageTitle('New Lead', '');
        return view('office.leads.create', compact('industries', 'countries', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'languages' => 'nullable',
            'company_name' => 'required|string|max:100',
            'industry_id' => 'nullable|not_in:0',
            'email' => 'nullable|email',
            'mobile' => 'required|numeric|unique:market_leads',
            'landline' => 'nullable|numeric',
            'alternate_number' => 'nullable|numeric',
            'country_id' => 'required|not_in:0',
            'city_id' => 'required|not_in:0',
            'area' => 'nullable|string|max:25',
            'street' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:191',
            'date' => 'required|date',
            'service_id' => 'nullable|not_in:0',
            'feedback' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $validated['demo_presented'] = $request->demo_presented ? 1 : 0;
        $validated['user_id'] = Auth::id();

        $create = MarketLead::create($validated);

        if ($create) {
            return redirect()->route('leads.index')->with('success', 'Lead Added Successfully');
        }

        return $this->responseRedirectBack('warning', 'Something went wrong! Please try again', true, true);
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
        $lead = MarketLead::findOrFail($id);
        $industries = Industry::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $cities = City::pluck('name', 'id');

        $this->setPageTitle('Edit Lead', '');
        return view('office.leads.edit', compact('lead', 'industries', 'countries', 'cities'));
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
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'mobile' => ['required', 'numeric', 'unique:market_leads,mobile,' . $id],
            'email' => ['required', 'email', 'unique:market_leads,email,' . $id],
            'landline' => 'nullable|numeric',
            'alternate_number' => 'nullable|numeric',
            'country_id' => 'required|not_in:0',
            'city_id' => 'required|not_in:0',
            'area' => 'nullable|string|max:25',
            'street' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:191',
            'date' => 'required|date',
            'sub_category_id' => 'nullable|not_in:0',
            'demo_presented' => 'nullable',
            'feedback' => 'nullable|string',
            'remarks' => 'nullable|string'
        ]);

        $validated['demo_presented'] = $request->demo_presented ? 1 : 0;

        $lead = MarketLead::findOrFail($id);

        $updated = $lead->update($validated);

        if ($updated) {
            return redirect()->route('leads.index')->with('success', 'Lead Updated Successfully');
        }

        return $this->responseRedirectBack('warning', 'Something went wrong! Please try again', true, true);
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
