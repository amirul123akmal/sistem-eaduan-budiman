<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintType;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Statistics
        $stats = [
            'menunggu' => Complaint::where('status', 'menunggu')->count(),
            'diterima' => Complaint::where('status', 'diterima')->count(),
            'ditolak' => Complaint::where('status', 'ditolak')->count(),
            'selesai' => Complaint::where('status', 'selesai')->count(),
            'total' => Complaint::count(),
        ];

        // Complaints Trend by Month (last 12 months)
        $trendData = Complaint::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $trendLabels = $trendData->pluck('month')->map(function($month) {
            return date('M Y', strtotime($month . '-01'));
        })->toArray();
        $trendCounts = $trendData->pluck('count')->toArray();

        // Complaints by Category
        $categoryData = ComplaintType::withCount('complaints')
            ->orderBy('complaints_count', 'desc')
            ->get();

        $totalComplaints = $stats['total'];
        $categoryStats = $categoryData->map(function($type) use ($totalComplaints) {
            $count = $type->complaints_count;
            $percentage = $totalComplaints > 0 ? round(($count / $totalComplaints) * 100, 1) : 0;
            return [
                'name' => $type->type_name,
                'count' => $count,
                'percentage' => $percentage,
            ];
        });

        // Recent Complaints (last 10)
        $recentComplaints = Complaint::with('complaintType')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'trendLabels', 'trendCounts', 'categoryStats', 'recentComplaints'));
    }
}

