<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            }
        }

        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function approve(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot modify admin accounts.');
        }

        $user->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function reject(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot modify admin accounts.');
        }

        $user->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'User access revoked.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete admin accounts.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}