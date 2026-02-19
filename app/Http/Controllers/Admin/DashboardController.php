<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
    $totalUsers = User::where('role', 'user')->count();
    $pendingUsers = User::where('role', 'user')->where('is_approved', false)->count();
    $approvedUsers = User::where('role', 'user')->where('is_approved', true)->count();
    $pendingRequests = LeaveRequest::where('status', 'Pending')->count();
    $approvedRequests = LeaveRequest::where('status', 'Approved')->count();
    $rejectedRequests = LeaveRequest::where('status', 'Rejected')->count();
    $totalRequests = LeaveRequest::count();

    // Recent leave requests
    $recentRequests = LeaveRequest::with('user')
        ->latest()
        ->take(5)
        ->get();

    // Pending users
    $pendingUsersList = User::where('role', 'user')
        ->where('is_approved', false)
        ->latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalUsers',
        'pendingUsers',
        'approvedUsers',
        'pendingRequests',
        'approvedRequests',
        'rejectedRequests',
        'totalRequests',
        'recentRequests',
        'pendingUsersList'
    ));
}
}