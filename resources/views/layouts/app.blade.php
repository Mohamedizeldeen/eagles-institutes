<!DOCTYPE html>
<html lang="{{ $currentLocale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.site.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('images/siteicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-nav { backdrop-filter: blur(16px); background: rgba(255,255,255,0.9); }
        .hero-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #112c71 70%, #db4047 100%); }
        .text-gradient { background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased" style="font-family: '{{ $currentLocale === 'ar' ? 'Cairo' : 'Inter' }}', sans-serif">
    {{-- Navigation --}}
    <nav class="glass-nav shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.site.short_name') }}" class="w-16 h-auto rounded-xl group-hover:scale-105 transition-transform duration-300">
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'text-[#112c71] bg-blue-50' : 'text-gray-600 hover:text-[#112c71] hover:bg-gray-50' }}">{{ __('messages.nav.home') }}</a>
                    <a href="{{ route('public.courses') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('public.courses*') ? 'text-[#112c71] bg-blue-50' : 'text-gray-600 hover:text-[#112c71] hover:bg-gray-50' }}">{{ __('messages.nav.courses') }}</a>
                    <a href="{{ route('public.articles') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('public.articles*') ? 'text-[#112c71] bg-blue-50' : 'text-gray-600 hover:text-[#112c71] hover:bg-gray-50' }}">{{ __('messages.nav.articles') }}</a>
                    <a href="{{ route('public.about') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('public.about') ? 'text-[#112c71] bg-blue-50' : 'text-gray-600 hover:text-[#112c71] hover:bg-gray-50' }}">{{ __('messages.nav.about') }}</a>
                    <a href="{{ route('public.contact') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ request()->routeIs('public.contact') ? 'text-[#112c71] bg-blue-50' : 'text-gray-600 hover:text-[#112c71] hover:bg-gray-50' }}">{{ __('messages.nav.contact') }}</a>
                </div>

                {{-- Right side: Language + Auth --}}
                <div class="hidden md:flex items-center gap-3">
                    {{-- Language Switcher --}}
                    <a href="{{ route('locale.switch', $currentLocale === 'ar' ? 'en' : 'ar') }}"
                       class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-100 transition font-medium border border-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $currentLocale === 'ar' ? 'English' : 'العربية' }}
                    </a>

                    @auth
                        @if(auth()->user()->isStaff())
                            <a href="{{ route('admin.dashboard') }}" class="bg-[#112c71] text-white px-5 py-2.5 rounded-xl hover:bg-blue-800 transition-all duration-200 text-sm font-semibold shadow-sm hover:shadow-md">{{ __('messages.nav.dashboard') }}</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-600 text-sm font-medium transition px-3 py-2 rounded-lg hover:bg-red-50">{{ __('messages.nav.logout') }}</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#112c71] text-sm font-semibold transition px-3 py-2 rounded-lg hover:bg-gray-50">{{ __('messages.nav.login') }}</a>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-[#112c71] focus:outline-none p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block py-3 px-4 text-gray-700 hover:text-[#112c71] font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.home') }}</a>
                <a href="{{ route('public.courses') }}" class="block py-3 px-4 text-gray-700 hover:text-[#112c71] font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.courses') }}</a>
                <a href="{{ route('public.articles') }}" class="block py-3 px-4 text-gray-700 hover:text-[#112c71] font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.articles') }}</a>
                <a href="{{ route('public.about') }}" class="block py-3 px-4 text-gray-700 hover:text-[#112c71] font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.about') }}</a>
                <a href="{{ route('public.contact') }}" class="block py-3 px-4 text-gray-700 hover:text-[#112c71] font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.contact') }}</a>
                <hr class="my-2 border-gray-100">
                <a href="{{ route('locale.switch', $currentLocale === 'ar' ? 'en' : 'ar') }}"
                   class="block py-3 px-4 text-gray-600 font-medium rounded-lg hover:bg-gray-50 transition">
                    {{ $currentLocale === 'ar' ? '🌐 English' : '🌐 العربية' }}
                </a>
                @auth
                    @if(auth()->user()->isStaff())
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-4 text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition">{{ __('messages.nav.dashboard') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block py-3 px-4 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">{{ __('messages.nav.login') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                {{-- About --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="bg-white backdrop-blur-sm w-12 h-12 rounded-xl flex items-center justify-center ring-1 ring-white/20">
                            <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.site.short_name') }}" class="w-10 h-auto rounded-lg">
                        </div>
                        <span class="text-xl font-bold text-white">{{ __('messages.site.short_name') }}</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">{{ __('messages.public.about_desc') }}</p>
                    {{-- Social Media --}}
                    <div class="flex gap-3">
                        <a href="https://www.tiktok.com/@eagles_institutes" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors ring-1 ring-white/10">
                            <img src="{{ asset('svg/tiktok.svg') }}" alt="TikTok" class="w-5 h-5">
                        </a>
                        <a href="https://www.instagram.com/eagles_institutes" class="w-10 h-10 bg-pink-600/20 text-pink-400 rounded-xl flex items-center justify-center hover:bg-pink-600/30 transition-colors ring-1 ring-pink-500/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://www.snapchat.com/add/mesk12pp" class="w-10 h-10 bg-yellow-500/20 text-yellow-400 rounded-xl flex items-center justify-center hover:bg-yellow-500/30 transition-colors ring-1 ring-yellow-500/20">
                            <img src="{{ asset('svg/snapchat.svg') }}" alt="Snapchat" class="w-5 h-5">
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-white font-bold mb-5 text-lg">{{ __('messages.public.quick_links') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M{{ $isRtl ? '12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' : '7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' }}" clip-rule="evenodd"/></svg>{{ __('messages.nav.home') }}</a></li>
                        <li><a href="{{ route('public.courses') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M{{ $isRtl ? '12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' : '7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' }}" clip-rule="evenodd"/></svg>{{ __('messages.nav.courses') }}</a></li>
                        <li><a href="{{ route('public.articles') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M{{ $isRtl ? '12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' : '7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' }}" clip-rule="evenodd"/></svg>{{ __('messages.nav.articles') }}</a></li>
                        <li><a href="{{ route('public.about') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M{{ $isRtl ? '12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' : '7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' }}" clip-rule="evenodd"/></svg>{{ __('messages.nav.about') }}</a></li>
                        <li><a href="{{ route('public.contact') }}" class="text-gray-400 hover:text-white transition-colors flex items-center gap-2"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M{{ $isRtl ? '12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z' : '7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z' }}" clip-rule="evenodd"/></svg>{{ __('messages.nav.contact') }}</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h3 class="text-white font-bold mb-5 text-lg">{{ __('messages.public.contact_info') }}</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span dir="ltr">0135881133</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span>info@eagles-institute.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span>{{ $currentLocale === 'ar' ? 'المملكة العربية السعودية, الأحساء, شارع الظهران' : 'Saudi Arabia, Al-Ahsa, Dhahran Street' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-12 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} {{ __('messages.site.name') }}. {{ __('messages.site.copyright') }}.</p>
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
