<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Welcome back, {{ Auth::user()->name }}!
                </h2>
                <p class="text-gray-600 mt-1">Here's an overview of your leave requests</p>
            </div>
            <a href="{{ route('user.leave-requests.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Request Leave
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Leaves Card -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:scale-105 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 font-semibold text-sm uppercase tracking-wide mb-2">Total Requests</h3>
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-blue-600 to-blue-800 bg-clip-text text-transparent">{{ $totalLeaves }}</p>
                    <p class="text-xs text-gray-500 mt-2">All time submissions</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
            </div>

            <!-- Pending Leaves Card -->
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
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-amber-600 to-orange-600 bg-clip-text text-transparent">{{ $pendingLeaves }}</p>
                    <p class="text-xs text-gray-500 mt-2">Awaiting approval</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
            </div>

            <!-- Approved Leaves Card -->
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
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-green-600 to-emerald-600 bg-clip-text text-transparent">{{ $approvedLeaves }}</p>
                    <p class="text-xs text-gray-500 mt-2">Successfully approved</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-green-500 to-emerald-500"></div>
            </div>

            <!-- Rejected Leaves Card -->
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
                    <p class="text-4xl font-extrabold bg-gradient-to-br from-red-600 to-pink-600 bg-clip-text text-transparent">{{ $rejectedLeaves }}</p>
                    <p class="text-xs text-gray-500 mt-2">Declined requests</p>
                </div>
                <div class="h-2 bg-gradient-to-r from-red-500 to-pink-500"></div>
            </div>
        </div>

        <!-- Recent Leave Requests -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">My Recent Leave Requests</h3>
                    <p class="text-gray-500 text-sm">Track your latest submissions and their status</p>
                </div>
                <a href="{{ route('user.leave-requests.index') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                    <span>View All</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            @if($recentRequests->count() > 0)
                <div class="space-y-4">
                    @foreach($recentRequests as $request)
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 hover:shadow-lg transition-all duration-200 border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                            @if($request->leave_type == 'Vacation') bg-blue-100 text-blue-800
                                            @elseif($request->leave_type == 'Sick') bg-red-100 text-red-800
                                            @else bg-amber-100 text-amber-800
                                            @endif">
                                            {{ $request->leave_type }}
                                        </span>
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
                                    </div>
                                    <div class="flex items-center text-gray-900 mb-2">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-semibold">{{ $request->start_date->format('M d, Y') }} - {{ $request->end_date->format('M d, Y') }}</span>
                                        <span class="ml-3 text-sm text-gray-500">({{ $request->days }} {{ $request->days == 1 ? 'day' : 'days' }})</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">{{ $request->reason }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Submitted</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $request->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-600 font-medium">You haven't submitted any leave requests yet</p>
                    <p class="text-gray-400 text-sm mt-1">Click the button above to submit your first request</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>