<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - معهد النسور</title>
        <!--website icon -->
    <link rel="icon" href="{{ asset('images/siteicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        {{-- القائمة الجانبية --}}
        <aside id="sidebar" class="w-64 bg-gray-900 text-gray-300 fixed h-full z-40 transition-transform duration-300 lg:translate-x-0 translate-x-full">
            <div class="p-4 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="bg-white text-white w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>
                    <span class="text-lg font-bold text-white">معهد النسور</span>
                </a>
            </div>

            <nav class="mt-4 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>الرئيسية</span>
                </a>

                <a href="{{ route('admin.courses.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.courses.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>الدورات</span>
                </a>

                <a href="{{ route('admin.students.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.students.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>الطلاب</span>
                </a>

                <a href="{{ route('admin.enrollments.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.enrollments.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>التسجيلات</span>
                </a>

                <a href="{{ route('admin.certificates.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.certificates.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    <span>الشهادات</span>
                </a>

                <a href="{{ route('admin.articles.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.articles.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>المقالات</span>
                </a>

                <a href="{{ route('admin.reports.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.reports.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span>التقارير المالية</span>
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    <span>الرسائل الواردة</span>
                </a>


                <hr class="border-gray-700 my-3">

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-800 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>عرض الموقع</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-700 text-gray-400 hover:text-white w-full transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </nav>
        </aside>

        {{-- المحتوى الرئيسي --}}
        <div class="flex-1 lg:mr-64">
            {{-- الشريط العلوي --}}
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                    <div class="flex items-center gap-4">
                        <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h1 class="text-lg font-bold text-gray-800">@yield('page-title', 'لوحة التحكم')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">مرحباً، {{ auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            {{-- رسائل النجاح والخطأ --}}
            <div class="px-4 sm:px-6 lg:px-8 mt-4">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">&times;</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- المحتوى --}}
            <main class="px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('translate-x-full');
            sidebar.classList.toggle('translate-x-0');
        });
        // إغلاق القائمة عند النقر خارجها على الموبايل
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.add('translate-x-full');
                sidebar.classList.remove('translate-x-0');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
