<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalLeaves = $user->leaveRequests()->count();
        $pendingLeaves = $user->leaveRequests()->where('status', 'Pending')->count();
        $approvedLeaves = $user->leaveRequests()->where('status', 'Approved')->count();
        $rejectedLeaves = $user->leaveRequests()->where('status', 'Rejected')->count();

        $recentRequests = $user->leaveRequests()
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalLeaves',
            'pendingLeaves',
            'approvedLeaves',
            'rejectedLeaves',
            'recentRequests'
        ));
    }
}