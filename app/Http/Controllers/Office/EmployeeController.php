<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Country;
use App\Models\Designation;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $user = User::findOrFail($id);
        $designations = Designation::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $qualifications = Qualification::pluck('name', 'id');

        $this->setPageTitle('Edit Employee ' . $user->name, '');
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
        $validated = request()->validate([
            'nid' => ['required', 'string'],
            'nid_expiry' => ['required', 'date'],
            'dob' => ['required', 'date'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'building_name' => ['required', 'string'],
            'city_id' => ['required', 'not_in:0'],
            'area' => ['required', 'string'],
            'street' => ['required', 'string'],
            'qualification_id' => ['required', 'not_in:0'],
            'years_of_exp' => ['required', 'numeric'],
            'code' => ['required', 'string'],
            'designation_id' => ['required', 'not_in:0'],
            'joining_date' => ['required', 'date'],
            'salary' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string', 'max:191'],
        ]);
    }

    /**
     * Appoint the specified resource as an employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appoint($id)
    {
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
    public function processAppoint(Request $request, $id)
    {
        $validated = request()->validate([
            'code' => ['required', 'string'],
            'designation_id' => ['required', 'not_in:0'],
            'joining_date' => ['required', 'date'],
            'salary' => ['required', 'numeric'],
            'remarks' => ['nullable', 'string', 'max:191'],
        ]);

        $user = User::findOrFail($id);

        $appointed = $user->employee_detail()->create($validated);
        $user->profile = 'employee';
        $user->save();

        if (!$appointed) {
            return $this->responseRedirectBack('Sorry, something went wrong!', 'warning', true, true);
        }

        return $this->responseRedirect('all-users', 'Employee Appointed', 'success');
    }
}
