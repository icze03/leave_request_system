<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = LeaveRequest::with('user');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $leaveRequests = $query->latest()->paginate(10);
        
        return view('admin.leave-requests.index', compact('leaveRequests'));
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending requests can be approved.');
        }

        $leaveRequest->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Leave request approved successfully.');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending requests can be rejected.');
        }

        $leaveRequest->update(['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Leave request rejected successfully.');
    }
}