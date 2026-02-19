<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900">
                Admin Dashboard
            </h2>
            <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-xl shadow-md">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users Card -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:scale-105 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm uppercase tracking-wide mb-2">Total Users</h3>
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-blue-600 to-blue-800 bg-clip-text text-transparent">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-500 mt-2">Registered employees</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
            </div>
                
             @if($pendingUsers > 0)
        <!-- Pending Users Alert -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-6 shadow-xl border border-orange-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="text-white">
                        <h3 class="text-lg font-bold">{{ $pendingUsers }} User{{ $pendingUsers > 1 ? 's' : '' }} Pending Approval</h3>
                        <p class="text-sm text-white/90">New employee registrations waiting for your approval</p>
                    </div>
                </div>
                <a href="{{ route('admin.users.index', ['status' => 'pending']) }}" class="inline-flex items-center px-6 py-3 bg-white text-orange-600 font-bold rounded-xl hover:bg-gray-100 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    Review Now
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            @if($pendingUsersList->count() > 0)
                <div class="mt-6 pt-6 border-t border-white/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($pendingUsersList as $user)
                            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 hover:bg-white/20 transition-all">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-semibold truncate">{{ $user->name }}</p>
                                        <p class="text-white/70 text-xs truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @endif

            <!-- Pending Requests Card -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:scale-105 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm uppercase tracking-wide mb-2">Pending</h3>
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-amber-600 to-orange-600 bg-clip-text text-transparent">{{ $pendingRequests }}</p>
                    <p class="text-xs text-gray-500 mt-2">Awaiting approval</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
            </div>

            <!-- Approved Requests Card -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:scale-105 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm uppercase tracking-wide mb-2">Approved</h3>
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-green-600 to-emerald-600 bg-clip-text text-transparent">{{ $approvedRequests }}</p>
                    <p class="text-xs text-gray-500 mt-2">Successfully approved</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-green-500 to-emerald-500"></div>
            </div>

            <!-- Rejected Requests Card -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:scale-105 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm uppercase tracking-wide mb-2">Rejected</h3>
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-red-600 to-pink-600 bg-clip-text text-transparent">{{ $rejectedRequests }}</p>
                    <p class="text-xs text-gray-500 mt-2">Declined requests</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-red-500 to-pink-500"></div>
            </div>
        </div>

        <!-- Recent Leave Requests -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Recent Leave Requests</h3>
                    <p class="text-gray-500 text-sm">Latest submissions from employees</p>
                </div>
                <a href="{{ route('admin.leave-requests.index') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    <span>View All</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            @if($recentRequests->count() > 0)
                <div class="overflow-hidden rounded-2xl border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentRequests as $request)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center mr-3">
                                                <span class="text-white font-bold text-sm">{{ substr($request->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $request->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                            @if($request->leave_type == 'Vacation') bg-blue-100 text-blue-800
                                            @elseif($request->leave_type == 'Sick') bg-red-100 text-red-800
                                            @else bg-amber-100 text-amber-800
                                            @endif">
                                            {{ $request->leave_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ $request->start_date->format('M d') }} - {{ $request->end_date->format('M d, Y') }}
                                        <span class="text-gray-500 text-xs">({{ $request->days }} days)</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($request->status == 'Pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                                                Pending
                                            </span>
                                        @elseif($request->status == 'Approved')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Approved
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-600 font-medium">No leave requests yet</p>
                    <p class="text-gray-400 text-sm mt-1">Requests will appear here when submitted</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>