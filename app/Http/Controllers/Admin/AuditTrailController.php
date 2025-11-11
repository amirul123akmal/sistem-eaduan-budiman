<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintStatusLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditTrailController extends Controller
{
    public function index(Request $request): View
    {
        $query = ComplaintStatusLog::with(['complaint.complaintType', 'updater'])
            ->orderBy('created_at', 'desc');

        // Filter by status - validate against allowed statuses
        $validStatuses = ['menunggu', 'diterima', 'ditolak', 'selesai'];
        if ($request->has('status') && $request->status !== '' && in_array($request->status, $validStatuses)) {
            $query->where('status', $request->status);
        }

        // Filter by complaint ID or public_id
        if ($request->has('complaint_id') && $request->complaint_id !== '') {
            $complaintId = trim($request->complaint_id);
            
            // Check if it's a numeric ID or public_id
            if (is_numeric($complaintId)) {
                $query->where('complaint_id', $complaintId);
            } else {
                // Search by public_id
                $query->whereHas('complaint', function($q) use ($complaintId) {
                    $q->where('public_id', 'like', "%{$complaintId}%");
                });
            }
        }

        // Search by updater name or complaint details
        if ($request->has('search') && $request->search !== '') {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                // Search by updater name
                $q->whereHas('updater', function($updaterQuery) use ($search) {
                    $updaterQuery->where('name', 'like', "%{$search}%");
                })
                // Or search by complaint name
                ->orWhereHas('complaint', function($complaintQuery) use ($search) {
                    $complaintQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('public_id', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                })
                // Or search by comment
                ->orWhere('comment', 'like', "%{$search}%");
            });
        }

        $auditTrails = $query->paginate(20);
        $statuses = $validStatuses;
        
        // Detect if this is admin panel route
        $routePrefix = request()->route()->getName();
        $isAdminPanel = str_contains($routePrefix, 'admin.panel');

        return view('admin.audit-trails.index', compact('auditTrails', 'statuses', 'isAdminPanel'));
    }
}

