<?php

namespace App\Http\Controllers\Admin\Access;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->withCount('permissions')->orderBy('name')->paginate(12);
        return view('admin.access.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->pluck('name', 'name');
        return view('admin.access.roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
            'permissions' => ['array'],
            'permissions.*' => ['string'],
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('status', 'Peranan dicipta');
    }

    public function edit(Role $role)
    {
        $this->guardSuperAdmin($role);
        $permissions = Permission::orderBy('name')->pluck('name', 'name');
        $assigned = $role->permissions->pluck('name')->all();
        return view('admin.access.roles.edit', compact('role', 'permissions', 'assigned'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->guardSuperAdmin($role);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => ['array'],
            'permissions.*' => ['string'],
        ]);

        $role->name = $validated['name'];
        $role->save();
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('status', 'Peranan dikemaskini');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->guardSuperAdmin($role);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('status', 'Peranan dipadam');
    }

    public function editPermissions(Role $role)
    {
        $this->guardSuperAdmin($role);
        $permissions = Permission::orderBy('name')->pluck('name', 'name');
        $assigned = $role->permissions->pluck('name')->all();
        return view('admin.access.roles.permissions', compact('role', 'permissions', 'assigned'));
    }

    public function updatePermissions(Request $request, Role $role): RedirectResponse
    {
        $this->guardSuperAdmin($role);
        $validated = $request->validate([
            'permissions' => ['array'],
            'permissions.*' => ['string'],
        ]);
        $role->syncPermissions($validated['permissions'] ?? []);
        return redirect()->route('admin.roles.index')->with('status', 'Izin peranan dikemaskini');
    }

    protected function guardSuperAdmin(Role $role): void
    {
        abort_if($role->name === 'Super Admin', 403, 'Peranan Super Admin dilindungi.');
    }
}
