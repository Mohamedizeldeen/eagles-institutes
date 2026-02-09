@extends('layouts.app')

@section('title', $article->title)

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200  py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 text-primary-200 hover:text-white mb-6 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    العودة للمقالات
                </a>
                <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">{{ $article->title }}</h1>
                <div class="flex items-center gap-6 text-primary-200">
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
                            {{ $article->author->name }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Article Content --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @if($article->image)
                    <div class="rounded-2xl overflow-hidden shadow-md mb-8">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
                    </div>
                @endif

                <article class="bg-white rounded-2xl p-8 md:p-12 shadow-sm">
                    @if($article->excerpt)
                        <div class="text-xl text-gray-600 leading-relaxed mb-8 pb-8 border-b border-gray-100">
                            {{ $article->excerpt }}
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-700 leading-loose article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </article>

                {{-- Share & Navigation --}}
                <div class="mt-8 flex items-center justify-between">
                    <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        العودة لجميع المقالات
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
