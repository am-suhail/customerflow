<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Country;
use App\Models\Designation;
use App\Models\EmployeeDetail;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view employees');

        $this->setPageTitle('Employees', '');
        return view('office.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->authorize('manage employee');

        $user = User::findOrFail($id);
        $designations = Designation::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $qualifications = Qualification::pluck('name', 'id');

        $this->setPageTitle('Edit: ' . Str::limit($user->name, 15, '..'), '');
        return view('office.employee.edit', compact('user', 'designations', 'qualifications', 'countries'));
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
        $this->authorize('manage employee');

        $validated = $request->validate([
            'national_id' => ['required', 'string'],
            'national_id_expiry' => ['required', 'date'],
            'sex' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'country_id' => ['required', 'not_in:0'],
            'building_name' => ['required', 'string'],
            'city_id' => ['required', 'not_in:0'],
            'area_text' => ['nullable', 'string'],
            'street_text' => ['nullable', 'string'],
            'qualification_id' => ['required', 'not_in:0'],
            'years_of_exp' => ['required', 'numeric'],
            'designation_id' => ['required', 'not_in:0'],
            'joining_date' => ['required', 'date'],
            'salary' => ['required', 'numeric'],
            'remark' => ['nullable', 'string', 'max:191'],
        ]);

        $user = User::findOrFail($id);

        $user->user_detail->update([
            'national_id' => $request->national_id,
            'national_id_expiry' => $request->national_id_expiry,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'country_id' => $request->country_id,
            'building_name' => $request->building_name,
            'city_id' => $request->city_id,
            'area_text' => $request->area_text,
            'street_text' => $request->street_text,
            'qualification_id' => $request->qualification_id,
            'years_of_exp' => $request->years_of_exp,
        ]);

        $updated = $user->employee_detail->update([
            'designation_id' => $request->designation_id,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'remark' => $request->remark,
        ]);

        if (!$updated) {
            return $this->responseRedirectBack('Sorry, something went wrong!', 'warning', true, true);
        }

        return $this->responseRedirect('employee.index', 'Employee Details Updated', 'success');
    }

    /**
     * Appoint the specified resource as an employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appoint($id)
    {
        $this->authorize('manage employee');

        $user = User::findOrFail($id);
        $designations = Designation::pluck('name', 'id');

        $this->setPageTitle('Appoint ' . $user->name . ' as Employee', '');
        return view('office.employee.appoint', compact('user', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process_appoint(Request $request, $id)
    {
        $this->authorize('manage employee');

        $validated = $request->validate([
            'designation_id' => ['required', 'not_in:0'],
            'joining_date' => ['required', 'date'],
            'salary' => ['required', 'numeric'],
            'remark' => ['nullable', 'string', 'max:191'],
        ]);

        $lastEmployee = EmployeeDetail::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastEmployee ? $lastEmployee->code : 'EMP-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $validated['code'] = 'EMP-' . $code;

        $user = User::findOrFail($id);

        $appointed = $user->employee_detail()->create($validated);
        $user->profile = 2;
        $user->save();

        if (!$appointed) {
            return $this->responseRedirectBack('Sorry, something went wrong!', 'warning', true, true);
        }

        return $this->responseRedirect('employee.index', 'Employee Appointed', 'success');
    }
}
