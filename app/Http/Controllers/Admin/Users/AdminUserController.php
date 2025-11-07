<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserController extends Controller
{
	public function index()
	{
		$admins = User::query()->with('roles')->orderBy('name')->paginate(12);
		return view('admin.users.index', compact('admins'));
	}

	public function create()
	{
		$roles = Role::query()->pluck('name', 'id');
		return view('admin.users.create', compact('roles'));
	}

	public function store(Request $request): RedirectResponse
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:100'],
			'phone_number' => ['nullable', 'string', 'max:20'],
			'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
			'password' => ['required', 'string', 'min:8'],
			'position' => ['nullable', 'string', 'max:100'],
			'role' => ['required', Rule::in(['Super Admin', 'Admin'])],
		]);

		$user = new User();
		$user->name = $validated['name'];
		$user->phone_number = $validated['phone_number'] ?? null;
		$user->email = $validated['email'];
		$user->password = Hash::make($validated['password']);
		$user->position = $validated['position'] ?? null;
		$user->save();

		$user->syncRoles([$validated['role']]);

		return redirect()->route('admin.admins.index')->with('status', 'Admin created');
	}

	public function edit(User $admin)
	{
		$roles = Role::query()->pluck('name', 'id');
		return view('admin.users.edit', ['admin' => $admin, 'roles' => $roles]);
	}

	public function update(Request $request, User $admin): RedirectResponse
	{
		$validated = $request->validate([
			'name' => ['required', 'string', 'max:100'],
			'phone_number' => ['nullable', 'string', 'max:20'],
			'email' => ['required', 'string', 'email', 'max:150', Rule::unique('users', 'email')->ignore($admin->id)],
			'password' => ['nullable', 'string', 'min:8'],
			'position' => ['nullable', 'string', 'max:100'],
			'role' => ['required', Rule::in(['Super Admin', 'Admin'])],
		]);

		$admin->name = $validated['name'];
		$admin->phone_number = $validated['phone_number'] ?? null;
		$admin->email = $validated['email'];
		if (!empty($validated['password'])) {
			$admin->password = Hash::make($validated['password']);
		}
		$admin->position = $validated['position'] ?? null;
		$admin->save();

		$admin->syncRoles([$validated['role']]);

		return redirect()->route('admin.admins.index')->with('status', 'Admin updated');
	}

	public function destroy(User $admin): RedirectResponse
	{
		$admin->delete();
		return redirect()->route('admin.admins.index')->with('status', 'Admin deleted');
	}

	public function editPermissions(User $admin)
	{
		$roles = Role::query()->pluck('name', 'name');
		$permissions = Permission::query()->orderBy('name')->pluck('name', 'name');
		$assignedPermissions = $admin->permissions->pluck('name')->all();
		$currentRole = $admin->roles->pluck('name')->first();
		return view('admin.users.permissions', compact('admin', 'roles', 'permissions', 'assignedPermissions', 'currentRole'));
	}

	public function updatePermissions(Request $request, User $admin): RedirectResponse
	{
		$validated = $request->validate([
			'role' => ['required', Rule::in(['Super Admin', 'Admin'])],
			'permissions' => ['array'],
			'permissions.*' => ['string'],
		]);

		$role = $validated['role'];
		$admin->syncRoles([$role]);

		if ($role === 'Super Admin') {
			// Super Admin inherits all permissions via role; clear direct permissions
			$admin->syncPermissions([]);
		} else {
			$admin->syncPermissions($validated['permissions'] ?? []);
		}

		return redirect()->route('admin.admins.index')->with('status', 'Peranan & izin dikemaskini');
	}
}
