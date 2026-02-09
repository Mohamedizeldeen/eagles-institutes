<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'معهد النسور للغة الإنجليزية')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--website icon -->
    <link rel="icon" href="{{ asset('images/siteicon.png') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">
    {{-- شريط التنقل --}}
    <nav class="bg-white shadow-md sticky top-0 z-50 pt-3 pb-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- الشعار --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="معهد النسور" class="w-20  h-auto rounded-lg">
                   
                </a>

                {{-- القائمة --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#112c71] font-medium transition {{ request()->routeIs('home') ? 'text-[#112c71]' : '' }}">الرئيسية</a>
                    <a href="{{ route('public.courses') }}" class="text-gray-700 hover:text-[#112c71] font-medium transition {{ request()->routeIs('public.courses*') ? 'text-[#112c71]' : '' }}">الدورات</a>
                    <a href="{{ route('public.articles') }}" class="text-gray-700 hover:text-[#112c71] font-medium transition {{ request()->routeIs('public.articles*') ? 'text-[#112c71]' : '' }}">المقالات</a>
                    <a href="{{ route('public.about') }}" class="text-gray-700 hover:text-[#112c71] font-medium transition {{ request()->routeIs('public.about') ? 'text-[#112c71]' : '' }}">من نحن</a>
                    <a href="{{ route('public.contact') }}" class="text-gray-700 hover:text-[#112c71] font-medium transition {{ request()->routeIs('public.contact') ? 'text-[#112c71]' : '' }}">تواصل معنا</a>
                </div>

                {{-- زر الدخول --}}
                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="bg-[#112c71] text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition text-sm font-medium">لوحة التحكم</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 text-sm font-medium transition">خروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#112c71] text-sm font-medium transition">دخول</a>
                    @endauth
                </div>

                {{-- زر القائمة للموبايل --}}
                <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-[#112c71] focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- قائمة الموبايل --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-[#112c71] font-medium">الرئيسية</a>
                <a href="{{ route('public.courses') }}" class="block py-2 text-gray-700 hover:text-[#112c71] font-medium">الدورات</a>
                <a href="{{ route('public.articles') }}" class="block py-2 text-gray-700 hover:text-[#112c71] font-medium">المقالات</a>
                <a href="{{ route('public.about') }}" class="block py-2 text-gray-700 hover:text-[#112c71] font-medium">من نحن</a>
                <a href="{{ route('public.contact') }}" class="block py-2 text-gray-700 hover:text-[#112c71] font-medium">تواصل معنا</a>
            </div>
        </div>
    </nav>

    {{-- المحتوى الرئيسي --}}
    <main>
        @yield('content')
    </main>

    {{-- الذيل --}}
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-gray-100 text-white w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg">
                            <img src="{{ asset('images/logo.png') }}" alt="معهد النسور" class="w-20 h-auto">
                        </div>
                        <span class="text-xl font-bold text-white">معهد النسور</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">معهد متخصص في تعليم اللغة الإنجليزية بأحدث الأساليب التعليمية وأفضل المدربين المؤهلين.</p>
                 {{-- Social Media --}}
                        <div class="rounded-2xl shadow-sm pt-8">
                            
                            <div class="flex gap-3">
                                <a href="https://www.tiktok.com/@eagles_institutes?_r=1&_t=ZS-93cIEy3iWuq" class="w-10 h-10 bg-gray-200 text-white rounded-lg flex items-center justify-center hover:bg-gray-300 transition-colors">
                                    <img src="{{ asset(path: 'svg/tiktok.svg') }}" alt="TikTok">
                                </a>
                                <a href="https://www.instagram.com/eagles_institutes?igsh=YW10ZnJtYXA2MWQ1" class="w-10 h-10 bg-pink-600 text-white rounded-lg flex items-center justify-center hover:bg-pink-700 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                                <a href="https://www.snapchat.com/add/mesk12pp?share_id=FtrGpzG2nDc&locale=en-GB" class="w-10 h-10 bg-yellow-400 text-black rounded-lg flex items-center justify-center hover:bg-yellow-500 transition-colors" aria-label="Snapchat">
                                    <img src="{{ asset(path: 'svg/snapchat.svg') }}" alt="Snapchat">
                                </a>
                            </div>
                        </div>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">الرئيسية</a></li>
                        <li><a href="{{ route('public.courses') }}" class="hover:text-white transition">الدورات</a></li>
                        <li><a href="{{ route('public.articles') }}" class="hover:text-white transition">المقالات</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-white transition">من نحن</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-white transition">تواصل معنا</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">معلومات التواصل</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>0135881133</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@eagles-institute.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>المملكة العربية السعودية, الأحساء, شارع الظهران</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} معهد النسور للغة الإنجليزية. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
