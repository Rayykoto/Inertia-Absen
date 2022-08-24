<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $permissions = Permission::when(request()->r, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->r . '%');
            })->latest()->paginate(5);

        //render ke inertia
        return inertia('Apps/Permissions/Index', [
            'permissions'   => $permissions
        ]);
    }

    public function create()
    {
        return inertia('Apps/Permissions/Create');
    }
}
