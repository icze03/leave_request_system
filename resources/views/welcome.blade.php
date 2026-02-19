<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeaveFlow - Modern Leave Management System</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            .gradient-text {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .hero-pattern {
                background-color: #ffffff;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            .float-animation {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .animated-gradient {
                background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Navigation Header -->
        <nav class="fixed w-full bg-white/90 backdrop-blur-xl shadow-lg z-50 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">LeaveFlow</h1>
                            <p class="text-xs text-gray-500 font-medium">Smart Leave Management</p>
                        </div>
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-6 py-3 text-gray-700 font-semibold hover:text-blue-600 transition-colors duration-200">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                        Get Started
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-pattern pt-32 pb-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="text-left space-y-8">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-full">
                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-blue-600 text-sm font-semibold">Modern Leave Management</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                            Streamline Your
                            <span class="gradient-text block mt-2">Leave Requests</span>
                        </h1>
                        
                        <p class="text-xl text-gray-600 leading-relaxed max-w-xl">
                            A powerful, intuitive platform that makes managing employee leave requests simple, efficient, and transparent for everyone.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @guest
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-xl hover:shadow-2xl transition-all duration-200 hover:scale-105">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Create Account
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-bold rounded-xl border-2 border-gray-300 hover:border-blue-600 hover:text-blue-600 shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Sign In
                                </a>
                            @else
                                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-xl hover:shadow-2xl transition-all duration-200 hover:scale-105">
                                    Go to Dashboard
                                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endguest
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                            <div>
                                <div class="text-3xl font-bold text-blue-600">100%</div>
                                <div class="text-sm text-gray-600 font-medium">Digital</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-indigo-600">Fast</div>
                                <div class="text-sm text-gray-600 font-medium">Approval</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-purple-600">24/7</div>
                                <div class="text-sm text-gray-600 font-medium">Access</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Illustration -->
                    <div class="relative float-animation">
                        <div class="relative z-10 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 shadow-2xl border border-blue-100">
                            <!-- Mock Dashboard Preview -->
                            <div class="space-y-4">
                                <!-- Header -->
                                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-full"></div>
                                        <div>
                                            <div class="h-3 w-24 bg-gray-300 rounded"></div>
                                            <div class="h-2 w-16 bg-gray-200 rounded mt-2"></div>
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg"></div>
                                </div>

                                <!-- Stats Cards -->
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-white rounded-2xl p-4 shadow-md border border-gray-100">
                                        <div class="w-8 h-8 bg-blue-500 rounded-lg mb-3"></div>
                                        <div class="h-2 w-16 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-6 w-12 bg-blue-100 rounded"></div>
                                    </div>
                                    <div class="bg-white rounded-2xl p-4 shadow-md border border-gray-100">
                                        <div class="w-8 h-8 bg-green-500 rounded-lg mb-3"></div>
                                        <div class="h-2 w-16 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-6 w-12 bg-green-100 rounded"></div>
                                    </div>
                                </div>

                                <!-- List -->
                                <div class="bg-white rounded-2xl p-4 shadow-md border border-gray-100 space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <div class="h-3 w-32 bg-gray-300 rounded mb-2"></div>
                                            <div class="h-2 w-24 bg-gray-200 rounded"></div>
                                        </div>
                                        <div class="w-16 h-6 bg-green-100 rounded-full"></div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <div class="h-3 w-32 bg-gray-300 rounded mb-2"></div>
                                            <div class="h-2 w-24 bg-gray-200 rounded"></div>
                                        </div>
                                        <div class="w-16 h-6 bg-amber-100 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Elements -->
                        <div class="absolute -top-6 -right-6 w-24 h-24 bg-blue-200 rounded-full opacity-50 blur-xl"></div>
                        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-indigo-200 rounded-full opacity-50 blur-xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                        Everything You Need
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Powerful features designed to make leave management effortless for everyone
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Instant Requests</h3>
                        <p class="text-gray-600 leading-relaxed">Submit leave requests in seconds with our intuitive interface. Get real-time status updates.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Smart Approval</h3>
                        <p class="text-gray-600 leading-relaxed">Administrators can review and approve requests quickly with detailed employee information.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Analytics Dashboard</h3>
                        <p class="text-gray-600 leading-relaxed">Track leave trends and statistics with beautiful, easy-to-understand dashboards.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Secure & Safe</h3>
                        <p class="text-gray-600 leading-relaxed">Enterprise-grade security with role-based access control and data encryption.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Mobile Ready</h3>
                        <p class="text-gray-600 leading-relaxed">Fully responsive design works perfectly on all devices - desktop, tablet, and mobile.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">User Management</h3>
                        <p class="text-gray-600 leading-relaxed">Admins can approve new users and manage employee access with complete control.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 animated-gradient">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
                    Ready to Simplify Leave Management?
                </h2>
                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                    Join modern organizations using LeaveFlow to streamline their leave request process.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-5 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-gray-100 shadow-2xl hover:shadow-3xl transition-all duration-200 hover:scale-105">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Get Started Now
                    </a>
                @else
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="inline-flex items-center px-10 py-5 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-gray-100 shadow-2xl hover:shadow-3xl transition-all duration-200 hover:scale-105">
                        Go to Your Dashboard
                        <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold">LeaveFlow</span>
                        </div>
                        <p class="text-gray-400 text-sm">Modern leave management system for the modern workplace.</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            @guest
                                <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a></li>
                                <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a></li>
                            @else
                                <li><a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a></li>
                            @endguest
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Contact</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li>support@leaveflow.com</li>
                            <li>Built with Laravel & Tailwind CSS</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} LeaveFlow. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>