@extends('layouts.app')

@section('title', __('messages.articles.title'))

@push('styles')
<style>
    .card-hover { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
    .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.12); }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
    .fade-in-up-d1 { animation: fadeInUp 0.7s 0.1s ease-out forwards; opacity: 0; }
    .fade-in-up-d2 { animation: fadeInUp 0.7s 0.2s ease-out forwards; opacity: 0; }
    .fade-in-up-d3 { animation: fadeInUp 0.7s 0.3s ease-out forwards; opacity: 0; }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-10 {{ $isRtl ? 'left-10' : 'right-10' }} w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 {{ $isRtl ? 'right-10' : 'left-10' }} w-56 h-56 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-blue-200 mb-6 fade-in-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                {{ __('messages.articles.title') }}
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 fade-in-up-d1">{{ __('messages.articles.title') }}</h1>
            <p class="text-lg text-blue-200 max-w-2xl mx-auto fade-in-up-d2">{{ __('messages.public.latest_articles_desc') }}</p>
        </div>
    </section>

    {{-- Articles Grid --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    @foreach($articles as $index => $article)
                        <article class="card-hover bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group">
                            @if($article->image)
                                <div class="h-56 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->localized_title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @else
                                <div class="h-56 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                                    <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-3 text-sm text-gray-400 mb-4">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $article->published_at ? $article->published_at->format('Y/m/d') : $article->created_at->format('Y/m/d') }}
                                    </span>
                                    <span class="text-gray-200">|</span>
                                    <span>{{ __('messages.articles.min_read', ['min' => rand(3,8)]) }}</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a href="{{ route('public.articles.show', $article->slug) }}">{{ $article->localized_title }}</a>
                                </h3>
                                <p class="text-gray-500 mb-5 line-clamp-3 leading-relaxed">{{ $article->localized_excerpt }}</p>
                                <a href="{{ route('public.articles.show', $article->slug) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-bold text-sm transition-colors group/link">
                                    {{ __('messages.articles.read_more') }}
                                    <svg class="w-4 h-4 {{ $isRtl ? '' : 'rotate-180' }} group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-20 max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">{{ __('messages.articles.no_articles_available') }}</h3>
                    <p class="text-gray-400">{{ __('messages.articles.follow_for_articles') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
