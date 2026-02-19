<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = auth()->user()
            ->leaveRequests()
            ->latest()
            ->paginate(10);

        return view('user.leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('user.leave-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|in:Vacation,Sick,Emergency',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|min:10|max:500',
        ]);

        auth()->user()->leaveRequests()->create($validated);

        return redirect()->route('user.leave-requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('user.leave-requests.show', compact('leaveRequest'));
    }
}