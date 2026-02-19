<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">
            Request New Leave
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Submit Leave Request</h3>
                <p class="text-gray-600">Fill out the form below to request time off. Your request will be reviewed by an administrator.</p>
            </div>

            <form method="POST" action="{{ route('user.leave-requests.store') }}" class="space-y-6">
                @csrf

                <!-- Leave Type -->
                <div>
                    <label for="leave_type" class="block text-sm font-bold text-gray-900 mb-3">
                        Leave Type <span class="text-red-500">*</span>
                    </label>
                    <select id="leave_type" name="leave_type" required 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 text-gray-900 font-medium @error('leave_type') border-red-500 @enderror">
                        <option value="">Select leave type...</option>
                        <option value="Vacation" {{ old('leave_type') == 'Vacation' ? 'selected' : '' }}>🏖️ Vacation</option>
                        <option value="Sick" {{ old('leave_type') == 'Sick' ? 'selected' : '' }}>🤒 Sick Leave</option>
                        <option value="Emergency" {{ old('leave_type') == 'Emergency' ? 'selected' : '' }}>🚨 Emergency</option>
                    </select>
                    @error('leave_type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-bold text-gray-900 mb-3">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                                min="{{ date('Y-m-d') }}"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('start_date') border-red-500 @enderror">
                        </div>
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-bold text-gray-900 mb-3">
                            End Date <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required
                                min="{{ date('Y-m-d') }}"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('end_date') border-red-500 @enderror">
                        </div>
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Reason -->
                <div>
                    <label for="reason" class="block text-sm font-bold text-gray-900 mb-3">
                        Reason for Leave <span class="text-red-500">*</span>
                    </label>
                    <textarea id="reason" name="reason" rows="5" required
                        placeholder="Please provide a detailed reason for your leave request (minimum 10 characters)..."
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 resize-none @error('reason') border-red-500 @enderror">{{ old('reason') }}</textarea>
                    @error('reason')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">Minimum 10 characters, maximum 500 characters</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('user.leave-requests.index') }}" 
                        class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 hover:scale-105">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Request
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-6 border border-blue-100">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-bold text-gray-900 mb-2">Important Information</h4>
                    <ul class="text-sm text-gray-700 space-y-1 list-disc list-inside">
                        <li>All leave requests require administrator approval</li>
                        <li>Please submit your request at least 48 hours in advance</li>
                        <li>Emergency leaves will be processed with priority</li>
                        <li>You will be notified once your request is reviewed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>