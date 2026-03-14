@extends('layouts.app')

@section('title', __('messages.nav.home'))

@push('styles')
<style>
    .hero-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.3;
        animation: float 8s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(5deg); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-60px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes countUp {
        from { opacity: 0; transform: scale(0.5); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-in-up-delay-1 { animation: fadeInUp 0.8s ease-out 0.2s forwards; opacity: 0; }
    .animate-fade-in-up-delay-2 { animation: fadeInUp 0.8s ease-out 0.4s forwards; opacity: 0; }
    .animate-fade-in-up-delay-3 { animation: fadeInUp 0.8s ease-out 0.6s forwards; opacity: 0; }
    .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); }
    .gradient-text {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .glass-card {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.3);
    }
</style>
@endpush

@section('content')
    {{-- Hero Section - Immersive --}}
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a]">
        {{-- Animated background blobs --}}
        <div class="hero-blob w-96 h-96 bg-blue-500 top-10 {{ $isRtl ? 'right-10' : 'left-10' }}" style="animation-delay: 0s;"></div>
        <div class="hero-blob w-80 h-80 bg-purple-600 bottom-20 {{ $isRtl ? 'left-20' : 'right-20' }}" style="animation-delay: 2s;"></div>
        <div class="hero-blob w-64 h-64 bg-[#db4047] top-1/2 left-1/2 -translate-x-1/2" style="animation-delay: 4s;"></div>

        {{-- Grid overlay --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="max-w-5xl mx-auto text-center">
                {{-- Badge --}}
                <div class="animate-fade-in-up inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-blue-200 px-5 py-2 rounded-full text-sm font-medium mb-8 border border-white/10">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    {{ __('messages.public.trusted_by') }}
                </div>

                {{-- Title --}}
                <h1 class="animate-fade-in-up-delay-1 text-4xl sm:text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6 tracking-tight">
                    {{ __('messages.public.hero_title') }}
                    <span class="block mt-2 bg-gradient-to-r from-white via-[#eb4256] to-[#722029] bg-clip-text text-transparent">{{ __('messages.site.short_name') }}</span>
                </h1>

                {{-- Subtitle --}}
                <p class="animate-fade-in-up-delay-2 text-lg sm:text-xl md:text-2xl text-blue-100/80 mb-12 max-w-3xl mx-auto leading-relaxed font-light">
                    {{ __('messages.public.hero_subtitle') }}
                </p>

                {{-- CTA Buttons --}}
                <div class="animate-fade-in-up-delay-3 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('public.courses') }}" class="group relative inline-flex items-center justify-center gap-3 bg-white text-[#112c71] font-bold px-8 py-4 rounded-2xl text-lg transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/25 hover:scale-105">
                        <span>{{ __('messages.public.hero_cta') }}</span>
                        <svg class="w-5 h-5 transition-transform duration-300 {{ $isRtl ? 'rotate-180 group-hover:-translate-x-1' : 'group-hover:translate-x-1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('public.about') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white/20 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-2xl text-lg transition-all duration-300 backdrop-blur-sm">
                        {{ __('messages.public.know_us') }}
                    </a>
                </div>

                {{-- Stats Bar --}}
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
                    <div class="rounded-2xl p-4 text-center bg-[#eb4256]">
                        <div class="text-3xl font-extrabold text-white mb-1">100+</div>
                        <div class="text-white text-sm">{{ __('messages.public.stats_students') }}</div>
                    </div>
                    <div class="rounded-2xl p-4 text-center  bg-[#eb4256]">
                        <div class="text-3xl font-extrabold text-white mb-1">6+</div>
                        <div class="text-white text-sm">{{ __('messages.public.stats_courses') }}</div>
                    </div>
                    <div class="rounded-2xl p-4 text-center  bg-[#eb4256]">
                        <div class="text-3xl font-extrabold text-white mb-1">50+</div>
                        <div class="text-white text-sm">{{ __('messages.public.stats_certificates') }}</div>
                    </div>
                    <div class=" rounded-2xl p-4 text-center  bg-[#eb4256]">
                        <div class="text-3xl font-extrabold text-white mb-1">3+</div>
                        <div class="text-white text-sm">{{ __('messages.public.stats_years') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom wave --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="w-full"><path fill="#f9fafb" d="M0,64L60,58.7C120,53,240,43,360,48C480,53,600,75,720,80C840,85,960,75,1080,64C1200,53,1320,43,1380,37.3L1440,32L1440,100L0,100Z"></path></svg>
        </div>
    </section>

    {{-- Why Us Section --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">{{ __('messages.public.why_us') }}</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-5">{{ __('messages.public.why_us') }}</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">{{ __('messages.public.why_us_desc') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Feature 1 --}}
                <div class="card-hover bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.public.modern_curriculum') }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ __('messages.public.modern_curriculum_desc') }}</p>
                </div>
                {{-- Feature 2 --}}
                <div class="card-hover bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.public.professional_teachers') }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ __('messages.public.professional_teachers_desc') }}</p>
                </div>
                {{-- Feature 3 --}}
                <div class="card-hover bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-amber-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.public.certified') }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ __('messages.public.certified_desc') }}</p>
                </div>
                {{-- Feature 4 --}}
                <div class="card-hover bg-white rounded-3xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('messages.public.small_classes') }}</h3>
                    <p class="text-gray-500 leading-relaxed">{{ __('messages.public.small_classes_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Courses Section --}}
    @if($featuredCourses->count() > 0)
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-14 gap-4">
                <div>
                    <span class="inline-block text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">{{ __('messages.courses.title') }}</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900">{{ __('messages.public.our_courses') }}</h2>
                    <p class="text-gray-500 text-lg mt-3 max-w-xl">{{ __('messages.public.our_courses_desc') }}</p>
                </div>
                <a href="{{ route('public.courses') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-7 py-3.5 rounded-2xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25 self-start md:self-auto">
                    {{ __('messages.public.view_all_courses') }}
                    <svg class="w-5 h-5 {{ $isRtl ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredCourses as $course)
                    <div class="card-hover bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 group">
                        @if($course->image)
                            <div class="h-52 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->localized_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>
                        @else
                            <div class="h-52 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full
                                    @if($course->level === 'مبتدئ') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200
                                    @elseif($course->level === 'متوسط') bg-amber-50 text-amber-700 ring-1 ring-amber-200
                                    @else bg-rose-50 text-rose-700 ring-1 ring-rose-200
                                    @endif">
                                    {{ $course->localized_level }}
                                </span>
                                <span class="text-sm text-gray-400 font-medium">{{ $course->duration_hours }} {{ __('messages.courses.hours') }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $course->localized_name }}</h3>
                            <p class="text-gray-500 mb-5 line-clamp-2 text-sm leading-relaxed">{{ $course->localized_description }}</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <span class="text-2xl font-extrabold text-gray-900">{{ number_format($course->price) }}</span>
                                    <span class="text-sm text-gray-400 {{ $isRtl ? 'mr-1' : 'ml-1' }}">{{ __('messages.courses.currency') }}</span>
                                </div>
                                <a href="{{ route('public.courses.show', $course) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-sm transition-colors">
                                    {{ __('messages.details') }}
                                    <svg class="w-4 h-4 {{ $isRtl ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Levels Section --}}
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-100 rounded-full filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">{{ __('messages.public.learning_levels') }}</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-5">{{ __('messages.public.learning_levels') }}</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">{{ __('messages.public.learning_levels_desc') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                {{-- Beginner --}}
                <div class="card-hover relative bg-white rounded-3xl p-8 text-center border-2 border-emerald-100 overflow-hidden">
                    <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-24 h-24 bg-emerald-50 rounded-full -translate-y-1/2 {{ $isRtl ? '-translate-x-1/2' : 'translate-x-1/2' }}"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/30 rotate-3">
                            <span class="text-3xl font-extrabold">1</span>
                        </div>
                        <span class="inline-block bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-bold mb-4">{{ __('messages.public.level_1') }}</span>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-3">{{ __('messages.public.beginner') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.public.beginner_desc') }}</p>
                    </div>
                </div>
                {{-- Intermediate --}}
                <div class="card-hover relative bg-white rounded-3xl p-8 text-center border-2 border-amber-100 overflow-hidden md:-translate-y-4">
                    <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-24 h-24 bg-amber-50 rounded-full -translate-y-1/2 {{ $isRtl ? '-translate-x-1/2' : 'translate-x-1/2' }}"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-amber-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-amber-500/30 -rotate-3">
                            <span class="text-3xl font-extrabold">2</span>
                        </div>
                        <span class="inline-block bg-amber-100 text-amber-700 px-4 py-1 rounded-full text-sm font-bold mb-4">{{ __('messages.public.level_2') }}</span>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-3">{{ __('messages.public.intermediate') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.public.intermediate_desc') }}</p>
                    </div>
                </div>
                {{-- Advanced --}}
                <div class="card-hover relative bg-white rounded-3xl p-8 text-center border-2 border-rose-100 overflow-hidden">
                    <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-24 h-24 bg-rose-50 rounded-full -translate-y-1/2 {{ $isRtl ? '-translate-x-1/2' : 'translate-x-1/2' }}"></div>
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-rose-400 to-rose-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-rose-500/30 rotate-3">
                            <span class="text-3xl font-extrabold">3</span>
                        </div>
                        <span class="inline-block bg-rose-100 text-rose-700 px-4 py-1 rounded-full text-sm font-bold mb-4">{{ __('messages.public.level_3') }}</span>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-3">{{ __('messages.public.advanced') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.public.advanced_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    @if($latestArticles->count() > 0)
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-14 gap-4">
                <div>
                    <span class="inline-block text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">{{ __('messages.articles.title') }}</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900">{{ __('messages.public.latest_articles') }}</h2>
                    <p class="text-gray-500 text-lg mt-3 max-w-xl">{{ __('messages.public.latest_articles_desc') }}</p>
                </div>
                <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-bold px-7 py-3.5 rounded-2xl transition-all duration-300 self-start md:self-auto">
                    {{ __('messages.public.view_all_articles') }}
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <article class="card-hover bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 group">
                        @if($article->image)
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->localized_title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        @else
                            <div class="h-56 bg-gradient-to-br from-slate-100 via-gray-100 to-slate-200 flex items-center justify-center relative">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-3 text-sm text-gray-400 mb-4">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ route('public.articles.show', $article->slug) }}">{{ $article->localized_title }}</a>
                            </h3>
                            <p class="text-gray-500 mb-5 line-clamp-3 text-sm leading-relaxed">{{ $article->localized_excerpt }}</p>
                            <a href="{{ route('public.articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-sm transition-colors group/link">
                                {{ __('messages.articles.read_more') }}
                                <svg class="w-4 h-4 transition-transform {{ $isRtl ? 'rotate-180 group-hover/link:-translate-x-1' : 'group-hover/link:translate-x-1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#112c71] via-[#1a3a7f] to-[#0f172a]"></div>
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="hero-blob w-72 h-72 bg-blue-500 top-10 {{ $isRtl ? 'right-10' : 'left-10' }} opacity-20"></div>
        <div class="hero-blob w-56 h-56 bg-[#db4047] bottom-10 {{ $isRtl ? 'left-10' : 'right-10' }} opacity-20" style="animation-delay: 3s;"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight">{{ __('messages.public.cta_title') }}</h2>
            <p class="text-xl text-blue-100/70 mb-10 max-w-2xl mx-auto">{{ __('messages.public.cta_desc') }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('public.courses') }}" class="group inline-flex items-center justify-center gap-3 bg-white text-[#112c71] font-bold px-10 py-4 rounded-2xl text-lg transition-all duration-300 hover:shadow-2xl hover:shadow-white/20 hover:scale-105">
                    {{ __('messages.public.cta_button') }}
                    <svg class="w-5 h-5 transition-transform duration-300 {{ $isRtl ? 'rotate-180 group-hover:-translate-x-1' : 'group-hover:translate-x-1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('public.contact') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white/30 text-white hover:bg-white/10 font-semibold px-10 py-4 rounded-2xl text-lg transition-all duration-300 backdrop-blur-sm">
                    {{ __('messages.public.contact_us') }}
                </a>
            </div>
        </div>
    </section>
@endsection
