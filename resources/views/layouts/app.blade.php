<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Complaint System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-sm border-r border-gray-200 flex flex-col">

        <!-- Logo -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">EduVoice</h2>
                    <p class="text-xs text-gray-500">Student Portal</p>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3">Menu</p>

            <a href="/dashboard"
               class="flex items-center gap-3 px-4 py-3 mb-1 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('complaints.create') }}"
               class="flex items-center gap-3 px-4 py-3 mb-1 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>New Complaint</span>
            </a>

            <a href="{{ route('complaints.index') }}"
               class="flex items-center gap-3 px-4 py-3 mb-1 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>My Complaints</span>
            </a>

        </nav>

        <!-- User Card -->
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name,0,2)) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Student</p>
                </div>
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>

    </aside>


    <!-- Main Area -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white px-8 py-5 shadow-sm border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        @yield('title', 'Dashboard')
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Welcome back, {{ auth()->user()->name }}
                    </p>
                </div>

                <div class="text-sm text-gray-500">
                    {{ now()->format('l, d M Y') }}
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>