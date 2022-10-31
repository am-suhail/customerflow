<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('All Users', '');
        return view('office.user.index');
    }

    public function employees()
    {
        $this->setPageTitle('All Users', '');
        return view('office.user.employees');
    }

    public function manage($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $this->setPageTitle('Manage Roles', '');
        return view('office.user.manage', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validated = request()->validate([
            'roles' => 'array'
        ]);

        $user = User::findOrFail($id);
        $updated = $user->syncRoles($validated['roles']);

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong!', 'warning', true, true);
        }

        return $this->responseRedirect('all-users', 'Roles Updated!', 'success');
    }
}
