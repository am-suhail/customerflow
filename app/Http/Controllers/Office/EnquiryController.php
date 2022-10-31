<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\ProjectEnquiry;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Auth;

class EnquiryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view projects');

        $this->setPageTitle('Enquiries', '');
        return view('office.enquiry.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $vendors = Vendor::pluck('name', 'id');
        $employees = User::whereProfile('employee')->pluck('name', 'id');

        $this->setPageTitle('New Project Enquiry', '');
        return view('office.enquiry.create', compact('categories', 'vendors', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate(
            [
                'name'                  => ['required', 'string', 'max:191'],
                'date'                  => ['required', 'date'],
                'category_id'           => ['required', 'not_in:0'],
                'vendor_id'             => ['required', 'not_in:0'],
                'building_name'         => ['required', 'string'],
                'city_id'               => ['required', 'not_in:0'],
                'area'                  => ['nullable', 'string', 'max:45'],
                'street'                => ['nullable', 'string', 'max:45'],
                'requirement'           => ['nullable', 'string'],
                'assigned_user_id'      => ['nullable', 'not_in:0']
            ]
        );

        $lastEnquiry = ProjectEnquiry::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastEnquiry ? $lastEnquiry->code : 'DITEQ-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $validated['code'] = 'DITEQ-' . $code;
        $validated['status'] = ProjectEnquiry::ENQUIRY_OPEN;
        $validated['user_id'] = Auth::id();

        $created = ProjectEnquiry::create($validated);

        if (!$created) {
            return $this->responseRedirectBack('Something went wrong', 'warning', true, true);
        }

        return redirect()->route('enquiry.index')->with('success', 'Enquiry added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->authorize('edit project');

        $enquiry = ProjectEnquiry::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $vendors = Vendor::pluck('name', 'id');
        $employees = User::whereProfile('employee')->pluck('name', 'id');

        $this->setPageTitle('Edit: ' . $enquiry->name, '');
        return view('office.enquiry.edit', compact('enquiry', 'categories', 'vendors', 'employees'));
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
        $validated = request()->validate(
            [
                'name'                  => ['required', 'string', 'max:191'],
                'date'                  => ['required', 'date'],
                'category_id'           => ['required', 'not_in:0'],
                'vendor_id'             => ['required', 'not_in:0'],
                'building_name'         => ['required', 'string'],
                'city_id'               => ['required', 'not_in:0'],
                'area'                  => ['nullable', 'string', 'max:45'],
                'street'                => ['nullable', 'string', 'max:45'],
                'requirement'           => ['nullable', 'string', 'max:191'],
                'assigned_user_id'      => ['nullable', 'not_in:0'],
            ]
        );

        $enquiry = ProjectEnquiry::findOrFail($id);
        $updated = $enquiry->update($validated);

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong, could not edit enquiry at this moment', 'warning', true, true);
        }

        return redirect()->route('enquiry.index')->with('success', 'Enquiry updated successfully');
    }

    /**
     * Display a listing of resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status_update(Request $request)
    {
        $project = Project::findOrFail($request->id);

        $update = $project->status()->create([
            'badge' => Str::remove(' ', Str::lower($request->badge)),
            'user_id' => Auth::id(),
            'comment' => 'Change of status - Project Update'
        ]);

        if (!$update) {
            return $this->responseRedirectBack('Something went wrong!', 'error', true, true);
        }

        return $this->responseRedirect('project.index', 'Status Changed!', 'success');
    }

    /**
     * Display a listing of resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logs()
    {
        $projects = Project::with('audits.user', 'audits.auditable')->get();

        $this->setPageTitle('Project Logs', '');
        return view('office.log.project', compact('projects'));
    }
}
