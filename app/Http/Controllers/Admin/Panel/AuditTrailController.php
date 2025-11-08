<?php

namespace App\Http\Controllers\Admin\Panel;

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

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by complaint ID
        if ($request->has('complaint_id') && $request->complaint_id !== '') {
            $query->where('complaint_id', $request->complaint_id);
        }

        // Search by updater name
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('updater', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $auditTrails = $query->paginate(20);
        $statuses = ['menunggu', 'diterima', 'ditolak', 'selesai'];
        $isAdminPanel = true;

        return view('admin.audit-trails.index', compact('auditTrails', 'statuses', 'isAdminPanel'));
    }
}

