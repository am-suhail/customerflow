<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view roles');

        $this->setPageTitle('Roles & Permissions', '');
        return view('office.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add role');

        $permissions = Permission::all();

        $this->setPageTitle('Create New Role', '');
        return view('office.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('add role');

        $validated = request()->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array']
        ]);

        $role = Role::create(['name' => $validated['name']]);
        $created = $role->syncPermissions($validated['permissions']);

        if (!$created) {
            return $this->responseRedirectBack('Something went wrong', 'error', true, true);
        }

        return $this->responseRedirect('roles.index', 'Role Generated!', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view roles');

        $role = Role::findOrFail($id);

        $this->setPageTitle('Role information for ' . Str::ucfirst($role->name) . '', '');
        return view('office.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit role');

        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $this->setPageTitle('Edit Role: ' . Str::upper($role->name) . '', '');
        return view('office.roles.edit', compact('role', 'permissions'));
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
        $this->authorize('edit role');

        $validated = request()->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array']
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $validated['name'],
        ]);
        $updated = $role->syncPermissions($validated['permissions']);

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong', 'warning', true, true);
        }

        return $this->responseRedirect('roles.index', 'Permissions Synced!', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete role');
    }
}
