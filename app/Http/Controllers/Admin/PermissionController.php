<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-admin-permission', ['only' => ['roleEdit', 'roleUpdate']]);
    }
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function roleEdit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.permissions.edit', compact('role', 'permissions'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $permissions = $request->permissions;
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);
        $role->givePermissionTo($permissions);
        return redirect()->route('admin.permissions');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:5|unique:permissions,name'
        ]);

        $name = $request->name;

        $permission = new Permission();
        $permission->name = $name;
        $permission->save();

        return redirect()->route('admin.permissions');
    }
}