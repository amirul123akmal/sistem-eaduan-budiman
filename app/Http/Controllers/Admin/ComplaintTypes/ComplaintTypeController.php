<?php

namespace App\Http\Controllers\Admin\ComplaintTypes;

use App\Http\Controllers\Controller;
use App\Models\ComplaintType;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComplaintTypeController extends Controller
{
    /**
     * Check if user has permission or is Super Admin
     */
    protected function hasPermissionOrSuperAdmin(string $permission): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }
        
        // Super Admin has all permissions automatically
        if ($user->hasRole('Super Admin')) {
            return true;
        }
        
        // Check for direct permission
        return $user->hasDirectPermission($permission);
    }

    public function index(): View
    {
        // Check permission to view - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('view complaint types')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk melihat jenis aduan.');
        }

        $complaintTypes = ComplaintType::orderBy('type_name')->paginate(15);
        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaint-types.index', compact('complaintTypes', 'isAdminPanel'));
    }

    public function create(): View
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('create complaint types')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk menambah jenis aduan.');
        }

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaint-types.create', compact('isAdminPanel'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('create complaint types')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk menambah jenis aduan.');
        }

        $validated = $request->validate([
            'type_name' => ['required', 'string', 'max:100', 'unique:complaint_types,type_name', 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'type_name.required' => 'Nama jenis aduan diperlukan.',
            'type_name.unique' => 'Nama jenis aduan ini sudah wujud.',
            'type_name.regex' => 'Nama jenis aduan hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).',
            'type_name.max' => 'Nama jenis aduan tidak boleh melebihi 100 aksara.',
            'description.max' => 'Penerangan tidak boleh melebihi 500 aksara.',
        ]);

        ComplaintType::create($validated);

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index';
        
        return redirect()->route($redirectRoute)->with('success', 'Jenis aduan berjaya dicipta.');
    }

    public function edit(ComplaintType $complaintType): View
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('edit complaint types')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk mengemaskini jenis aduan.');
        }

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaint-types.edit', compact('complaintType', 'isAdminPanel'));
    }

    public function update(Request $request, ComplaintType $complaintType): RedirectResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('edit complaint types')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk mengemaskini jenis aduan.');
        }

        $validated = $request->validate([
            'type_name' => ['required', 'string', 'max:100', 'unique:complaint_types,type_name,' . $complaintType->id, 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'type_name.required' => 'Nama jenis aduan diperlukan.',
            'type_name.unique' => 'Nama jenis aduan ini sudah wujud.',
            'type_name.regex' => 'Nama jenis aduan hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).',
            'type_name.max' => 'Nama jenis aduan tidak boleh melebihi 100 aksara.',
            'description.max' => 'Penerangan tidak boleh melebihi 500 aksara.',
        ]);

        $complaintType->update($validated);

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index';
        
        return redirect()->route($redirectRoute)->with('success', 'Jenis aduan berjaya dikemaskini.');
    }

    public function destroy(ComplaintType $complaintType): RedirectResponse|JsonResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('delete complaint types')) {
            $routePrefix = request()->route()->getName();
            $isAdminPanel = str_contains($routePrefix, 'admin.panel');
            $redirectRoute = $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index';
            
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak mempunyai kebenaran untuk memadam jenis aduan.'
                ], 403);
            }
            
            return redirect()->route($redirectRoute)
                ->with('error', 'Anda tidak mempunyai kebenaran untuk memadam jenis aduan.');
        }

        // Check if this complaint type is being used by any complaints
        if ($complaintType->complaints()->exists()) {
            $routePrefix = request()->route()->getName();
            $isAdminPanel = str_contains($routePrefix, 'admin.panel');
            $redirectRoute = $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index';
            
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis aduan ini tidak boleh dipadam kerana masih digunakan dalam aduan.'
                ], 422);
            }
            
            return redirect()->route($redirectRoute)
                ->with('error', 'Jenis aduan ini tidak boleh dipadam kerana masih digunakan dalam aduan.');
        }

        $complaintType->delete();

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index';
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jenis aduan berjaya dipadam.'
            ]);
        }
        
        return redirect()->route($redirectRoute)->with('success', 'Jenis aduan berjaya dipadam.');
    }
}

