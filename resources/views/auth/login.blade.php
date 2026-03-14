@php
    $locale = session('locale', config('app.locale', 'ar'));
    $isRtl = $locale === 'ar';
    $dir = $isRtl ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.auth.login_title') }} - {{ __('messages.site.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 min-h-screen flex items-center justify-center p-4" style="font-family: {{ $isRtl ? 'Cairo' : 'Inter' }}, sans-serif;">
    {{-- Language Switcher --}}
    <div class="fixed top-4 {{ $isRtl ? 'left-4' : 'right-4' }}">
        <a href="{{ url('/locale/' . ($locale === 'ar' ? 'en' : 'ar')) }}"
           class="bg-white/10 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm hover:bg-white/20 transition font-medium border border-white/20">
            {{ $locale === 'ar' ? 'English' : 'العربية' }}
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative overflow-hidden">
        {{-- Decorative elements --}}
        <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-32 h-32 bg-blue-500/5 rounded-full -mt-16 {{ $isRtl ? '-ml-16' : '-mr-16' }}"></div>
        <div class="absolute bottom-0 {{ $isRtl ? 'right-0' : 'left-0' }} w-24 h-24 bg-blue-500/5 rounded-full -mb-12 {{ $isRtl ? '-mr-12' : '-ml-12' }}"></div>

        <div class="text-center mb-8 relative">
            <div class="w-20 h-20 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.site.name') }}" class="w-full h-full object-contain rounded-xl">
            </div>
            <h1 class="text-2xl font-bold text-gray-800">{{ __('messages.site.name') }}</h1>
            <p class="text-gray-500 mt-1">{{ __('messages.auth.login_subtitle') }}</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.auth.email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-{{ $isRtl ? 'left' : 'left' }}" dir="ltr"
                    placeholder="admin@eagles.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.auth.password') }}</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-left" dir="ltr"
                    placeholder="••••••••">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remember" class="text-sm text-gray-600 {{ $isRtl ? 'mr-2' : 'ml-2' }}">{{ __('messages.auth.remember_me') }}</label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-blue-700 to-blue-800 text-white py-3 rounded-xl font-medium hover:from-blue-800 hover:to-blue-900 transition-all focus:ring-4 focus:ring-blue-300 shadow-lg shadow-blue-500/20">
                {{ __('messages.auth.login_button') }}
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-700 transition">{{ __('messages.auth.back_to_site') }}</a>
        </div>
    </div>
</body>
</html>
