@extends('layouts.app')

@section('title', $article->localized_title)

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto">
                <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-white mb-6 transition-colors font-medium">
                    <svg class="w-5 h-5 {{ $isRtl ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    {{ __('messages.articles.back_to_articles') }}
                </a>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-5 leading-tight">{{ $article->localized_title }}</h1>
                <div class="flex items-center gap-6 text-blue-200 text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $article->published_at ? $article->published_at->format('Y/m/d') : $article->created_at->format('Y/m/d') }}
                    </span>
                    @if($article->author)
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $article->author->localized_name }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Article Content --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                @if($article->image)
                    <div class="rounded-3xl overflow-hidden shadow-lg mb-8 -mt-8 relative z-20">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->localized_title }}" class="w-full h-80 md:h-96 object-cover">
                    </div>
                @endif

                <article class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100">
                    @if($article->localized_excerpt)
                        <div class="text-xl text-gray-500 leading-relaxed mb-8 pb-8 border-b border-gray-100 italic">
                            {{ $article->localized_excerpt }}
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-700 leading-loose">
                        {!! nl2br(e($article->localized_content)) !!}
                    </div>
                </article>

                {{-- Navigation --}}
                <div class="mt-8 flex items-center justify-between">
                    <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-bold transition-colors">
                        <svg class="w-5 h-5 {{ $isRtl ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        {{ __('messages.articles.back_to_articles') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
