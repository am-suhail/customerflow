<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Designation;
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
        //
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
        //
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
        //
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
