<?php

namespace App\Http\Controllers\Admin\Access;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(20);
        return view('admin.access.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.access.permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:permissions,name'],
        ]);
        Permission::create(['name' => $validated['name'], 'guard_name' => 'web']);
        return redirect()->route('admin.permissions.index')->with('status', 'Izin dicipta');
    }

    public function edit(Permission $permission)
    {
        return view('admin.access.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('permissions', 'name')->ignore($permission->id)],
        ]);
        $permission->name = $validated['name'];
        $permission->save();
        return redirect()->route('admin.permissions.index')->with('status', 'Izin dikemaskini');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('status', 'Izin dipadam');
    }
}
