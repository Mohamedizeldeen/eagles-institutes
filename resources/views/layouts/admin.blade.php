<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.dashboard.title')) - {{ __('messages.site.short_name') }}</title>
    <link rel="icon" href="{{ asset('images/siteicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-gradient { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
        .glass-header { backdrop-filter: blur(12px); background: rgba(255,255,255,0.85); }
        .nav-item-active { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; box-shadow: 0 4px 12px rgba(59,130,246,0.3); }
        .nav-item-hover:hover { background: rgba(255,255,255,0.08); }
        .stat-card { transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .sidebar-overlay { background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 antialiased" style="font-family: '{{ $currentLocale === 'ar' ? 'Cairo' : 'Inter' }}', sans-serif">
    <div class="min-h-screen flex">
        {{-- Sidebar Overlay (Mobile) --}}
        <div id="sidebar-overlay" class="fixed inset-0 sidebar-overlay z-30 hidden lg:hidden" onclick="closeSidebar()"></div>

        {{-- Sidebar --}}
        <aside id="sidebar" class="w-72 sidebar-gradient text-gray-300 fixed h-full z-40 transition-transform duration-300 ease-in-out lg:translate-x-0 {{ $isRtl ? 'translate-x-full' : '-translate-x-full' }} overflow-y-auto">
            {{-- Logo --}}
            <div class="p-5 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="bg-white backdrop-blur-sm w-11 h-11 rounded-xl flex items-center justify-center ring-1 ring-white/20">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 rounded-lg">
                    </div>
                    <div>
                        <span class="text-base font-bold text-white block leading-tight">{{ __('messages.site.short_name') }}</span>
                        <span class="text-xs text-gray-400">{{ auth()->user()->role_name }}</span>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="mt-5 px-4 space-y-1.5 pb-20">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.dashboard') }}</span>
                </a>

                {{-- Courses --}}
                <a href="{{ route('admin.courses.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.courses.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span class="font-medium">{{ __('messages.nav.courses') }}</span>
                </a>

                {{-- Students --}}
                <a href="{{ route('admin.students.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.students.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.students') }}</span>
                </a>

                {{-- Enrollments --}}
                <a href="{{ route('admin.enrollments.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.enrollments.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span class="font-medium">{{ __('messages.nav.enrollments') }}</span>
                </a>

                {{-- Certificates --}}
                <a href="{{ route('admin.certificates.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.certificates.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.certificates') }}</span>
                </a>

                {{-- Messages --}}
                <a href="{{ route('admin.contacts.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.contacts.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.messages') }}</span>
                </a>

                @admin
                {{-- Admin-Only Section --}}
                <div class="pt-4 pb-2">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4">{{ __('messages.admin.advanced_management') }}</span>
                </div>

                {{-- Articles --}}
                <a href="{{ route('admin.articles.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.articles.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.articles') }}</span>
                </a>

                {{-- Gallery --}}
                <a href="{{ route('admin.gallery.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.gallery.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.gallery') }}</span>
                </a>

                {{-- Reports --}}
                <a href="{{ route('admin.reports.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.reports') }}</span>
                </a>

                {{-- User Management --}}
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'nav-item-active' : 'nav-item-hover text-gray-300' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="font-medium">{{ __('messages.nav.users') }}</span>
                </a>
                @endadmin

                {{-- Divider --}}
                <hr class="border-white/10 my-4">

                {{-- View Website --}}
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl nav-item-hover text-gray-400">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="font-medium">{{ __('messages.nav.view_site') }}</span>
                </a>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl nav-item-hover text-gray-400 hover:text-red-400 w-full transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="font-medium">{{ __('messages.nav.logout') }}</span>
                    </button>
                </form>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 {{ $isRtl ? 'lg:mr-72' : 'lg:ml-72' }}">
            {{-- Top Header Bar --}}
            <header class="glass-header shadow-sm sticky top-0 z-20 border-b border-gray-200/50">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                    <div class="flex items-center gap-4">
                        <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div>
                            <h1 class="text-lg font-bold text-gray-800">@yield('page-title', __('messages.dashboard.title'))</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        {{-- Language Switcher --}}
                        <a href="{{ route('locale.switch', $currentLocale === 'ar' ? 'en' : 'ar') }}"
                           class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-100 transition font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $currentLocale === 'ar' ? 'EN' : 'عربي' }}
                        </a>

                        {{-- User Info --}}
                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 {{ $isRtl ? 'border-r' : 'border-l' }} border-gray-200 {{ $isRtl ? 'pr-4' : 'pl-4' }} hover:opacity-80 transition">
                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">
                                {{ mb_substr(auth()->user()->localized_name, 0, 1) }}
                            </div>
                            <div class="hidden sm:block">
                                <p class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->localized_name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->role_name }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 sm:px-6 lg:px-8 mt-4">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl mb-4 flex items-center justify-between shadow-sm" role="alert">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 transition">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl mb-4 flex items-center justify-between shadow-sm" role="alert">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100 transition">&times;</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl mb-4 shadow-sm">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-bold">{{ __('messages.error') }}</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 {{ $isRtl ? 'mr-7' : 'ml-7' }}">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Page Content --}}
            <main class="px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        function openSidebar() {
            sidebar.classList.remove('{{ $isRtl ? "translate-x-full" : "-translate-x-full" }}');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('{{ $isRtl ? "translate-x-full" : "-translate-x-full" }}');
            sidebar.classList.remove('translate-x-0');
            overlay.classList.add('hidden');
        }

        toggle?.addEventListener('click', () => {
            if (sidebar.classList.contains('translate-x-0')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
