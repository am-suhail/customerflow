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
        $this->authorize('view users');

        $this->setPageTitle('All Users', '');
        return view('office.user.index');
    }

    public function manage($id)
    {
        $this->authorize('manage user');

        $user = User::findOrFail($id);
        $roles = Role::all();

        $this->setPageTitle('Manage Roles', '');
        return view('office.user.manage', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage user');

        $validated = request()->validate([
            'roles' => 'array'
        ]);

        $user = User::findOrFail($id);
        $updated = $user->syncRoles($validated['roles']);

        if (!$updated) {
            return $this->responseRedirectBack('Something went wrong!', 'warning', true, true);
        }

        return $this->responseRedirect('user.index', 'Roles Updated!', 'success');
    }
}
