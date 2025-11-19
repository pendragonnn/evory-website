<!-- Admin Layout Template for Evory (Purple Theme) -->
<!-- Responsive Sidebar + Topbar (Breadcrumb + Profile Dropdown) -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evory Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Overlay for Mobile -->
        <div x-show="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-40 z-30 md:hidden"
            @click="sidebarOpen = false"></div>

        <!-- SIDEBAR -->
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 transform bg-purple-700 shadow-xl md:translate-x-0 md:static transition-transform duration-200 ease-in-out flex flex-col justify-between"
            :class="{'-translate-x-full': !sidebarOpen}">

            <div>
                <div class="flex items-center justify-center h-16 shadow-md bg-purple-800">
                    <h1 class="text-xl font-bold text-white">Evory Admin</h1>
                </div>

                <nav class="mt-6 space-y-1 px-3 text-purple-100">
                    <!-- Dashboard -->
                    <a href="/admin/dashboard"
                        class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-purple-600 transition-all {{ request()->is('admin/dashboard') ? 'bg-purple-900' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Events -->
                    <a href="/admin/events"
                        class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-purple-600 transition-all {{ request()->is('admin/events*') ? 'bg-purple-900' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-6H3v6a2 2 0 002 2z" />
                        </svg>
                        Events
                    </a>

                    <!-- Bookings -->
                    <a href="/admin/bookings"
                        class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-purple-600 transition-all {{ request()->is('admin/bookings*') ? 'bg-purple-900' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Bookings
                    </a>

                    <!-- Users -->
                    <a href="/admin/users"
                        class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-purple-600 transition-all {{ request()->is('admin/users*') ? 'bg-purple-900' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>
                </nav>
            </div>

            <!-- COPYRIGHT FIXED AT BOTTOM -->
            <div class="text-purple-200 text-sm px-4 py-4 border-t border-purple-600/40 mb-2">
                © {{ date('Y') }} Evory. All rights reserved.
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex flex-col flex-1 overflow-hidden">

            <!-- TOPBAR -->
            <header class="flex items-center justify-between h-16 bg-white shadow px-6">

                <!-- Breadcrumb / Title -->
                <div class="flex items-center space-x-3">
                    <button @click="sidebarOpen = true" class="md:hidden focus:outline-none">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $title ?? 'Admin Panel' }}</h2>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6d28d9&color=fff"
                            class="w-8 h-8 rounded-full" />
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>