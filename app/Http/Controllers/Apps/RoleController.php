<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() 
    {
        $roles = Role::when(request()->r, function($roles) {
            $roles = $roles->where('name', 'like', '%'. request()->r . '%');
        })->with('permissions')->latest()->paginate(5);

        // dd($roles);

        return Inertia('Apps/Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        //render with ienrtia
        return Inertia('Apps/Roles/Create', [
            'permissions'   => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          =>  'required',
            'permissions'   =>  'required'
        ]);

        $role = Role::create(['name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('apps.roles.index');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::all();

        return inertia('Apps/Roles/Edit', [
            'role'          => $role,
            'permissions'   => $permissions,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('apps.roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('apps.roles.index');
    }
    
}
