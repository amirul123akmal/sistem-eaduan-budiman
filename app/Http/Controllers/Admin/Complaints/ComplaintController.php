<?php

namespace App\Http\Controllers\Admin\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\ComplaintStatusLog;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ComplaintController extends Controller
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

    public function index(Request $request): View
    {
        // Check permission to view - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('view complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk melihat aduan.');
        }

        $query = Complaint::with(['complaintType'])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by complaint type
        if ($request->has('complaint_type_id') && $request->complaint_type_id !== '') {
            $query->where('complaint_type_id', $request->complaint_type_id);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $complaints = $query->paginate(15);
        $complaintTypes = ComplaintType::orderBy('type_name')->get();
        $statuses = ['menunggu', 'diterima', 'ditolak', 'selesai'];

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');

        return view('admin.complaints.index', compact('complaints', 'complaintTypes', 'statuses', 'isAdminPanel'));
    }

    public function create(): View
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('create complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk menambah aduan.');
        }

        $complaintTypes = ComplaintType::orderBy('type_name')->get();
        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaints.create', compact('complaintTypes', 'isAdminPanel'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('create complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk menambah aduan.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:200', 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
            'complaint_type_id' => ['required', 'exists:complaint_types,id'],
            'description' => ['required', 'string', 'max:500'],
            'image_path' => ['nullable', 'array', 'max:10'],
            'image_path.*' => ['image', 'max:2048'],
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'admin_comment' => ['nullable', 'string', 'max:500'],
        ], [
            'name.required' => 'Nama diperlukan.',
            'name.regex' => 'Nama hanya boleh mengandungi huruf dan ruang.',
            'name.max' => 'Nama tidak boleh melebihi 100 aksara.',
            'phone_number.required' => 'Nombor telefon diperlukan.',
            'phone_number.regex' => 'Nombor telefon hanya boleh mengandungi nombor.',
            'phone_number.max' => 'Nombor telefon tidak boleh melebihi 20 aksara.',
            'address.required' => 'Alamat diperlukan.',
            'address.regex' => 'Alamat hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).',
            'address.max' => 'Alamat tidak boleh melebihi 200 aksara.',
            'complaint_type_id.required' => 'Jenis aduan diperlukan.',
            'complaint_type_id.exists' => 'Jenis aduan yang dipilih tidak sah.',
            'description.required' => 'Penerangan diperlukan.',
            'description.max' => 'Penerangan tidak boleh melebihi 500 aksara.',
            'status.required' => 'Status diperlukan.',
            'status.in' => 'Status yang dipilih tidak sah.',
            'image_path.array' => 'Gambar mestilah dalam format yang betul.',
            'image_path.max' => 'Maksimum 10 gambar dibenarkan.',
            'image_path.*.image' => 'Semua fail yang dimuat naik mestilah imej.',
            'image_path.*.max' => 'Saiz setiap imej tidak boleh melebihi 2MB.',
            'admin_comment.max' => 'Komen admin tidak boleh melebihi 500 aksara.',
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('image_path')) {
            $imagePaths = [];
            foreach ($request->file('image_path') as $image) {
                $imagePaths[] = $image->store('complaints', 'public');
            }
            $validated['image_path'] = $imagePaths;
        } else {
            unset($validated['image_path']);
        }

        $complaint = Complaint::create($validated);

        // Create status log
        ComplaintStatusLog::create([
            'complaint_id' => $complaint->id,
            'status' => $complaint->status,
            'updated_by' => Auth::id(),
            'comment' => $request->admin_comment,
            'created_at' => now(),
        ]);

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index';

        return redirect()->route($redirectRoute)->with('success', 'Aduan berjaya dicipta.');
    }

    public function show(Complaint $complaint): View
    {
        // Check permission to view - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('view complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk melihat aduan.');
        }

        $complaint->load(['complaintType', 'statusLogs.updater']);
        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaints.show', compact('complaint', 'isAdminPanel'));
    }

    public function edit(Complaint $complaint): View
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('edit complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk mengemaskini aduan.');
        }

        $complaintTypes = ComplaintType::orderBy('type_name')->get();
        $statuses = ['menunggu', 'diterima', 'ditolak', 'selesai'];
        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        return view('admin.complaints.edit', compact('complaint', 'complaintTypes', 'statuses', 'isAdminPanel'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('edit complaints')) {
            abort(403, 'Anda tidak mempunyai kebenaran untuk mengemaskini aduan.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:200', 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
            'complaint_type_id' => ['required', 'exists:complaint_types,id'],
            'description' => ['required', 'string', 'max:500'],
            'image_path' => ['nullable', 'array', 'max:10'],
            'image_path.*' => ['image', 'max:2048'],
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'admin_comment' => ['nullable', 'string', 'max:500'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['string'],
        ], [
            'name.required' => 'Nama diperlukan.',
            'name.regex' => 'Nama hanya boleh mengandungi huruf dan ruang.',
            'name.max' => 'Nama tidak boleh melebihi 100 aksara.',
            'phone_number.required' => 'Nombor telefon diperlukan.',
            'phone_number.regex' => 'Nombor telefon hanya boleh mengandungi nombor.',
            'phone_number.max' => 'Nombor telefon tidak boleh melebihi 20 aksara.',
            'address.required' => 'Alamat diperlukan.',
            'address.regex' => 'Alamat hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).',
            'address.max' => 'Alamat tidak boleh melebihi 200 aksara.',
            'complaint_type_id.required' => 'Jenis aduan diperlukan.',
            'complaint_type_id.exists' => 'Jenis aduan yang dipilih tidak sah.',
            'description.required' => 'Penerangan diperlukan.',
            'description.max' => 'Penerangan tidak boleh melebihi 500 aksara.',
            'status.required' => 'Status diperlukan.',
            'status.in' => 'Status yang dipilih tidak sah.',
            'image_path.array' => 'Gambar mestilah dalam format yang betul.',
            'image_path.max' => 'Maksimum 10 gambar dibenarkan.',
            'image_path.*.image' => 'Semua fail yang dimuat naik mestilah imej.',
            'image_path.*.max' => 'Saiz setiap imej tidak boleh melebihi 2MB.',
            'admin_comment.max' => 'Komen admin tidak boleh melebihi 500 aksara.',
        ]);

        // Handle multiple image uploads and removals
        $existingImages = $complaint->image_path ?? [];
        
        // Remove selected images
        if ($request->has('remove_images') && is_array($request->remove_images)) {
            foreach ($request->remove_images as $imageToRemove) {
                if (Storage::disk('public')->exists($imageToRemove)) {
                    Storage::disk('public')->delete($imageToRemove);
                }
                $existingImages = array_values(array_filter($existingImages, function($img) use ($imageToRemove) {
                    return $img !== $imageToRemove;
                }));
            }
        }
        
        // Add new images
        if ($request->hasFile('image_path')) {
            $newImagePaths = [];
            foreach ($request->file('image_path') as $image) {
                $newImagePaths[] = $image->store('complaints', 'public');
            }
            $validated['image_path'] = array_merge($existingImages, $newImagePaths);
        } else {
            $validated['image_path'] = $existingImages;
        }
        
        // If no images left, set to null
        if (empty($validated['image_path'])) {
            $validated['image_path'] = null;
        }

        $oldStatus = $complaint->status;
        $complaint->update($validated);

        // Create status log if status changed
        if ($oldStatus !== $complaint->status) {
            ComplaintStatusLog::create([
                'complaint_id' => $complaint->id,
                'status' => $complaint->status,
                'updated_by' => Auth::id(),
                'comment' => $request->admin_comment,
                'created_at' => now(),
            ]);
        }

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index';

        return redirect()->route($redirectRoute)->with('success', 'Aduan berjaya dikemaskini.');
    }

    public function destroy(Complaint $complaint): RedirectResponse|JsonResponse
    {
        // Check permission - Super Admin bypasses, others need direct permission
        if (!$this->hasPermissionOrSuperAdmin('delete complaints')) {
            $routePrefix = request()->route()->getName();
            $isAdminPanel = str_contains($routePrefix, 'admin.panel');
            $redirectRoute = $isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index';
            
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak mempunyai kebenaran untuk memadam aduan.'
                ], 403);
            }
            
            return redirect()->route($redirectRoute)
                ->with('error', 'Anda tidak mempunyai kebenaran untuk memadam aduan.');
        }

        // Delete all images if exist
        if ($complaint->image_path && is_array($complaint->image_path)) {
            foreach ($complaint->image_path as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $complaint->delete();

        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');
        $redirectRoute = $isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index';

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Aduan berjaya dipadam.'
            ]);
        }

        return redirect()->route($redirectRoute)->with('success', 'Aduan berjaya dipadam.');
    }
}

