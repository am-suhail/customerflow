<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view projects');

        $this->setPageTitle('All Projects', '');
        return view('office.project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view projects');

        $project = Project::findOrFail($id);

        $this->setPageTitle('Project Details: ' . $project->name, '');
        return view('office.project.show', compact('project'));
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
                'code'                  => ['required', 'unique:projects,code,' . $id . ',id,deleted_at,NULL'],
                'inward'                => ['required', 'date'],
                'vendor_id'             => ['required', 'not_in:0'],
                'referral_no'           => ['required', 'string'],
                'building_name'         => ['required', 'string'],
                'city_id'               => ['required', 'not_in:0'],
                'area'                  => ['nullable', 'string', 'max:45'],
                'street'                => ['nullable', 'string', 'max:45'],
                'remarks'               => ['nullable', 'string', 'max:191'],
                'services.*.service_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
                'services.*.price'      => ['required', 'numeric']
            ],
            [
                'services.*.service_id.required' => 'Please, specify the service',
                'services.*.qty.required' => 'A Quantity for the specified service is missing',
                'services.*.price.required' => 'Please Mention price for the specified service'
            ]
        );

        $project = Project::findOrFail($id);
        $updated = $project->update($validated);
        $project->services()->delete();

        if (!empty($validated['services'])) {
            $updated = $project->services()->createMany($validated['services']);
        }

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong, could not edit project at this moment', 'warning', true, true);
        }

        return redirect()->route('project.index')->with('success', 'Project Updated');
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

        return redirect()->route('project.index')->with('success', 'Status Changed!');
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
